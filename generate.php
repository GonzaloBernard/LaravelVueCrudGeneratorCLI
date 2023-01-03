<?php

$options = getopt("hs::i::f::", ["setup", "help"]);

//Show readme on -h --help or no arguments
isset($options['help']) || isset($options['h']) ? include('help.php') : null;

isset($options['setup']) ? include('setup.php') : null;


do{
    $entityName = readline('Entity Name : ');
}
while( $entityName  === '' );
echo "-- $entityName \n";

do{
    $databaseName = readline('DB Table Name : ');
}
while( $databaseName  === '' );
echo "-- $databaseName \n";

$argv[1] = $entityName;
$argv[2] = $databaseName;


$argv[3] = isset($options['s']) ? $options['s'] : readline('String attributes (comma separated) : ');
$argv[4] = isset($options['i']) ? $options['i'] : readline('Integer attributes (comma separated) : ');
$argv[5] = isset($options['f']) ? $options['f'] : readline('Float attributes (comma separated) : ');
$argc = 6;
var_dump($argv);

require('functions.php');
$laravel = readline('Generate PHP Laravel files? (Y/n) : ');
echo "-- $laravel \n";
isset($laravel) && strtoupper($laravel) === 'Y' ? include('code_generator.php') : null;

$vue = readline('Generate Vue files? (Y/n) : ');
echo "-- $vue \n";
isset($vue) && strtoupper($vue) === 'Y' ? include('vue_code_generator.php') : null;
