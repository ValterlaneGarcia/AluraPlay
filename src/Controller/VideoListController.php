<?php

declare(strict_types=1);

namespace Dbseller\AluraPlay\Controller;

use Dbseller\AluraPlay\Repository\VideoRepository;

class VideoListController implements Controller
{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;

    }

    public function processaRequisicao(): void
    {
        session_start();
        if (!array_key_exists('logado',$_SESSION)) {
            header('Location: /login');
            return;
        }
        $videoList = $this->videoRepository->all();
        require_once __DIR__ . '/../../views/video-list.php';
    }
}
