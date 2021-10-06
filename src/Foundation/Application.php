<?php

namespace CodeSinging\PinAdmin\Foundation;

use CodeSinging\PinAdmin\Exceptions\InvalidApplicationNameException;
use Illuminate\Support\Str;

class Application
{
    /**
     * The base directory relative to `app`.
     */
    const BASE_DIRECTORY = Admin::DIRECTORY;

    /**
     * Application name.
     * @var string
     */
    protected $name;

    /**
     * The application directory relative to the `app` directory.
     * @var string
     */
    protected $directory;

    /**
     * The application path.
     * @var string
     */
    protected $path;

    /**
     * @param string $name
     * @throws InvalidApplicationNameException
     */
    public function __construct(string $name)
    {
        if (self::verifyName($name)) {
            $this->init($name);
        } else {
            throw new InvalidApplicationNameException(sprintf('The application name [%s] is invalid', $name));
        }
    }

    /**
     * Verify if the application name is valid.
     *
     * @param string $name
     *
     * @return bool
     */
    public static function verifyName(string $name): bool
    {
        if (empty($name)) {
            return false;
        }

        return preg_match('/^[a-zA-Z]+\w*$/', $name) === 1;
    }

    /**
     * Initialize the application.
     * @param string $name
     */
    protected function init(string $name)
    {
        $this->name = $name;
        $this->directory = self::BASE_DIRECTORY . DIRECTORY_SEPARATOR . Str::studly($name);
    }

    /**
     * Get the application's name.
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * Get the application's directory.
     * @param string $path
     * @return string
     */
    public function directory(string $path = ''): string
    {
        return $this->directory. ($path ? DIRECTORY_SEPARATOR . $path : '');
    }

    /**
     * Get the application's path.
     * @param string $path
     * @return string
     */
    public function path(string $path = ''): string
    {
        return app_path($this->directory($path));
    }

    /**
     * Get the application's namespace.
     * @param string $path
     * @return string
     */
    public function nameSpace(string $path = ''): string
    {
        return implode('\\', ['App', str_replace('/', '\\', $this->directory($path))]);
    }
}