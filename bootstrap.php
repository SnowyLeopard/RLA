<?php

// Determine the root dir.
$root = dirname(__FILE__);

/** 
 * Propel, the database management system.
 */
require_once 'propel/Propel.php';

// Initialize Propel with the runtime configuration
Propel::init("$root/build/conf/rla-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path("$root/build/classes" . PATH_SEPARATOR . get_include_path());

/**
 * Twig, the template engine.
 */
require_once 'Twig/Autoloader.php';
Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem("$root/templates");
$twig = new Twig_Environment($loader, array(
  'cache' => "$root/.cache",
  'debug' => true,
));

/**
 * Symfony classloader.
 */
require_once 'Symfony/Component/ClassLoader/UniversalClassLoader.php';
use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->useIncludePath(true);
$loader->register();

// Helper functions.
function printr($array)
{
  echo '<pre>' . print_r($array, true) . '</pre>';
}
