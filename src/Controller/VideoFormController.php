<?php

declare(strict_types=1);

namespace Dbseller\AluraPlay\Controller;

use Dbseller\AluraPlay\Repository\VideoRepository;

class VideoFormController implements Controller
{   

    private VideoRepository $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        /** @var ?Video $video */
        $video = null;
        if ($id !== false && $id !== null) {
            $video = $this->repository->find($id);
        }

        require_once __DIR__ . '/../../views/video-form.php';
    }
}
