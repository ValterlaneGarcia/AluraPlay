<?php

declare(strict_types=1);

return [
    'GET|/' => \Dbseller\AluraPlay\Controller\VideoListController::class,
    'GET|/novo-video' => \Dbseller\AluraPlay\Controller\VideoFormController::class,
    'POST|/novo-video' => \Dbseller\AluraPlay\Controller\NewVideoController::class,
    'GET|/editar-video' => \Dbseller\AluraPlay\Controller\VideoFormController::class,
    'POST|/editar-video' => \Dbseller\AluraPlay\Controller\EditVideoController::class,
    'GET|/remover-video' => \Dbseller\AluraPlay\Controller\DeleteVideoController::class,
];
