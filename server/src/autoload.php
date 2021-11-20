<?php

function autoload($class){

    $prefix = 'MusicRating\\';

    $baseDir = __DIR__ . '/';

    $len = strlen($prefix);

    if(strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);

    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if(file_exists($file)) {
        require $file;
    }
};

spl_autoload_register('autoload');