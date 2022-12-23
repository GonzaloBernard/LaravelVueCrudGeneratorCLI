<?php
//////////////////////////////////////// CONFIG ////////////////////////////////////////
//////////////////////////////////////// CONFIG ////////////////////////////////////////
require_once('vendor/autoload.php');
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required([
    'prefix'
]);
$dotenv->required([
    'NAME',
    'output_model_prefix',
    'output_controller_prefix',
    'output_store_request_prefix',
    'output_update_request_prefix',
    'output_resource_prefix',
    'output_migration_prefix',
    'output_api_route_prefix'
    ])->notEmpty();

$env = $_ENV['ENV'];
$output_model_prefix = $_ENV['output_model_prefix'];
$output_controller_prefix = $_ENV['output_controller_prefix'];
$output_store_request_prefix = $_ENV['output_store_request_prefix'];
$output_update_request_prefix = $_ENV['output_update_request_prefix'];
$output_resource_prefix = $_ENV['output_resource_prefix'];
$output_migration_prefix = $_ENV['output_migration_prefix'];
$output_api_route_prefix = $_ENV['output_api_route_prefix'];
$prefix = $_ENV['prefix'];
$api_route_prefix = $_ENV['api_route_prefix'];
//@deprecated
//$prefix = 'vendor/generate/'; // Inside vendor folder

//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ CONFIG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ CONFIG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


// CREATE FOLDERS

mkdir($output_model_prefix,  $mode = 0555, $recursive = true);
mkdir($output_controller_prefix,  $mode = 0555, $recursive = true);
mkdir($output_store_request_prefix,  $mode = 0555, $recursive = true);
mkdir($output_resource_prefix,  $mode = 0555, $recursive = true);
mkdir($output_migration_prefix,  $mode = 0555, $recursive = true);
mkdir($output_api_route_prefix,  $mode = 0555, $recursive = true);

copy('setup/api.php', "{$output_api_route_prefix}api.php");
