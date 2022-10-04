<?php
//////////////////////////////////////// CONFIG ////////////////////////////////////////
//////////////////////////////////////// CONFIG ////////////////////////////////////////

/*# $env = 'production';*/
$env = 'development';

//$prefix = 'vendor/generate/'; // Inside vendor folder
$prefix = ''; // Root folder

$output_vue = 'cruds/';
$output_store = 'store/cruds/';
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
$filetext = readTemplate('Create.vue', $prefix, $entity_name, $name_camelcase, $db_name);

$create_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $create_attributes .= '$table->string(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $create_attributes .= '$table->integer(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $create_attributes .= '$table->float(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = str_replace("// create", $create_attributes, $filetext);
createFile("${output_vue}${entity_name}/Create.vue", $filetext);

// EDIT VUE
$filetext = readTemplate('Edit.vue', $prefix, $entity_name, $name_camelcase, $db_name);

$edit_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $edit_attributes .= '$table->string(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $edit_attributes .= '$table->integer(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $edit_attributes .= '$table->float(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = str_replace("// edit", $edit_attributes, $filetext);
createFile("${output_vue}${entity_name}/Edit.vue", $filetext);

//SHOW VUE

$filetext = readTemplate('Show.vue', $prefix, $entity_name, $name_camelcase, $db_name);

$show_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $show_attributes .= '$table->string(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $show_attributes .= '$table->integer(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $show_attributes .= '$table->float(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = str_replace("// show", $show_attributes, $filetext);
createFile("${output_vue}${entity_name}/Show.vue", $filetext);

// INDEX VUE

$filetext = readTemplate('Index.vue', $prefix, $entity_name, $name_camelcase, $db_name);

$index_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $index_attributes .= '$table->string(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $index_attributes .= '$table->integer(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $index_attributes .= '$table->float(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = str_replace("// index", $index_attributes, $filetext);
createFile("${output_vue}${entity_name}/Index.vue", $filetext);


// Add to vuex store
// store /cruds /{NewEntity}/{index.js single.vue}
/////////////////
mkdir(
    "store/cruds/${entity_name}",
    $recursive = true,
);
$filetext = readTemplate('single.js',$prefix , $entity_name, $name_camelcase, $db_name);

$single_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $single_attributes .= '$table->string(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $single_attributes .= '$table->integer(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $single_attributes .= '$table->float(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = str_replace("// SINGLE", $single_attributes, $filetext);
createFile("${output_store}${entity_name}/single.js", $filetext);

$filetext = readTemplate('index.js',$prefix , $entity_name, $name_camelcase, $db_name);

$index_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $index_attributes .= '$table->string(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $index_attributes .= '$table->integer(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $index_attributes .= '$table->float(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = str_replace("// index", $index_attributes, $filetext);
createFile("${output_store}${entity_name}/index.js", $filetext);



echo "-------------------------------------------------\n";
echo "-- Entity created !!!! \n";
echo "-- apparently \n";
echo "-------------------------------------------------\n";


/////////////////////////////////////////////////////
// FUNCTIONS
/////////////////////////////////////////////////////
function readTemplate($template, $prefix, $entity_name, $name_camelcase, $db_name)
{
    $filename = "${prefix}templates/${template}";
    echo"-- DEBUG:: Reading $filename \n";
    $file = fopen($filename, "r");

    if ($file == false) {
        echo "Error in opening file";
        exit();
    }

    $filesize = filesize($filename);
    $filetext = fread($file, $filesize);
    fclose($file);

    $filetext = str_replace("entity_name", $entity_name, $filetext);
    $filetext = str_replace("name_camelcase", $name_camelcase, $filetext);
    $filetext = str_replace("db_name", $db_name, $filetext);
    return $filetext;
}
function createFile($path, $filetext)
{
    echo"-- DEBUG:: Writing $path \n";
    $index = fopen($path, "w");
    fwrite($index, $filetext);
    fclose($index);
    return true;
}
