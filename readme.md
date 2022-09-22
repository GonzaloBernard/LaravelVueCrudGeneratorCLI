# Installation
Copy the generate folder in vendor folder 

# How to run it!
    php path/to/file/code_generator.php EntityClassName entity_database_name [string_attribute[,string_attribute...]] [integer_attribute[,integer_attribute...]] [float_attribute[,float_attribute...]]

Examples:

    php .\vendor\generate\code_generator.php NuevaEntidad nueva_entidad slug,descripcion id,quantity amount

User first_name,last_name years height

    php .\vendor\generate\code_generator.php User user first_name,last_name years height


User first_name,last_name height

    php .\vendor\generate\code_generator.php User user first_name,last_name a height


User height

    php .\vendor\generate\code_generator.php User user a a height


by GonzaloBernard
