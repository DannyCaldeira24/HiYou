# HiYou
Red social elaborado en PHP del lado de servidor con el framework symfony3, ahora del lado del cliente javascript con jQuery y AJAX para hacer peticiones asincronas al servidor y a efectos de no recargar la pagina.
Del lado del front-end trabajaremos con el framework boostrap en su version 4 para la elaboración de interfaces.

Pasos a seguir para montar el servidor:
Una vez ubicados en C:\xampp\htdocs desde nuestro terminal (Es necesario tener instalado XAMPP para montar nuestro servidor Apache y Mysql)

//Configuración de symfony

En nuestra terminal nos ubicamos en C:\xampp\htdocs e instalamos symfony (version 3.4) con el sig comando:
    composer create-project symfony/framework-standard-edition HiYou
    (Aqui en el asistente configuramos nuestra DB)

Luego en composer.json debemos agregar en require:
    "knplabs/knp-paginator-bundle":"2.5.*"
Luego en nuestra terminal debemos escribir:
    composer update

Para crear el bundle del backend de nuestro proyecto:
En nuestra terminal escribir:
    php bin/console generate:bundle
Seguir el asistente, en bundle name:BackendBundle

Pasar las tablas de nuestra base de datos a codigo doctrine, para ello debemos mapearlas a yml en forma de entidades con el sig comando:
    php bin/console doctrine:import BackendBundle yml
    (Esto lo vamos a encontrar en la carpeta BackendBundle/Resources/config/doctrine)
Luego hacemos composer update y por ultimo para crear nuestras entidades escribimos el siguiente comando:
    php bin/console doctrine:generate:entities BackendBundle
Borrar cache:
	
    
