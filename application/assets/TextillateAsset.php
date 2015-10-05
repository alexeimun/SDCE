<?php
    /**
     *The Assets must have this format to be recognized by the framework
     *js key means javascript files
     *css key means cascading style sheets
     * the routes will be apply from public directory
     */
    return [
        #css
        'css' =>
            [
                'plugins/textillate/assets/animate.css',
            ],
        #Js files
        'js' => [
            'plugins/textillate/assets/jquery.fittext.js',
            'plugins/textillate/assets/jquery.lettering.js',
            'plugins/textillate/jquery.textillate.js',
        ],
    ];