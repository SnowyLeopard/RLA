<?php

// Include the main Propel script
require_once 'propel/Propel.php';

// Root rla directory.SRTHYUIKOP;[']
$root = "/home/michon/Coding/Local/rla";

// Initialize Propel with the runtime configuration
Propel::init("$root/build/conf/rla-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path("$root/build/classes" . PATH_SEPARATOR . get_include_path());

// Helper functions.
function printr($array)
{
  echo '<pre>' . print_r($array, true) . '</pre>';
}
