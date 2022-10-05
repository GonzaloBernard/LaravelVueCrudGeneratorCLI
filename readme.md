# Installation
Copy the generate folder in vendor folder 

# How to run it!
    php path/to/file/code_generator.php EntityClassName entity_database_name [string_attribute[,string_attribute...]] [integer_attribute[,integer_attribute...]] [float_attribute[,float_attribute...]]

# Examples:

    php .\vendor\generate\code_generator.php NuevaEntidad nueva_entidad slug,descripcion id,quantity amount

Attrs:
- first_name   String
- last_name    String
- age          Integer
- height       Float
#
    php .\vendor\generate\code_generator.php User user first_name,last_name age height


# User first_name,last_name height

    php .\vendor\generate\code_generator.php User user first_name,last_name a height


# User height

    php .\vendor\generate\code_generator.php User user a a height


After that, run migrations!


# Vue Time

# Examples:
    using Laravel php exe

    ..\..\bin\php\php-7.4.19-Win32-vc15-x64\php.exe vue_code_generator.php Producto producto descripcion categoria_id precio

by GonzaloBernard
