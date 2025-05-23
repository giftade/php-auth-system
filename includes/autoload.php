<?php 
spl_autoload_register(function ($class) {
// base directory for your src folder
$baseDir = __DIR__ . '/../src/';

// possible subfolders to search for class files
$folders = ['Models', 'Core', 'Utils'];

foreach ($folders as $folder) {
$path = $baseDir . $folder . '/' . $class . '.php';
if (file_exists($path)) {
require_once $path;
return; // stop after loading
}
}

// If class file not found in any folder
die("Autoload error: Class file for '{$class}' not found in any of the folders.");
});