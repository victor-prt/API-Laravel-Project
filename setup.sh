#!/bin/bash

#Copiamos el archivo de configuración
cp .env.example .env

#instalamos composer y sus dependencias
composer install

#iniciamos laravel sail
./vendor/bin/sail up -d

#generamos la clave de la aplicación
./vendor/bin/sail artisan key:generate

#reiniciamos laravel sail para evitar posibles problemas con las bases de datos
./vendor/bin/sail down -rmi all -v 

#instalamos tailwindcss para nuestro proyecto
npm install -D tailwindcss postcss autoprefixer
npx tailwindcss init -p

#construimos el css
npm run build

#volvemos a levantar laravel sail
./vendor/bin/sail up -d

#realizamos las migraciones de la base de datos
./vendor/bin/sail artisan migrate

