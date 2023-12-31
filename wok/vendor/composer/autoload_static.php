<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfaf64b16956ea3b981b2d5fe2e6592f5
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Automattic\\WooCommerce\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Automattic\\WooCommerce\\' => 
        array (
            0 => __DIR__ . '/..' . '/automattic/woocommerce/src/WooCommerce',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfaf64b16956ea3b981b2d5fe2e6592f5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfaf64b16956ea3b981b2d5fe2e6592f5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
