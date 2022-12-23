# set up
    cp .env.example .env
    php setup.php

# check setup
    php code_generator.php HelloWorld hello-world

    php vue_code_generator.php HelloWorld hello-world


# Outputing files into specific installed project
Edit .env to match project folders

# How to run it!
    php path/to/file/code_generator.php EntityClassName entity_database_name [string_attribute[,string_attribute...]] [integer_attribute[,integer_attribute...]] [float_attribute[,float_attribute...]]
    php path/to/file/vue_code_generator.php EntityClassName entity_database_name [string_attribute[,string_attribute...]] [integer_attribute[,integer_attribute...]] [float_attribute[,float_attribute...]]


# Examples:

    php code_generator.php NuevaEntidad nueva_entidad slug,descripcion id,quantity amount
    php vue_code_generator.php NuevaEntidad nueva_entidad slug,descripcion id,quantity amount

# All types (String, Integer and Float)
- first_name   String
- last_name    String
- age          Integer
- height       Float
#
    php code_generator.php User user first_name,last_name age height
    php vue_code_generator.php User user first_name,last_name age height
    

# Only Strings
- first_name   String
- last_name    String

#
    php code_generator.php User user first_name,last_name
    php vue_code_generator.php User user first_name,last_name
    

# Only Floats
- height   Float
- weight   Float

#
    php code_generator.php User user a a height,weight
    php vue_code_generator.php User user a a height,weight
    

After that, run migrations!


# Vue Time



by GonzaloBernard
