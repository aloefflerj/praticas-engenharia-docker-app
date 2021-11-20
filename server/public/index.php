<?php

declare(strict_types=1);

use MusicRating\Controllers\AlbumController;
use MusicRating\Controllers\ArtistController;
use MusicRating\Controllers\RelationshipController;
use MusicRating\Controllers\SongController;
use MusicRating\Controllers\UserController;
use MusicRating\Controllers\WebController;
use MusicRating\lib\Controller\BaseController;
use MusicRating\Middlewares\APIMiddleware;

ini_set('display_errors', 'on');
error_reporting(E_ALL);

include_once dirname(__DIR__, 1) . '/src/autoload.php';

$app = new BaseController();

/**
 * =====================================
 * ||              WEB               || ==================================>
 * ====================================
 */
WebController::init();
$app->get('/', WebController::home());


// Test group ---------------->
$app->get('/test/{id}', function ($req, $res, $params) {
    echo $params->id;
});

$app->dispatch();

if ($app->error()) {
    echo $app->error()->getMessage();
}
