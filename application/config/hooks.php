<?php
    /*
    | -------------------------------------------------------------------------
    | Hooks
    | -------------------------------------------------------------------------
    | This file lets you define "hooks" to extend CI without hacking the core
    | files.  Please see the user guide for info:
    |
    |	http://codeigniter.com/user_guide/general/hooks.html
    |
    */

    $hook['post_controller_constructor'] = [
        'class' => 'Home',
        'function' => 'check_login',
        'filename' => 'Home.php',
        'filepath' => 'hooks',
    ];

    /* End of file hooks.php */
    /* Location: ./application/config/hooks.php */