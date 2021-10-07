<?php

namespace CodeSinging\PinAdmin\Tests\Foundation;

use CodeSinging\PinAdmin\Foundation\Application;
use CodeSinging\PinAdmin\Tests\TestCase;

class ApplicationTest extends TestCase
{
    public function testVerifyName()
    {
        self::assertTrue(Application::verifyName('admin'));
        self::assertTrue(Application::verifyName('admin123'));
        self::assertTrue(Application::verifyName('admin_user'));
        self::assertTrue(Application::verifyName('adminUser'));

        self::assertFalse(Application::verifyName('123'));
        self::assertFalse(Application::verifyName('123admin'));
        self::assertFalse(Application::verifyName('123_admin'));
        self::assertFalse(Application::verifyName('admin.123'));
        self::assertFalse(Application::verifyName('admin-user'));
        self::assertFalse(Application::verifyName('admin/user'));
        self::assertFalse(Application::verifyName('admin.user'));
    }

    public function testName()
    {
        $application = new Application('admin');
        self::assertEquals('admin', $application->name());
    }

    public function testDirectory()
    {
        $application = new Application('admin');

        self::assertEquals(Application::BASE_DIRECTORY . DIRECTORY_SEPARATOR . 'Admin', $application->directory());
        self::assertEquals(Application::BASE_DIRECTORY . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'Controllers', $application->directory('Controllers'));
        self::assertEquals(Application::BASE_DIRECTORY . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'IndexController.php', $application->directory('Controllers', 'IndexController.php'));
    }

    public function testPath()
    {
        $application = new Application('admin');

        self::assertEquals(app_path(Application::BASE_DIRECTORY . DIRECTORY_SEPARATOR . 'Admin'), $application->path());
        self::assertEquals(app_path(Application::BASE_DIRECTORY . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'Controllers'), $application->path('Controllers'));
        self::assertEquals(app_path(Application::BASE_DIRECTORY . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . 'IndexController.php'), $application->path('Controllers', 'IndexController.php'));
    }

    public function testNamespace()
    {
        self::assertEquals('App\\PinAdmin\\Admin', (new Application('admin'))->nameSpace());
        self::assertEquals('App\\PinAdmin\\Admin\\Controllers', (new Application('admin'))->nameSpace('Controllers'));
        self::assertEquals('App\\PinAdmin\\Admin\\Controllers\\IndexController.php', (new Application('admin'))->nameSpace('Controllers', 'IndexController.php'));
    }
}
