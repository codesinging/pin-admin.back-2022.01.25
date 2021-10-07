<?php

namespace CodeSinging\PinAdmin\Foundation;

use CodeSinging\PinAdmin\Exceptions\ApplicationNotFoundException;
use CodeSinging\PinAdmin\Exceptions\InvalidApplicationNameException;

/**
 * @method string name()
 * @method string directory(string ...$paths)
 * @method string path(string ...$paths)
 * @method string nameSpace(string ...$paths)
 */
class Admin
{
    /**
     * The version of PinAdmin.
     */
    const VERSION = '1.0.0';

    /**
     * The brand name of PinAdmin.
     */
    const BRAND = 'PinAdmin';

    /**
     * The slogan of PinAdmin.
     */
    const SLOGAN = 'Rapidly build administrative application based on Laravel';

    /**
     * The label of PinAdmin.
     */
    const LABEL = 'admin';

    /**
     * The file name of application indexes.
     */
    const INDEX_FILENAME = 'indexes.php';

    /**
     * The PinAdmin directory relative to `app`.
     */
    const DIRECTORY = 'PinAdmin';

    /**
     * All the PinAdmin applications.
     * @var Application[]
     */
    protected $applications = [];

    /**
     * The current PinAdmin application.
     * @var Application
     */
    protected $application;

    /**
     * Get the version of PinAdmin.
     * @return string
     */
    public function version(): string
    {
        return self::VERSION;
    }

    /**
     * Get the brand of PinAdmin.
     * @return string
     */
    public function brand(): string
    {
        return self::BRAND;
    }

    /**
     * Get the slogan of PinAdmin.
     * @return string
     */
    public function slogan(): string
    {
        return self::SLOGAN;
    }

    /**
     * Get the label of PinAdmin.
     * @param string $suffix
     * @param string $separator
     * @return string
     */
    public function label(string $suffix = '', string $separator = '_'): string
    {
        return self::LABEL . ($suffix ? $separator . $suffix : '');
    }

    /**
     * Get all the applications.
     * @return Application[]
     */
    public function applications(): array
    {
        return $this->applications;
    }

    /**
     * Get the current or the specified application.
     * @param string|null $name
     * @return Application|null
     * @throws ApplicationNotFoundException
     */
    public function application(string $name = null): ?Application
    {
        if (is_null($name)) {
            return $this->application;
        }
        if (isset($this->applications[$name])) {
            return $this->applications[$name];
        }
        throw new ApplicationNotFoundException(sprintf('Application[%s] not found', $name));
    }

    /**
     * Add a PinAdmin application.
     * @param string $name
     * @throws InvalidApplicationNameException
     */
    public function add(string $name): void
    {
        if (empty($this->applications[$name])) {
            $this->applications[$name] = new Application($name);
        }
    }

    /**
     * Bootstrap a PinAdmin application.
     * @throws InvalidApplicationNameException
     */
    public function boot(string $name)
    {
        if (empty($this->applications[$name])) {
            $this->add($name);
        }
        $this->application = $this->applications[$name];
    }

    /**
     * Get the package path of PinAdmin.
     * @param string ...$paths
     * @return string
     */
    public function packagePath(...$paths): string
    {
        array_unshift($paths, dirname(__DIR__, 2));
        return implode(DIRECTORY_SEPARATOR, $paths);
    }

    /**
     * The base path of the PinAdmin applications.
     * @param string ...$paths
     * @return string
     */
    public function basePath(...$paths): string
    {
        array_unshift($paths, self::DIRECTORY);
        return app_path(implode(DIRECTORY_SEPARATOR, $paths));
    }

    /**
     * Get the indexes of all applications.
     * @return array
     */
    public function indexes(): array
    {
        if (file_exists($file = $this->basePath(self::INDEX_FILENAME))) {
            return include($file);
        }
        return [];
    }

    /**
     * Determine if the PinAdmin package is installed.
     * @return bool
     */
    public function isInstalled(): bool
    {
        return file_exists($this->basePath(self::INDEX_FILENAME));
    }

    /**
     * Call the application's methods.
     * @param $name
     * @param $arguments
     * @return false|mixed
     */
    public function __call($name, $arguments)
    {
        if ($this->application) {
            return $this->application->$name(...$arguments);
        }
    }
}