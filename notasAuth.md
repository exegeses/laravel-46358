# Autenticación usando Laravel

## Jetstream

>Jetstream es el kit de inicio para la implementación 
>de un sistema de login, registro de usuarios, verificación de email, 
>autenticación de dos-factores, manejo de sesiones.  
>Jetstream utiliza Sanctum y, de manera opcional, manejo de equipos de trabajo.  
> https://jetstream.laravel.com/2.x/introduction.html  

    composer require laravel/jetstream  

## Livewire
> Jetstream está diseñado usando TailwindCSS y además podemos elegir entre Livewire o InertiaJS
(Scaffolding)   
>Si queremos aprender más acerca de Livewire. podemos ir a los videotutoriales oficiales (de Laravel/Livewire)
> https://laravel-livewire.com/screencasts/installation

    php artisan jetstream:install livewire   

>Livewire scaffolding installed successfully.
>Please execute the "npm install && npm run dev" command to build your assets.

>Después de instalar Jetstream con Livewire o InertiaJS   
>queda como último paso de instalación generar las dependencias de NPM ya que, lamentablemente, Javascript necesita este módulo.

    npm install && npm run dev  

## Migraciones
>Necesitamos correr las migraciones para crear las tablas correspondientes a los usuarios y sus sesiones
> users y sessions
>   password_resets
>	failed_jobs
>	personal_access_tokens

    php artisan migrate   

##Publicar componentes de Blade
>Ahora sólo nos hace falta publicar los componentes de Blade

    php artisan vendor:publish --tag=jetstream-views

