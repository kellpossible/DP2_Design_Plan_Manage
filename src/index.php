<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('vendor/autoload.php');

echo("<h1>Index</h1>");
echo('<a href="test_templates.php">Test Templates</a><br>');
echo('<a href="test_models.php">Test Models</a><br>');
echo('<a href="test_controllers.php">Test Controllers</a>');

?>