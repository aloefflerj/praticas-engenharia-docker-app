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

    public static $links;

    public static function init()
    {
        /** @var CoreView */
        self::$view = new CoreView();
        
    }
    
    public static function home()
    {
        return function($req, $res, $params) {

            echo self::$view->render('home', [
                'page_title' => 'Olá, seja bem vindo',
                'content' => 'Aplicação de práticas de engenharia de software'
            ]);
        };
    }

    public static function gitHub()
    {
        return function($req, $res, $params) {

            $link = <<<GITLINK
                <a href='https://github.com/aloefflerj/praticas-engenharia-docker-app' target='_blank'>praticas-engenharia-docker-app</a>
            GITLINK;

            echo self::$view->render('github', [
                'page_title' => 'Repositório do projeto',
                'content' => $link
            ]);
        };
    }


}