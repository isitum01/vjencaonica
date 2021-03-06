<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4be4b89465950261927d6dbec57b475a
{
    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Ew\\WpHelpers\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ew\\WpHelpers\\' => 
        array (
            0 => __DIR__ . '/..' . '/enterwell/wp-helpers/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4be4b89465950261927d6dbec57b475a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4be4b89465950261927d6dbec57b475a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4be4b89465950261927d6dbec57b475a::$classMap;

        }, null, ClassLoader::class);
    }
}
