<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2ef74289a53ae438e49f7f0265a2bc2
{
    public static $prefixesPsr0 = array (
        'D' => 
        array (
            'Dispatch' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitc2ef74289a53ae438e49f7f0265a2bc2::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
