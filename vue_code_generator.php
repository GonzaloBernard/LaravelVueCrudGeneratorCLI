<?php
//////////////////////////////////////// CONFIG ////////////////////////////////////////
//////////////////////////////////////// CONFIG ////////////////////////////////////////

/*# $env = 'production';*/
$env = 'development';

//$prefix = 'vendor/generate/'; // Inside vendor folder
$prefix = ''; // Root folder

$routes_js = 'js/routes/routes.js';
$store_js = 'js/store/store.js';
$dashboard_vue = 'js/pages/layout/DashboardLayout.vue';

$output_vue = 'js/cruds/';
$output_store = 'js/store/cruds/';
//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ CONFIG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ CONFIG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

$divider = '-------------------------------------------------';
$entity_name = $argv[1];
$name_camelcase = $argv[1];
$name_camelcase[0] = strtolower($argv[1]);
$db_name = $argv[2];
$time = date('Y_m_d_His');
echo "$divider\n";
echo "-- Adding entity: $entity_name \n";
echo "$divider\n";

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
echo "\n$divider\n";
// TODO: improve the setters of the attributes by type


//////////////////////////////////////////////////////////////////////
//                   Read and Edit files                            //
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////

// Add menu item
// pages /layout /DashboardLayout.vue
/////////////////

// Add routes
// routes /routes.js
/////////////////
$filetext = readTemplate($routes_js, '', $entity_name, $name_camelcase, $db_name);
$route = "{\n\t\t\tpath: '${name_camelcase}Show',\n\t\t\t\tname: '${name_camelcase}Show',\n\t\t\t\tcomponent: () => import('@pages/${entity_name}.vue'),\n\t\t\t\tmeta: { title: 'Información del ${entity_name}' },\n\t\t\t},\n\t\t\t// NEW VUE ROUTE";

$filetext = str_replace("// NEW VUE ROUTE", $route, $filetext);
createFile($routes_js, $filetext);

// Add module to vuex store
// store /store.js
/////////////////
$filetext = readTemplate($store_js, '', $entity_name, $name_camelcase, $db_name);
$imports = "import ${entity_name}Index from './cruds/${entity_name}/index';\nimport ${entity_name}Single from './cruds/${entity_name}/single';\n// NEW STORE IMPORTS";
$module = "${entity_name}Index,\n\t\t${entity_name}Single,\n\t\t// NEW STORE MODULE";

$filetext = str_replace("// NEW STORE IMPORTS", $imports, $filetext);
$filetext = str_replace("// NEW STORE MODULE", $module, $filetext);
createFile($store_js, $filetext);

//////////////////////////////////////////////////////////////////////
//                      Create files                                //
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////

// Add views
// cruds /{NewEntity}/{Index.vue Show.vue Create.vue Edit.vue}
/////////////////
mkdir(
    "${output_vue}${entity_name}",
    $recursive = true,
);

$create_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $create_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $create_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $create_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = readTemplate('templates/Create.vue', '', $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// create", $create_attributes, $filetext);
createFile("${output_vue}${entity_name}/Create.vue", $filetext);

// EDIT VUE

$edit_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $edit_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $edit_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $edit_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = readTemplate('templates/Edit.vue', '', $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// edit", $edit_attributes, $filetext);
createFile("${output_vue}${entity_name}/Edit.vue", $filetext);

//SHOW VUE


$show_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $show_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $show_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $show_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = readTemplate('templates/Show.vue', '', $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// show", $show_attributes, $filetext);
createFile("${output_vue}${entity_name}/Show.vue", $filetext);

// INDEX VUE


$index_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $index_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $index_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $index_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = readTemplate('templates/Index.vue', '', $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// index", $index_attributes, $filetext);
createFile("${output_vue}${entity_name}/Index.vue", $filetext);


// Add to vuex store
// store /cruds /{NewEntity}/{index.js single.vue}
/////////////////
mkdir(
    "${output_store}${entity_name}",
    $recursive = true,
);

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

$filetext = readTemplate('templates/single.js', '' , $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// SINGLE", $single_attributes, $filetext);
createFile("${output_store}${entity_name}/single.js", $filetext);


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

$filetext = readTemplate('templates/index.js', '' ,$entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// index", $index_attributes, $filetext);
createFile("${output_store}${entity_name}/index.js", $filetext);



echo "$divider\n";
echo "-- Entity created !!!! \n";
echo "-- apparently \n";
echo "$divider\n";


/////////////////////////////////////////////////////
// FUNCTIONS
/////////////////////////////////////////////////////
function readTemplate($template, $prefix, $entity_name, $name_camelcase, $db_name)
{
    $filename = "${template}";
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
