<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitf0d37fd78f64e1f791262abbf9b3200d
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

        spl_autoload_register(array('ComposerAutoloaderInitf0d37fd78f64e1f791262abbf9b3200d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitf0d37fd78f64e1f791262abbf9b3200d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitf0d37fd78f64e1f791262abbf9b3200d::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
