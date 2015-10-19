<?php

    #Reserved
    $route['default_controller'] = "app";
    $route['404_override'] = 'app/error404';
    $route['asesores'] = "usuario/asesores";
    $route['perfil'] = "app/Perfil";
    $route['asesores/crearasesor'] = "usuario/crearasesor";
    $route['asesores/verasesor/(:num)'] = "usuario/verasesor/$1";
    $route['asesores/actualizarasesor/(:num)'] = "usuario/actualizarasesor/$1";

    #Usuarios
    $route['usuarios'] = "usuario";
    $route['usuarios/crearusuario'] = "usuario/crearusuario";
    $route['usuarios/verusuario/(:num)'] = "usuario/verusuario/$1";
    $route['usuarios/actualizarusuario/(:num)'] = "usuario/actualizarusuario/$1";

