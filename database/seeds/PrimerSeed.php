<?php

use App\User;
use App\Roles;
use App\Modulos;
use App\Permisos;
use App\Operaciones;
use Illuminate\Database\Seeder;

class PrimerSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ROLES
        $roles = Roles::insert([
            ['nombreRol' => 'ADMINISTRADOR', 'descripcionRol' => '' ],
            ['nombreRol' => 'MODERADOR', 'descripcionRol' => '' ],
            ['nombreRol' => 'EDITOR', 'descripcionRol' => '' ]
        ]);

        // MODULOS
        $modulos = Modulos::insert([
            ['nombreModulo' => 'Panel', 'ruta' => '/panel', 'text'=> 'Panel', 'align'=> 'start', 'sortable' => true, 'value' => 'panel', 'estado' => 'produccion' ],
            ['nombreModulo' => 'Usuarios', 'ruta' => '/usuarios', 'text'=> 'Usuarios', 'align'=> 'start', 'sortable' => true, 'value' => 'usuarios', 'estado' => 'produccion' ],
            ['nombreModulo' => 'Roles', 'ruta' => '/roles', 'text'=> 'Roles', 'align'=> 'start', 'sortable' => true, 'value' => 'roles', 'estado' => 'produccion' ],
            ['nombreModulo' => 'Asignar Permisos', 'ruta' => '/asignarpermisos', 'text'=> 'Permisos', 'align'=> 'start', 'sortable' => true, 'value' => 'permisos', 'estado' => 'produccion' ],
            ['nombreModulo' => 'Módulos', 'ruta' => '/modulos', 'text'=> 'Usuarios', 'align'=> 'start', 'sortable' => true, 'value' => 'modulos', 'estado' => 'produccion' ],
       ]);


       $operaciones = Operaciones::insert([
           //Modulo Panel
           ['nombreOperacion' => 'ver', 'descripcion' => 'Ver módulo Panel', 'modulo_id' => 1],
            //Modulo Usuarios
           ['nombreOperacion' => 'ver', 'descripcion' => 'Ver módulo Usuario', 'modulo_id' => 2],
           ['nombreOperacion' => 'agregar', 'descripcion' => 'Agregar nuevos usuarios', 'modulo_id' => 2],
           ['nombreOperacion' => 'editar', 'descripcion' => 'Editar datos de un usuario', 'modulo_id' => 2],
           ['nombreOperacion' => 'eliminar', 'descripcion' => 'Eliminar o cambiar estado usuarios', 'modulo_id' => 2],
            //Modulo Roles
           ['nombreOperacion' => 'ver', 'descripcion' => 'Ver módulo Roles', 'modulo_id' => 3],
           ['nombreOperacion' => 'agregar', 'descripcion' => 'Agregar nuevos roles', 'modulo_id' => 3],
           ['nombreOperacion' => 'editar', 'descripcion' => 'Editar datos de un rol', 'modulo_id' => 3],
           ['nombreOperacion' => 'eliminar', 'descripcion' => 'Eliminar o cambiar estado roles', 'modulo_id' => 3],
            //Modulo Asignar permisos
           ['nombreOperacion' => 'ver', 'descripcion' => 'Ver módulo Asignar permisos', 'modulo_id' => 4],
           ['nombreOperacion' => 'asignar_permisos', 'descripcion' => 'Agregar nuevos roles', 'modulo_id' => 4],
            //Módulo de Módulos
            ['nombreOperacion' => 'ver', 'descripcion' => 'Ver gestión de Módulos', 'modulo_id' => 5],
            ['nombreOperacion' => 'agregar', 'descripcion' => 'Agregar nuevos módulos', 'modulo_id' => 5],
            ['nombreOperacion' => 'editar', 'descripcion' => 'Editar módulos de un rol', 'modulo_id' => 5],
            ['nombreOperacion' => 'eliminar', 'descripcion' => 'Eliminar o cambiar estado de módulos', 'modulo_id' => 5],
       ]);

       $permisos = Permisos::insert([
           // ADMINISTRADOR
           ['rol_id' => 1, 'operacion_id'=> 1 ,  'value' => 1],
           ['rol_id' => 1, 'operacion_id'=> 2 ,  'value' => 1],
           ['rol_id' => 1, 'operacion_id'=> 3 ,  'value' => 1],
           ['rol_id' => 1, 'operacion_id'=> 4 ,  'value' => 1],
           ['rol_id' => 1, 'operacion_id'=> 5 ,  'value' => 1],
           ['rol_id' => 1, 'operacion_id'=> 6 ,  'value' => 1],
           ['rol_id' => 1, 'operacion_id'=> 7 ,  'value' => 1],
           ['rol_id' => 1, 'operacion_id'=> 8 ,  'value' => 1],
           ['rol_id' => 1, 'operacion_id'=> 9 ,  'value' => 1],
           ['rol_id' => 1, 'operacion_id'=> 10,  'value' => 1 ],
           ['rol_id' => 1, 'operacion_id'=> 11,  'value' => 1 ],
           ['rol_id' => 1, 'operacion_id'=> 12,  'value' => 1 ],
           ['rol_id' => 1, 'operacion_id'=> 13,  'value' => 1 ],
           ['rol_id' => 1, 'operacion_id'=> 14,  'value' => 1 ],
           ['rol_id' => 1, 'operacion_id'=> 15,  'value' => 1 ],
           // MODERADOR
           ['rol_id' => 2, 'operacion_id'=> 1 ,  'value' => 1],
           ['rol_id' => 2, 'operacion_id'=> 3 ,  'value' => 1],
           ['rol_id' => 2, 'operacion_id'=> 5 ,  'value' => 1],
           ['rol_id' => 2, 'operacion_id'=> 7 ,  'value' => 1],
           ['rol_id' => 2, 'operacion_id'=> 9 ,  'value' => 1],
           ['rol_id' => 2, 'operacion_id'=> 10,  'value' => 1 ],
           ['rol_id' => 2, 'operacion_id'=> 11,  'value' => 1 ],
           ['rol_id' => 2, 'operacion_id'=> 12,  'value' => 1 ],
           // USUARIO
           ['rol_id' => 3, 'operacion_id'=> 1 ,  'value' => 1],
           ['rol_id' => 3, 'operacion_id'=> 5 ,  'value' => 1],
           ['rol_id' => 3, 'operacion_id'=> 9 ,  'value' => 1],
           ['rol_id' => 3, 'operacion_id'=> 11,  'value' => 1 ],
           ['rol_id' => 3, 'operacion_id'=> 12,  'value' => 0 ],
       ]);

    //    USUARIOS
    $user_administrador = User::create([
        'nombres' => 'Jean Carlo',
        'apellidos' => 'Palomino Gonzales',
        'email' => 'admin@admini.com',
        'estado' => 1,
        'password' => Hash::make('12345678'),
        'rol_id' => 1
    ]);
    $user_administrador = User::create([
        'nombres' => 'Aldo',
        'apellidos' => 'Lopez Carrion',
        'email' => 'moderador@moderador.com',
        'estado' => 1,
        'password' => Hash::make('12345678'),
        'rol_id' => 2
    ]);
    $user_administrador = User::create([
        'nombres' => 'Carlos',
        'apellidos' => 'Nuñez',
        'email' => 'editor@editor.com',
        'estado' => 1,
        'password' => Hash::make('12345678'),
        'rol_id' => 3
    ]);
    }
}
