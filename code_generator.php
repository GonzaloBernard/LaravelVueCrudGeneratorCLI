<?php
//////////////////////////////////////// CONFIG ////////////////////////////////////////
//////////////////////////////////////// CONFIG ////////////////////////////////////////

$env = 'production';
//$env = 'development';

$prefix = 'vendor/generate/'; // Inside vendor folder
//$prefix = ''; // Root folder

/* $output_model_prefix = $output_controller_prefix = $output_store_request_prefix = 
        $output_update_request_prefix = $output_resource_prefix = $output_migration_prefix = 'vendor/generate/dist/'; */
$api_path = 'routes/api.php';
$output_model_prefix = 'app/Models/';
$output_controller_prefix = 'app/Http/Controllers/Api/V1/Admin/';
$output_store_request_prefix = 'app/Http/Requests/';
$output_update_request_prefix = 'app/Http/Requests/';
$output_resource_prefix = 'app/Http/Resources/Admin/';
$output_migration_prefix = 'database/migrations/';
//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ CONFIG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ CONFIG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\


$entity_name = $argv[1];
$name_camelcase = $argv[1];
$name_camelcase[0] = strtolower($argv[1]);
$db_name = $argv[2];
$time = date('Y_m_d_His');
echo "-------------------------------------------------\n";
echo "-- Adding entity: $entity_name \n";
echo "-------------------------------------------------\n";

// TODO: improve the setters of the attributes by type
echo " STRING ATTRIBUTES \n";
$string_attributes = $argc > 3 ? $argv[3] : null;
$string_attributes = explode(',',$string_attributes);
foreach ($string_attributes as $attribute) {
    echo "\t-" . $attribute ;
}
echo "\n INTEGER ATTRIBUTES \n";
$integer_attributes = $argc > 4 ? $argv[4] : null;
$integer_attributes = explode(',',$integer_attributes);
foreach ($integer_attributes as $attribute) {
    echo "\t-" . $attribute  ;
}
echo "\n FLOAT ATTRIBUTES \n";
$float_attributes = $argc > 5  ? $argv[5] : null;
$float_attributes = explode(',',$float_attributes);
foreach ($float_attributes as $attribute) {
    echo "\t-" . $attribute ;
}
echo "\n-------------------------------------------------\n";
// TODO: improve the setters of the attributes by type

// ROUTE API
/////////////////
$filename = "routes/api.php";
$file = fopen($filename, "a" );

if( $file == false ) {
   echo ( "Error in opening file" );
   exit();
}
$file = fopen($filename, "r" );
$filesize = filesize( $filename );
$filetext = fread( $file, $filesize );

// Add the resources to routes/api.php
$api_resource = "\n\t//$entity_name\n\tRoute::resource('$name_camelcase', '${entity_name}ApiController');\n});";
//$api_resource = "";
$filetext = str_replace("});", $api_resource , $filetext);
$file = fopen($filename, "w" );
fwrite($file, $filetext);
//fclose( $file );

// MODEL
//////////////////
$model = fopen("${output_model_prefix}${entity_name}.php", "w");

$filename = "${prefix}templates/model.txt";
$file = fopen($filename, "r" );

if( $file == false ) {
   echo ( "Error in opening file" );
   exit();
}

$filesize = filesize( $filename );
$filetext = fread( $file, $filesize );
fclose( $file );

$filetext = str_replace("entity_name", $entity_name, $filetext);
$filetext = str_replace("db_name", $db_name, $filetext);

$model_attributes = "";

if(strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $model_attributes .= "'$attribute',\n\t\t";
    }
}
if(strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $model_attributes .= "'$attribute',\n\t\t";
    }
}
if(strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $model_attributes .= "'$attribute',\n\t\t";
    }
}



$filetext = str_replace("// MODEL_ATTRIBUTES", $model_attributes, $filetext);
fwrite($model, $filetext);
fclose( $model );

// CONTROLLER
//////////////////
$controller = fopen("${output_controller_prefix}${entity_name}ApiController.php", "w");

$filename = "${prefix}templates/controller.txt";
$file = fopen( $filename, "r" );

if( $file == false ) {
   echo ( "Error in opening file" );
   exit();
}

$filesize = filesize( $filename );
$filetext = fread( $file, $filesize );
fclose( $file );

