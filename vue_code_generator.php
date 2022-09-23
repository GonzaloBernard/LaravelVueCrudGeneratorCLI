<?php
//////////////////////////////////////// CONFIG ////////////////////////////////////////
//////////////////////////////////////// CONFIG ////////////////////////////////////////

//$env = 'production';
$env = 'development';

//$prefix = 'vendor/generate/'; // Inside vendor folder
$prefix = ''; // Root folder

/* $output_model_prefix = $output_controller_prefix = $output_store_request_prefix = 
        $output_update_request_prefix = $output_resource_prefix = $output_migration_prefix = 'vendor/generate/dist/'; */
$api_path = 'routes/api.php';
$output_create = 'cruds/';
$output_index = $output_single = 'store/cruds/';
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


//////////////////////////////////////////////////////////////////////
//                   Read and Edit files                            //
// ---------------------------------------------------------------- //
//////////////////////////////////////////////////////////////////////

// Add menu item
// pages /layout /DashboardLayout.vue
/////////////////

// Add routes
// routes /routes.js
/////////////////

// Add module to vuex store
// store /store.js
/////////////////

//////////////////////////////////////////////////////////////////////
//                      Create files                                //
// ---------------------------------------------------------------- //
//////////////////////////////////////////////////////////////////////

// Add views
// cruds /{NewEntity}/{Index.vue Show.vue Create.vue Edit.vue}
/////////////////
mkdir(
    "cruds/${entity_name}",
    $recursive = true,
);
$filetext = readTemplate('create.txt',$prefix , $entity_name, $name_camelcase, $db_name);
echo "-$filetext-\n";

$create_attributes = "";

if(strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $create_attributes .= '$table->string(' . "'$attribute'); \n\t\t\t";
    }
}
if(strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $create_attributes .= '$table->integer(' . "'$attribute'); \n\t\t\t";
    }
}
if(strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $create_attributes .= '$table->float(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = str_replace("// create", $create_attributes, $filetext);
$create = fopen("${output_create}${entity_name}/Create.vue", "w");
fwrite($create, $filetext);
fclose( $create );


// Add to vuex store
// store /cruds /{NewEntity}/{index.js single.vue}
/////////////////
mkdir(
    "store/cruds/${entity_name}",
    $recursive = true,
);
$filetext = readTemplate('single.txt',$prefix , $entity_name, $name_camelcase, $db_name);
//echo "-$filetext-\n";

$single_attributes = "";

if(strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $single_attributes .= '$table->string(' . "'$attribute'); \n\t\t\t";
    }
}
if(strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $single_attributes .= '$table->integer(' . "'$attribute'); \n\t\t\t";
    }
}
if(strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $single_attributes .= '$table->float(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = str_replace("// SINGLE", $single_attributes, $filetext);
$single = fopen("${output_single}${entity_name}/single.js", "w");
fwrite($single, $filetext);
fclose( $single );

$filetext = readTemplate('index.txt',$prefix , $entity_name, $name_camelcase, $db_name);
//echo "-$filetext-\n";

$index_attributes = "";

if(strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $index_attributes .= '$table->string(' . "'$attribute'); \n\t\t\t";
    }
}
if(strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $index_attributes .= '$table->integer(' . "'$attribute'); \n\t\t\t";
    }
}
if(strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $index_attributes .= '$table->float(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = str_replace("// index", $index_attributes, $filetext);
$index = fopen("${output_index}${entity_name}/index.js", "w");
fwrite($index, $filetext);
fclose( $index );



echo "-------------------------------------------------\n";
echo "-- Entity created !!!! \n";
echo "-- apparently \n";
echo "-------------------------------------------------\n";


/////////////////////////////////////////////////////
// FUNCTIONS
/////////////////////////////////////////////////////
function readTemplate($template, $prefix , $entity_name, $name_camelcase, $db_name){
    $filename = "${prefix}templates/${template}";
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
    return $filetext;
}

?>
