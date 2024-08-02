<?php

declare(strict_types=1);

namespace Dbseller\AluraPlay\Controller;

use Dbseller\AluraPlay\Repository\VideoRepository;

class DeleteVideoController implements Controller
{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id === null || $id === false) {
            header('Location: /?sucesso=0');
            return;
        }

        $success = $this->videoRepository->remove($id);
        if ($success === false) {
            header('Location: /?sucesso=0');
        } else {
            header('Location: /?sucesso=1');
        }

    }
}
