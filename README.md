## Hexagonal DDD
Este codigo de ejemplo, sencillo basado en arquitectura hexagonal con modelado del dominio (DDD).
Es una APi en apoyada en Laravel y un front que hace consumo de dicha APi en VUE.


## Install
 - git clone https://github.com/llucia1/testip.git
 - cd testip
 - renombre el fichero .env.example por .env
 - composer install
 - composer dump-autoload
 - php artisan key:generate
 - php artisan breeze:install
 
   * Seleccione o acepte instalar: Vue y typescript (nos agrega tailwind) . El resto de opciones no instalar.
 - npm install

 


 - Al instalar las dependencias nos han sobreescrito los ficheros 'routes/web.php' y 'resources/js/app.ts'.
   Ahora podemos actualizar el repositorio para que los ficheros web y app esten correctamente. 
   O sino, se puede hacer manualmente como muestro a continuacion:
 
    Editar routes/web.php   
    Agregar la ruta:
 
        
 
            Route::get('/posts', function () { return Inertia::render('posts'); });
 

    Editar resources/js/app.ts
    
    Tenemos que importar las librerias de componentes Vuetify y debemos agregar el plugin Vuetify a la funcion createInertiaApp.
    
    En el fichero resources/js/app.ts 
    elimine todo el codigo y sustituirlo por: 
        
        



        import './bootstrap'; 
        import '../css/app.css'; 
        import { createApp, h, DefineComponent } from 'vue';
        import { createInertiaApp } from '@inertiajs/vue3';
        import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
        import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
        // Vuetify
        import 'vuetify/styles'
        import { createVuetify } from 'vuetify'
        import * as components from 'vuetify/components'
        import * as directives from 'vuetify/directives'
        
        const vuetify = createVuetify({
          components,
          directives,
        })
        const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
        
        createInertiaApp({
            title: (title) => `${title} - ${appName}`,
            resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob<DefineComponent>('./Pages/**/*.vue')),
            setup({ el, App, props, plugin }) {
                createApp({ render: () => h(App, props) })
                    .use(plugin)
                    .use(vuetify)
                    .use(ZiggyVue, Ziggy)
                    .mount(el);
            },
            progress: {
                color: '#4B5563',
            },
        });





 - Ejecute el fichero limpiarCache.bat
 - npm run dev
 - Abra otro terminal y ejecute: php artisan serve
 - Ir a la ruta: http://localhost:8000/posts

    
    
** Consideraciones:
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
Desde la raiz de la instalacion Laravel, arranque la app con artisan: php artisan serve y se abrira por defecto el puerto 8000.
Ademas ejecute tambien: npm run dev

 Rutas:
 
 
 Web

          http://localhost:8000/posts
    
 API

Solicitar todos los posts (GET):

         http://localhost:8000/api/posts


Solicitar un post por id (GET):

         http://localhost:8000/api/posts/{id}
 
 
Crear un post (POST):

          http://localhost:8000/api/posts

Windows:

     Invoke-WebRequest -Uri "http://127.0.0.1:8000/api/posts" -Method POST -Body '{userId: 1, title: Test title, body: Test body }' -Headers $headers
ubuntu:

     curl -d '{userId: 1, title: Test title, body: Test body }' -H "Content-Type: application/json" -X POST http://127.0.0.1:8000/api/posts

O si lo desea, utilice Postman.


- Test

Ejecutar test:


       php artisan test
    
    
Para testar la base de datos con Laravel como preferencia, se recomeinda tener instalado Sqlite.
Sqlite nos evita escrituras y lecturas de la Base de datos ya sea MySql, Postgrest,etc 
Por ello esta incluido el fichero database.sqlite y su correspondiente configuracion de Laravel (phpunit.xml, config/database.php)

- Test unitarios:

 
      php artisan test --filter Unit 
    
 y de aceptacion o funcionales:
 
     php artisan test --filter PostApiControllerTest
    
 Este ultimo correspondiente a 'Feature'


 - Swagger: 
Antes de generar el json de Swagger se recomienda primero ejecutar el fichero: 
    limpiarCache.bat 
 y a continuacion ejecutar:
 
    php artisan l5-swagger:generate

  - PhpStan
  
        ./vendor/bin/phpstan analyze src 
        
 He codificado en --level=5 
 
    ./vendor/bin/phpstan analyze src --level=5
 

## 
Arquitectura Hexagonal con modelado del dominio DDD.
Basado en Aplications Services. 

De cara al crecimiento de la aplicacion, se pueden envolver las aplications services en un commandBus con los beneficios que nos aportan. Por ejemplo, podemos ver sus beneficios en: https://tactician.thephpleague.com/

Se ha creado un manejador de Exceptions, para control sobre ellas. Puede verlo en 'app/exceptions'
Cuando se lanza una exception se puede redirecionar a pagina de error, o un componente vue o donde se vea conveniente.

En cuanto al Front, se hace un consumo directo con la API con axios. 

El codigo de la aplicacion esta desacoplado del framework. Por lo cual te permite instalar cualquier versin de LAravel a partir de la 8, al estar en PHP8
Organice el codigo como consideres necesario. Pudiendo tener un servicio para Backend y otro para Front.






## Version
1.0

