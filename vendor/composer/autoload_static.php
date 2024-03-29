<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitabb9be144e69567600b18f62b44ecbfe
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PayPal' => 
            array (
                0 => __DIR__ . '/..' . '/paypal/rest-api-sdk-php/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitabb9be144e69567600b18f62b44ecbfe::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitabb9be144e69567600b18f62b44ecbfe::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitabb9be144e69567600b18f62b44ecbfe::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
