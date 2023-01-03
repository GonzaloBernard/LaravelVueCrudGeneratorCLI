<?php
//////////////////////////////////////// CONFIG ////////////////////////////////////////
//////////////////////////////////////// CONFIG ////////////////////////////////////////
require_once('vendor/autoload.php');
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dotenv->required([
    'NAME',
    'routes_js',
    'store_js',
    'dashboard_vue',
    'output_vue',
    'output_store',
    'output_routes_js'
    ])->notEmpty();

$env = $_ENV['ENV'];
$routes_js = $_ENV['routes_js'];
$store_js = $_ENV['store_js'];
$dashboard_vue = $_ENV['dashboard_vue'];
$output_vue = $_ENV['output_vue'];
$output_store = $_ENV['output_store'];
$output_routes_js = $_ENV['output_routes_js'];



/*# $env = 'production';*/
/* $env = 'development';

$routes_js = 'js/routes/routes.js';
$store_js = 'js/store/store.js';
$dashboard_vue = 'js/pages/layout/DashboardLayout.vue';

$output_vue = 'js/cruds/';
$output_store = 'js/store/cruds/'; */
//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ CONFIG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ CONFIG \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

$divider = "--------------------------------------------------------------------------------------------\n";
$entity_name = $argv[1];
$name_camelcase = $argv[1];
$name_camelcase[0] = strtolower($argv[1]);
$db_name = $argv[2];
$time = date('Y_m_d_His');
echo "$divider";
echo "-- Adding VUE files for entity: $entity_name \n";
echo "$divider";

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
echo "\n$divider";
// TODO: improve the setters of the attributes by type


//////////////////////////////////////////////////////////////////////
//                   Read and Edit files                            //
//////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////

// Add menu item
// pages /layout /DashboardLayout.vue
/////////////////

$filetext = readRewritable($dashboard_vue, '', $entity_name, $name_camelcase, $db_name);
$menu_item = "{\n\t\t\t\t\ttitle: '${entity_name}',\n\t\t\t\t\ticon: 'dashboard',\n\t\t\t\t\tpath: {name: '${name_camelcase}.index'},\n\t\t\t\t\t//gate: 'user',\n\t\t\t\t},\n\t\t\t\t// MENU ITEM";
$filetext = str_replace("// MENU ITEM", $menu_item, $filetext);
createFile($dashboard_vue, $filetext);

// Add routes
// routes /routes.js
/////////////////
$filetext = readRewritable($routes_js.'routes.js', '', $entity_name, $name_camelcase, $db_name);

$index = "{\n\t\t\t\tpath: '${name_camelcase}/index',\n\t\t\t\tname: '${name_camelcase}.index',\n\t\t\t\tcomponent: () => import('@cruds/${entity_name}/Index.vue'),\n\t\t\t\tmeta: { title: 'Index ${entity_name}' },\n\t\t\t},\n\t\t\t";
$create = "{\n\t\t\t\tpath: '${name_camelcase}/create',\n\t\t\t\tname: '${name_camelcase}.create',\n\t\t\t\tcomponent: () => import('@cruds/${entity_name}/Create.vue'),\n\t\t\t\tmeta: { title: 'Create ${entity_name}' },\n\t\t\t},\n\t\t\t// NEW VUE ROUTE";

$filetext = str_replace("// NEW VUE ROUTE", $index. $create, $filetext);
createFile($output_routes_js . 'routes.js', $filetext);

// Add module to vuex store
// store /store.js
/////////////////
$filetext = readRewritable($store_js, '', $entity_name, $name_camelcase, $db_name);
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
    $recursive = true
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

$filetext = readTemplate('Create.vue', '', $entity_name, $name_camelcase, $db_name);
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

$filetext = readTemplate('Edit.vue', '', $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// edit", $edit_attributes, $filetext);
createFile("${output_vue}${entity_name}/Edit.vue", $filetext);

//SHOW VUE

$show_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $show_attributes .= "<tr>\n\t\t\t\t\t\t\t\t\t\t\t\t\t<td class='text-primary'>${attribute}</td>\n\t\t\t\t\t\t\t\t\t\t\t\t\t<td>{{ entry.${attribute} }}</td>\n\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t\t\t\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $show_attributes .= "<tr>\n\t\t\t\t\t\t\t\t\t\t\t\t\t<td class='text-primary'>${attribute}</td>\n\t\t\t\t\t\t\t\t\t\t\t\t\t<td>{{ entry.${attribute} }}</td>\n\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t\t\t\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $show_attributes .= "<tr>\n\t\t\t\t\t\t\t\t\t\t\t\t\t<td class='text-primary'>${attribute}</td>\n\t\t\t\t\t\t\t\t\t\t\t\t\t<td>{{ entry.${attribute} }}</td>\n\t\t\t\t\t\t\t\t\t\t\t\t</tr>\n\t\t\t\t\t\t\t\t\t\t\t\t";
    }
}
$show_attributes .= "\n\t\t\t\t\t\t\t\t\t\t\t\t<!-- SHOW TABLE VUE -->";

$filetext = readTemplate('Show.vue', '', $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("<!-- SHOW TABLE VUE -->", $show_attributes, $filetext);
createFile("${output_vue}${entity_name}/Show.vue", $filetext);

// INDEX VUE

$index_vue_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $index_vue_attributes .= "{ text: '$attribute', value: '$attribute' }, \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $index_vue_attributes .= "{ text: '$attribute', value: '$attribute' }, \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $index_vue_attributes .= "{ text: '$attribute', value: '$attribute' }, \n\t\t\t";
    }
}
$index_vue_attributes .= "// INDEX TABLE VUE";

$filetext = readTemplate('Index.vue', '', $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// INDEX TABLE VUE", $index_vue_attributes, $filetext);
createFile("${output_vue}${entity_name}/Index.vue", $filetext);


// Add to vuex store
// store /cruds /{NewEntity}/{index.js single.vue}
/////////////////
mkdir(
    "${output_store}${entity_name}",
    0555,
    $recursive = true
);

$single_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $single_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $single_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $single_attributes .= '' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = readTemplate('single.js', '' , $entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// SINGLE", $single_attributes, $filetext);
createFile("${output_store}${entity_name}/single.js", $filetext);


$index_attributes = "";

if (strlen($string_attributes[0]) > 1) {
    foreach ($string_attributes as $attribute) {
        $index_attributes .= '(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($integer_attributes[0]) > 1) {
    foreach ($integer_attributes as $attribute) {
        $index_attributes .= '(' . "'$attribute'); \n\t\t\t";
    }
}
if (strlen($float_attributes[0]) > 1) {
    foreach ($float_attributes as $attribute) {
        $index_attributes .= '(' . "'$attribute'); \n\t\t\t";
    }
}

$filetext = readTemplate('index.js', '' ,$entity_name, $name_camelcase, $db_name);
$filetext = str_replace("// index", $index_attributes, $filetext);
createFile("${output_store}${entity_name}/index.js", $filetext);



echo "$divider";
echo "$divider";
echo "-- VUE files created !!!! \n";
echo "-- apparently \n";
echo "$divider";
echo "$divider";
echo "-- Developed by GonzaloBernard\n";
echo "$divider";
echo "$divider";
