# Notas para trabajar con BDD

> Laravel utiliza de base PDO  
> Arriba de PDO  tenemos una capa de abstracción 
> que se llama raw SQL 

    /** ## Métodos Raw SQL
     *
     *  DB::select();
     *  DB::insert();
     *  DB::update();
     *  DB::delete();
     *
     */

> Además, arriba de raw SQL, Laravel tiene otra capa de abstracción   
> y esta se llama Fluent Query Builder 

    /** ## Métodos Fluent Query Builder
     *
     *  DB::table('nTable')->get();
     *  DB::table('nTable)->select('campo')->get();
     *  DB::table('nTable')->where(condicion)->get();
     *  DB::table('nTable')->select('campo')->where(condicion)->get();
     *  DB::table('nTable)->insert( [ ... ] );
     *  DB::table('nTable')->where(condicion)->update( [ ... ] );
     */
 
 <img src="https://raw.githubusercontent.com/exegeses/laravel-46358/main/materiales/img/capas-rSQL%2BfQB.png">    