Instalar version Laravel a partir de 9 o compatible con Php 8.1.4.
 - composer create-project laravel/laravel prueba

Al instalar Breeze 
 - composer require laravel/breeze --dev
php artisan breeze:install 
* Seleccione Vue, typescript y phpunit(nos agrega tailwind)

 - npm install

 Instalar libreria componentes Vuetify
- npm install vuetify
- npm install sass --save-dev

- composer require --dev phpstan/phpstan


Descargar el codigo y sobreescribir.

*** Consideraciones de diseño en el Backend:
- Arquitectura Hexagona con modelado del dominio DDD. 
Me he basado en Aplications Services en vez de commandBus y tampoco he agregado un Events.