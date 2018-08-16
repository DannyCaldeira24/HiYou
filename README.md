# HiYou
Red social elaborado en PHP del lado de servidor con el framework symfony4, ahora del lado del cliente javascript con jQuery y AJAX para hacer peticiones asincronas al servidor y a efectos de no recargar la pagina.
Del lado del front-end trabajaremos con el framework boostrap en su version 4 para la elaboración de interfaces.

Pasos a seguir para montar el servidor:
Una vez ubicados en C:\xampp\htdocs desde nuestro terminal (Es necesario tener instalado XAMPP para montar nuestro servidor Apache y Mysql)
Ingresar el siguiente comando para crear la estructura de nuestro proyecto con el framework symfony4
	composer create-project symfony/website-skeleton HiYou
Luego debemos movernos a la carpeta de nuestro proyecto
	cd HiYou
y posteriormente correr nuestro servidor
	php -S 127.0.0.1:8000 -t public
Listo, si queremos acceder a nuestro proyecto (una vez tenemos nuestro servidor apache corriendo y nuestra base de datos Mysql con XAMPP) desde el URL de nuestro navegador escribimos http://localhost/HiYou/ y una vez aqui accedemos a la carpeta public o simplemente en la URL de nuestro navegador escribimos http://localhost:8000/.

Crear controlador:
	php bin/console make:controller
Crear entidad:
	php bin/console make:entity
Crear migration de la DB:
	php bin/console make:migration
Ejecutar la migración en nuestra DB:
	php bin/console doctrine:migrations:migrate

PROYECTO EN STANDBY	