<?php 

namespace Dbseller\AluraPlay\Controller;

use Dbseller\AluraPlay\Entity\Video;
use Dbseller\AluraPlay\Repository\VideoRepository;

class JsonVideoListController implements Controller
{
    private VideoRepository $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }


    public function processaRequisicao(): void
    {
        $videoList = array_map(function (Video $video) : array{
            return [
                'url'       => $video->url,
                'title'     => $video->title,
                'file_path' => '/img/uploads/' . $video->getFilePath(),
            ];
        }, $this->videoRepository->all());
        echo json_encode($videoList);
    }
}