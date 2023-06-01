## Tests ipGlobal
Visualizacion y creacion de post.

## Install
 - git clone https://github.com/llucia1/testip.git
 - composer install
 - npm install. Seleccione Vue, typescript y phpunit(nos agrega tailwind)
 - Ejecute el fichero limpiarCache.bat
 - Ejecutar en la linea de comandos de tu sistema: composer dump-autoload
 - npm run dev

** Tenga en cuenta:
- compose.json debe tener "Src\\": "src/"
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Src\\": "src/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    
- Swagger
 config/app.php, dentro del array de 'providers':
    L5Swagger\L5SwaggerServiceProvider::class,
 Y tambien: 'debug' => env('APP_DEBUG', true),
 Antes de generar el json de Swagger se recomienda primero ejecutar el fichero: limpiarCache.bat 
 y a continuacion ejecutar:
 php artisan l5-swagger:generate


## 
Desde la raiz de la instalacion Laravel, arranque la app con artisan: php artisan serve y se abrira por defecto el puerto 8000
 Ademas ejecute tambien: npm run dev
Rutas:

    http://localhost:8000

    API

    GET    http://localhost:8000/api/posts

    GET    http://localhost:8000/api/posts/{id}

    POST   http://localhost:8000/api/


Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/posts" -Method POST -Body '{userId: 1, title: Test title, body: Test body }' -Headers $headers

curl -d '{userId: 1, title: Test title, body: Test body }' -H "Content-Type: application/json" -X POST http://127.0.0.1:8000/api/posts


Test

Tenga en cuenta que al instalar las dependencias con composer, se han agregado las librerias correspondientes. Asi que al ejecutar los test con: php artisan test se ejecutaran los test de dichas librerias. El phpunit esta configurado con sqlite, para no utilizar mysql.



Entonces para ejecutar nuestros test en la carpeta 'src':

php artisan test --filter Unit y  php artisan test --filter PostApiControllerTest  Este ultimo correspondiente a 'Feature'




Swagger: 
Antes de generar el json de Swagger se recomienda primero ejecutar el fichero: limpiarCache.bat 
 y a continuacion ejecutar:
 php artisan l5-swagger:generate



 PhpStan
 ./vendor/bin/phpstan analyze src 
 He codificado hasta el --level=5 (Puedo codficar mas alto, pero no lo he realizado.)

## 
Arquitectura Hexagonal con modelado del dominio DDD.
Basado en Aplications Services. 

De cara al crecimiento de la aplicacion, se pueden envolver las aplications services en un commandBus con los beneficios que nos aportan. Por ejemplo, podemos ver sus beneficios en: https://tactician.thephpleague.com/

Tampoco hay implementado un EventsBus, a pesar de que no se necesita por los requisitos solictados. Pero si es a tener en cuenta de cara al crecimeinto.

He creado un manejador de Exceptions, teniendo un control sobre ellas. Cuando se lanza una exception se puede redirecionar a pagina de error, o un componente vue o donde se vea conveniente.

En cuanto al Front, no he creado una factoria para consumir la APi, sino que directamente sobre la url con axios. Ni tampoco un arbol de componentes vue.
La paginacion tampoco he tenido en cuenta la solicitud 

Organice el codigo como consideres necesario. Pudiendo tener un servicio para Backend y otro para Front, haciendo solicitudes para el consumo de la API.






## Version
1.0

