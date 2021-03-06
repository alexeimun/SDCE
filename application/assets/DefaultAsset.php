<?php
    /**
     *The Assets must have this format to be recognized by the framework
     *js key means javascript files
     *css key means cascading style sheets
     * the routes will be apply from public directory
     */
    return [
        #Css styles
        'css' => [
            'bootstrap/css/bootstrap.min.css',
            'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
            'AdminLTE/css/AdminLTE.min.css',
            'AdminLTE/css/skins/_all-skins.min.css',
            'css/styler.css',
            'css/ionicons/css/ionicons.min.css',
        ],
        #Js files
        'js' => [
            'js/jquery.min.js',
            'bootstrap/js/bootstrap.min.js',
            'AdminLTE/js/app.min.js',
            'js/main.js',
        ],
    ];