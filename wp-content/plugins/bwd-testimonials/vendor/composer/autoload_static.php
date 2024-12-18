<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class tbtComposerStaticInit90b8e30777f98d734204dada5f8545e1
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'Appsero\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Appsero\\' => 
        array (
            0 => __DIR__ . '/..' . '/appsero/client/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = tbtComposerStaticInit90b8e30777f98d734204dada5f8545e1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = tbtComposerStaticInit90b8e30777f98d734204dada5f8545e1::$prefixDirsPsr4;
            $loader->classMap = tbtComposerStaticInit90b8e30777f98d734204dada5f8545e1::$classMap;

        }, null, ClassLoader::class);
    }
}
