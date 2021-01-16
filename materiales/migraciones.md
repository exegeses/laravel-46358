# Migraciones + Seeders

## Migraciones

> Cuando uno no tiene la estructura o backup de la base de datos, 
> esto se puede lograr con un migración.  
> ¿Qué es una migración? Una migración crear 
> la estructura de una tabla en una bbdd, 
> pero más importante, es un control de versiones

    php artisan make:migration create_paises_table 

> Ahora hay que ejecutar la migración

    php artisan migrate  

## Seeder

> Para completar de registros en las tablas, utilizamos seeders   
> ¿que es un seeder? es una clase que va a tener un método run() donde cargaríamos los datos. 

     php artisan make:seeder PaisSeeder   

> NOTA: primero necesitamos tener un model, ya que el seeder utiliza el model

> Ejecutamos el Seeder:

     php artisan db:seed --class=PaisSeeder

> Ejemplo creando un Modelo + migracion + Controlador con recursos

    php artisan make:model Cliente -mcr