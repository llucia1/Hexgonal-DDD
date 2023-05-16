## Tests ipGlobal
Visualizacion y creacion de post.

## Install
 - composer create-project laravel/laravel prueba
 - composer require laravel/breeze --dev
 - php artisan breeze:install 
    * Seleccione Vue, typescript y phpunit(nos agrega tailwind)

 - npm install

- npm install vuetify
- npm install sass --save-dev

- composer require --dev phpstan/phpstan


Descargar el codigo y sobreescribir.
- En el fichero compose.json agregar "Src\\": "src/", de forma que podria quedar por ejemplo:
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Src\\": "src/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    
 - Ejecutar en la linea de comandos de tu sistema: composer dump-autoload
 - npm run dev

 Instalar Swagger
 - composer require darkaonline/l5-swagger
 Agregar en el fichero config/app.php, dentro del array de 'providers':
    L5Swagger\L5SwaggerServiceProvider::class,
 Y tambien: 'debug' => env('APP_DEBUG', true),
 Antes de generar el json de Swagger se recomienda primero ejecutar el fichero: limpiarCache.bat 
 y a continuacion ejecutar:
 php artisan l5-swagger:generate

## 
Desde la raiz de la instalacion Laravel, arranque la app con artisan: php artisan serve y se abrira por defecto el puerto 8000
Rutas:

    http://localhost:8000

    API

    GET    http://localhost:8000/api/posts

    GET    http://localhost:8000/api/posts/{id}

    POST   http://localhost:8000/api/


Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/posts" -Method POST -Body '{userId: 1, title: Test title, body: Test body }' -Headers $headers

curl -d '{userId: 1, title: Test title, body: Test body }' -H "Content-Type: application/json" -X POST http://127.0.0.1:8000/api/posts



## 
Arquitectura Hexagonal con modelado del dominio DDD.
Basado en Aplications Services. 

De cara al crecimiento de la aplicacion, se pueden envolver las aplications services en un commandBus con los beneficios que nos aportan. Por ejemplo, podemos ver sus beneficios en: https://tactician.thephpleague.com/

Tampoco hay implementado un EventsBus, a pesar de que no se necesita por los requisitos solictados. Pero si es a tener en cuenta de cara al crecimeinto.

He creado un manejador de Exceptions, teniendo un control sobre ellas. Cuando se lanza una exception se puede redirecionar a pagina de error, o un componente vue o donde se vea conveniente.

En cuanto al Front, no he creado una factoria para consumir la APi, sino que directamente sobre la url con axios. Ni tampoco un arbol de componentes vue.

Organice el codigo como consideres necesario. Pudiendo tener un servicio para Backend y otro para Front, haciendo solicitudes para el consumo de la API.






## Version
1.0

