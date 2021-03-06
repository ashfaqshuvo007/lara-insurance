<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb252b6ac86d1fc1a5a23839c39525416
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'The7CLI\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'The7CLI\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'The7CLI\\Commands\\The7Core\\DB' => __DIR__ . '/../..' . '/src/Commands/The7Core/DB.php',
        'The7CLI\\Commands\\The7\\Cache' => __DIR__ . '/../..' . '/src/Commands/The7/Cache.php',
        'The7CLI\\Commands\\The7\\DB' => __DIR__ . '/../..' . '/src/Commands/The7/DB.php',
        'The7CLI\\Commands\\The7\\Images' => __DIR__ . '/../..' . '/src/Commands/The7/Images.php',
        'The7CLI\\Commands\\The7\\Option' => __DIR__ . '/../..' . '/src/Commands/The7/Option.php',
        'The7CLI\\Commands\\The7\\PostMeta' => __DIR__ . '/../..' . '/src/Commands/The7/PostMeta.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb252b6ac86d1fc1a5a23839c39525416::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb252b6ac86d1fc1a5a23839c39525416::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb252b6ac86d1fc1a5a23839c39525416::$classMap;

        }, null, ClassLoader::class);
    }
}
