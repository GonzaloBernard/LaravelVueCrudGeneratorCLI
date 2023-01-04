<?php
function readRewritable($template, $entity_name, $name_camelcase, $db_name)
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
function readTemplate($template, $entity_name, $name_camelcase, $db_name)
{
    $filename = "{$_ENV['templates_folder']}${template}";
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