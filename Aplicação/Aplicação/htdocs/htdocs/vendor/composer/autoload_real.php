<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit7c57a7a01ca4a2b8c82b2449d2f83fbe
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInit7c57a7a01ca4a2b8c82b2449d2f83fbe', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit7c57a7a01ca4a2b8c82b2449d2f83fbe', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit7c57a7a01ca4a2b8c82b2449d2f83fbe::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
