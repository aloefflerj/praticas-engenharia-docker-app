<?php

namespace MusicRating\Controllers;

use MusicRating\Models\UsersModel;
use MusicRating\Views\CoreView;

class WebController
{

    /**
     * Undocumented variable
     *
     * @var CoreView
     */
    public static $view;

    public static $curl;

    public static function init()
    {
        /** @var CoreView */
        self::$view = new CoreView();
        
    }
    
    public static function home()
    {
        // header('Content-Type: text/html');
        return function($req, $res, $params) {

           echo 'Olá, seja bem vindo';
        };
    }


}