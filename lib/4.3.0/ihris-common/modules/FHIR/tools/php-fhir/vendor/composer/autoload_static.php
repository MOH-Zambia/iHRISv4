<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit751092b224674333b6ad5a2bc6adc3ad
{
    public static $files = array (
        '5d07d71ebd9a0601e1781adeec23ac9f' => __DIR__ . '/../..' . '/files/php_fhir_constants.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MyCLabs\\Enum\\' => 13,
        ),
        'D' => 
        array (
            'DCarbone\\PHPFHIR\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MyCLabs\\Enum\\' => 
        array (
            0 => __DIR__ . '/..' . '/myclabs/php-enum/src',
        ),
        'DCarbone\\PHPFHIR\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit751092b224674333b6ad5a2bc6adc3ad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit751092b224674333b6ad5a2bc6adc3ad::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
