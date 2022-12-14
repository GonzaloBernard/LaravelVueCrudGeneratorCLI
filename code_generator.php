<?php
//////////////////////////////////////// CONFIG ////////////////////////////////////////
//////////////////////////////////////// CONFIG ////////////////////////////////////////
require_once('vendor/autoload.php');
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required([
    'NAME',
    'output_model_prefix',
    'output_controller_prefix',
    'output_store_request_prefix',
    'output_update_request_prefix',
    'output_resource_prefix',
    'output_migration_prefix'
    ])->notEmpty();

$env = $_ENV['ENV'];
$output_model_prefix = $_ENV['output_model_prefix'];
$output_controller_prefix = $_ENV['output_controller_prefix'];
$output_store_request_prefix = $_ENV['output_store_request_prefix'];
$output_update_request_prefix = $_ENV['output_update_request_prefix'];
$output_resource_prefix = $_ENV['output_resource_prefix'];
$output_migration_prefix = $_ENV['output_migration_prefix'];

$api_route_prefix = $_ENV['api_route_prefix'];

//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ CONFIG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ CONFIG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
$divider = "--------------------------------------------------------------------------------------------\n";

$entity_name = $argv[1];
$name_camelcase = $argv[1];
$name_camelcase[0] = strtolower($argv[1]);
$db_name = $argv[2];
$time = date('Y_m_d_His');
echo $divider;
echo "-- Adding entity: $entity_name \n";
echo $divider;

// TODO: improve the setters of the attributes by type
echo " STRING ATTRIBUTES \n";
$string_attributes = $argc > 3 ? $argv[3] : null;
$string_attributes = explode(',', $string_attributes);
foreach ($string_attributes as $attribute) {
    echo "\t-" . $attribute ;
}
echo "\n INTEGER ATTRIBUTES \n";
$integer_attributes = $argc > 4 ? $argv[4] : null;
$integer_attributes = explode(',', $integer_attributes);
foreach ($integer_attributes as $attribute) {
    echo "\t-" . $attribute  ;
}
echo "\n FLOAT ATTRIBUTES \n";
$float_attributes = $argc > 5  ? $argv[5] : null;
$float_attributes = explode(',', $float_attributes);
foreach ($float_attributes as $attribute) {
    echo "\t-" . $attribute ;
}
echo "\n-------------------------------------------------\n";
// TODO: improve the setters of the attributes by type

// ROUTE API
/////////////////
$filename = "{$api_route_prefix}api.php";
$file = fopen($filename, "a");

if ($file == false) {
   echo "Error in opening file";
   exit();
}
$file = fopen($filename, "r");
$filesize = filesize($filename);
$filetext = fread($file, $filesize);

// Add the resources to api.php
$api_resource = "\n\t//$entity_name\n\tRoute::resource('$name_camelcase', '${entity_name}ApiController');\n});";
//#$api_resource = "";
$filetext = str_replace("});", $api_resource, $filetext);

createFile("{$api_route_prefix}api.php", $filetext);

// MODEL
//////////////////
$model_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $model_attributes .= "'$attribute',\n\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $model_attributes .= "'$attribute',\n\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $model_attributes .= "'$attribute',\n\t\t";
    }
}


$filetext = readTemplate("model.php",  $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// MODEL_ATTRIBUTES", $model_attributes, $filetext);
createFile("${output_model_prefix}${entity_name}.php", $filetext);

// CONTROLLER
//////////////////

$filetext = readTemplate("controller.php",  $entity_name, $name_camelcase, $db_name);
createFile("${output_controller_prefix}${entity_name}ApiController.php", $filetext);

// STORE REQUEST
//////////////////
$store_attributes = "";
if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $store_attributes .= "'$attribute' => ['string','nullable',],\n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $store_attributes .= "'$attribute' => ['integer','nullable',],\n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $store_attributes .= "'$attribute' => ['number','nullable',],\n\t\t\t";
    }
}

$filetext = readTemplate("storeRequest.php",  $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// REQUEST_ATTRIBUTES", $store_attributes, $filetext);
createFile("${output_store_request_prefix}Store${entity_name}Request.php", $filetext);


// UPDATE REQUEST
//////////////////
$update_attributes = "";
if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $update_attributes .= "'$attribute' => ['string','nullable',],\n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $update_attributes .= "'$attribute' => ['integer','nullable',],\n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $update_attributes .= "'$attribute' => ['number','nullable',],\n\t\t\t";
    }
}

$filetext = readTemplate("updateRequest.php",  $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// REQUEST_ATTRIBUTES", $update_attributes, $filetext);
createFile("${output_update_request_prefix}Update${entity_name}Request.php", $filetext);

// RESOURCE
//////////////////
$filetext = readTemplate("resource.php",  $entity_name, $name_camelcase, $db_name);
createFile("${output_resource_prefix}${entity_name}Resource.php", $filetext);

// migration
//////////////////
$migration_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $migration_attributes .= '$table->string(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $migration_attributes .= '$table->integer(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $migration_attributes .= '$table->float(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = readTemplate("migration.php",  $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// DB_ATTRIBUTES", $migration_attributes, $filetext);

createFile("${output_migration_prefix}${time}_create_${db_name}_table.php", $filetext);

echo "$divider";
echo "$divider";
echo "-- Entity created !!!! \n";
echo "-- apparently \n";
echo "$divider";
echo "$divider";
echo "-- Developed by GonzaloBernard\n";
echo "$divider";
echo "$divider";