$filetext = str_replace("entity_name", $entity_name, $filetext);
$filetext = str_replace("name_camelcase", $name_camelcase, $filetext);
$filetext = str_replace("db_name", $db_name, $filetext);

fwrite($controller, $filetext);
fclose( $controller );
// STORE REQUEST
//////////////////
$storeRequest = fopen("${output_store_request_prefix}Store${entity_name}Request.php", "w");

$filename = "${prefix}templates/storeRequest.txt";
$file = fopen( $filename, "r" );

if( $file == false ) {
   echo ( "Error in opening file" );
   exit();
}

$filesize = filesize( $filename );
$filetext = fread( $file, $filesize );
fclose( $file );

$filetext = str_replace("entity_name", $entity_name, $filetext);
$filetext = str_replace("name_camelcase", $name_camelcase, $filetext);
$filetext = str_replace("db_name", $db_name, $filetext);

$store_attributes = "";
if(strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $store_attributes .= "'$attribute' => ['string','nullable',],\n\t\t\t";
    }
}
if(strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $store_attributes .= "'$attribute' => ['integer','nullable',],\n\t\t\t";
    }
}
if(strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $store_attributes .= "'$attribute' => ['number','nullable',],\n\t\t\t";
    }
}
$filetext = str_replace("// REQUEST_ATTRIBUTES", $store_attributes, $filetext);

fwrite($storeRequest, $filetext);
fclose( $storeRequest );
// UPDATE REQUEST
//////////////////
$updateRequest = fopen("${output_update_request_prefix}Update${entity_name}Request.php", "w");

$filename = "${prefix}templates/updateRequest.txt";
$file = fopen( $filename, "r" );

if( $file == false ) {
   echo ( "Error in opening file" );
   exit();
}

$filesize = filesize( $filename );
$filetext = fread( $file, $filesize );
fclose( $file );

$filetext = str_replace("entity_name", $entity_name, $filetext);
$filetext = str_replace("name_camelcase", $name_camelcase, $filetext);
$filetext = str_replace("db_name", $db_name, $filetext);

$update_attributes = "";
if(strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $update_attributes .= "'$attribute' => ['string','nullable',],\n\t\t\t";
    }
}
if(strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $update_attributes .= "'$attribute' => ['integer','nullable',],\n\t\t\t";
    }
}
if(strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $update_attributes .= "'$attribute' => ['number','nullable',],\n\t\t\t";
    }
}
$filetext = str_replace("// REQUEST_ATTRIBUTES", $update_attributes, $filetext);

fwrite($updateRequest, $filetext);
fclose( $updateRequest );
// RESOURCE
//////////////////
$resource = fopen("${output_resource_prefix}${entity_name}Resource.php", "w");

$filename = "${prefix}templates/resource.txt";
$file = fopen( $filename, "r" );

if( $file == false ) {
   echo ( "Error in opening file" );
   exit();
}

$filesize = filesize( $filename );
$filetext = fread( $file, $filesize );
fclose( $file );

$filetext = str_replace("entity_name", $entity_name, $filetext);
$filetext = str_replace("name_camelcase", $name_camelcase, $filetext);
$filetext = str_replace("db_name", $db_name, $filetext);

fwrite($resource, $filetext);
fclose( $resource );
// migration
//////////////////
$migration = fopen("${output_migration_prefix}${time}_create_${db_name}_table.php", "w");

$filename = "${prefix}templates/migration.txt";
$file = fopen( $filename, "r" );

if( $file == false ) {
    echo ( "Error in opening file" );
    exit();
}

$filesize = filesize( $filename );
$filetext = fread( $file, $filesize );
fclose( $file );

$filetext = str_replace("entity_name", $entity_name, $filetext);
$filetext = str_replace("name_camelcase", $name_camelcase, $filetext);
$filetext = str_replace("db_name", $db_name, $filetext);
$migration_attributes = "";

if(strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $migration_attributes .= '$table->string(' . "'$attribute'); \n\t\t\t";
    }
}
if(strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $migration_attributes .= '$table->integer(' . "'$attribute'); \n\t\t\t";
    }
}
if(strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $migration_attributes .= '$table->float(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = str_replace("// DB_ATTRIBUTES", $migration_attributes, $filetext);

fwrite($migration, $filetext);
fclose( $migration );

echo "-------------------------------------------------\n";
echo "-- Entity created !!!! \n";
echo "-- apparently \n";
echo "-------------------------------------------------\n";
?>
