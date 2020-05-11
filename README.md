# Proyecto de Prueba de Programación

Empresa Automotriz y sus concesionarios, modulo clientes.

## Requisitos

* Node y NPM
* XAMPP (Una vez instalado activar MYSQL y Apache)
* Composer y Laravel

## Descargar el Proyecto

Descargar el proyecto de Github en la siguiente dirección: [Proyecto Automotriz](https://github.com/jhonazsh17/automotriz).

## Ejecutar Composer

Ir a la terminal si se esta en linux, o en todo caso al cmd de windows, ubicamos el directorio del proyecto, una vez allí se escribe el comando:

~~~
composer install
~~~

con esto se obtiene todas las dependencias y subdependencias de composer. 

## Ejecutar NPM

Del mismo modo se ejecuta el comando:

~~~
composer install
~~~

con esto se obtiene todas las dependencias y subdependencias de node.

## Crear archivo .env

Dentro del directorio raíz del proyecto ya descargado, crear un archivo **.env**, hacer un copia y pega del archivo **.env.example**
y cambiar en la variable **DB_DATABASE** colocando el nombre de la base de datos, quedando así: 

~~~
DB_DATABASE=automotriz_bd
~~~

Para conectar con la base de datos, es necesario especificar el usuario y contraseña de mysql, por default, los datos en usuario son root y en contraseña va vacío, pero ello depende de como esta configurado mysql en el sistema sobre el cual se esta ejecutando el proyecto.

~~~
DB_USERNAME=root
DB_PASSWORD=
~~~

Luego de ello, ejecutar el comando:

~~~
php artisan key:generate
~~~

para generar una clave propia al app de laravel.

## Importar BD

Si se instaló XAMPP, pues a través de phpmyadmin, creamos una base de datos, llamada: **automotriz_bd**, y luego importamos la base de datos que esta en el directorio raiz del proyecto descargado.

## Ejecutar

Ahora solo queda ejecutar el proyecto, con el comando:

~~~
php artisan serve
~~~

En el navegador colocar en la barra de direcciones: **localhost:8000** para poder visualizar el proyecto.

Autor: @jhonazsh
