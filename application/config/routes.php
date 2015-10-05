<?php

    #Reserved
    $route['default_controller'] = "app";
    $route['404_override'] = 'app/error404';
    $route['asesores'] = "usuario";
    $route['perfil'] = "app/Perfil";
    $route['crearasesor'] = "usuario/crearasesor";
    $route['verasesor/(:num)'] = "usuario/verasesor/$1";
    $route['actualizarasesor/(:num)'] = "usuario/actualizarasesor/$1";
