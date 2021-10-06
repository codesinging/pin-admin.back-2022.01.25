<?php

namespace CodeSinging\PinAdmin\Tests\Foundation;

use CodeSinging\PinAdmin\Exceptions\ApplicationNotFoundException;
use CodeSinging\PinAdmin\Exceptions\InvalidApplicationNameException;
use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Foundation\Application;
use CodeSinging\PinAdmin\Tests\TestCase;

class AdminTest extends TestCase
{
    public function testBaseMethods()
    {
        self::assertEquals(Admin::VERSION, $this->admin()->version());
        self::assertEquals(Admin::BRAND, $this->admin()->brand());
        self::assertEquals(Admin::LABEL, $this->admin()->label());
        self::assertEquals(Admin::SLOGAN, $this->admin()->slogan());
    }

    public function testApplications()
    {
        self::assertEmpty($this->admin()->applications());
        self::assertCount(1, $this->admin('admin')->applications());
        self::assertCount(2, $this->admin('user')->applications());
        self::assertArrayHasKey('admin', $this->admin()->applications());
        self::assertArrayHasKey('user', $this->admin()->applications());
    }

    /**
     * @throws ApplicationNotFoundException
     * @throws InvalidApplicationNameException
     */
    public function testApplication()
    {
        self::assertNull($this->admin()->application());
        self::expectException(ApplicationNotFoundException::class);
        $this->admin()->application('admin');
        $this->admin()->boot('admin');
        self::assertInstanceOf(Application::class, $this->admin()->application('admin'));
    }

    /**
     * @throws InvalidApplicationNameException
     */
    public function testAdd()
    {
        self::assertCount(0, $this->admin()->applications());
        $this->admin()->add('admin');
        self::assertCount(1, $this->admin()->applications());
        $this->admin()->add('user');
        self::assertCount(2, $this->admin()->applications());
    }

    /**
     * @throws ApplicationNotFoundException
     * @throws InvalidApplicationNameException
     */
    public function testBoot()
    {
        $this->admin()->add('admin');
        $this->admin()->add('user');
        self::assertNull($this->admin()->application());
        $this->admin()->boot('admin');
        self::assertEquals('admin', $this->admin()->name());
        $this->admin()->boot('user');
        self::assertEquals('user', $this->admin()->name());
    }

    public function testPackagePath()
    {
        self::assertEquals(dirname(__DIR__, 2), $this->admin()->packagePath());
        self::assertEquals(dirname(__DIR__, 1), $this->admin()->packagePath('tests'));
    }

    public function testBasePath()
    {
        self::assertEquals(app_path(Admin::DIRECTORY), $this->admin()->basePath());
        self::assertEquals(app_path(Admin::DIRECTORY . DIRECTORY_SEPARATOR . 'Admin'), $this->admin()->basePath('Admin'));
    }

    public function testIndexes()
    {
        self::assertIsArray($this->admin()->indexes());
    }

    public function testName()
    {
        self::assertEquals('admin', $this->admin('admin')->name());
    }

    public function testDirectory()
    {
        self::assertEquals(Application::BASE_DIRECTORY . DIRECTORY_SEPARATOR . 'Admin', $this->admin('admin')->directory());
        self::assertEquals(Application::BASE_DIRECTORY . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'Controllers', $this->admin('admin')->directory('Controllers'));
    }

    public function testPath()
    {
        self::assertEquals(app_path(Application::BASE_DIRECTORY . DIRECTORY_SEPARATOR . 'Admin'), $this->admin('admin')->path());
        self::assertEquals(app_path(Application::BASE_DIRECTORY . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'Controllers'), $this->admin('admin')->path('Controllers'));
    }

    public function testNamespace()
    {
        self::assertEquals('App\\PinAdmin\\Admin', $this->admin('admin')->nameSpace());
        self::assertEquals('App\\PinAdmin\\Admin\\Controllers', $this->admin('admin')->nameSpace('Controllers'));
    }
}
