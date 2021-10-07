<?php

namespace CodeSinging\PinAdmin\Foundation;

use CodeSinging\PinAdmin\Exceptions\AdminException;
use Illuminate\Support\Str;

class Application
{
    /**
     * The base directory relative to `app`.
     */
    const BASE_DIRECTORY = Admin::DIRECTORY;

    /**
     * The route filename of the application.
     */
    const ROUTE_FILENAME = 'routes.php';

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
     * The application bootstrap options.
     * @var array
     */
    protected $options = [];

    /**
     * @param string $name
     * @param array $options
     * @throws AdminException
     */
    public function __construct(string $name, array $options = [])
    {
        if (self::verifyName($name)) {
            $this->init($name, $options);
        } else {
            throw new AdminException(sprintf('The application name [%s] is invalid', $name));
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
     * @param array $options
     */
    protected function init(string $name, array $options = [])
    {
        $this->name = $name;
        $this->options = $options;
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
     * Get the application's directory relative to `app`.
     * @param string ...$paths
     * @return string
     */
    public function directory(...$paths): string
    {
        array_unshift($paths, $this->directory);
        return implode(DIRECTORY_SEPARATOR, $paths);
    }

    /**
     * Get the application's path.
     * @param string ...$paths
     * @return string
     */
    public function path(...$paths): string
    {
        return app_path($this->directory(...$paths));
    }

    /**
     * Get the application's namespace.
     * @param string ...$paths
     * @return string
     */
    public function nameSpace(...$paths): string
    {
        return implode('\\', ['App', str_replace('/', '\\', $this->directory(...$paths))]);
    }

    /**
     * Get the route prefix.
     * @return string
     */
    public function routePrefix(): string
    {
        return $this->options['prefix'] ?? $this->name;
    }

    /**
     * Get absolute link url.
     * @param string $path
     * @param array $parameters
     * @return string
     */
    public function link(string $path = '', array $parameters = []): string
    {
        $link = '/' . $this->routePrefix();
        if ($path) {
            $link .= Str::start($path, '/');
        }
        if ($parameters) {
            $link .= '?' . http_build_query($parameters);
        }
        return $link;
    }
}