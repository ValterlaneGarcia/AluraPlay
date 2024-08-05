<?php 
namespace Dbseller\AluraPlay\Controller;

use Dbseller\AluraPlay\Entity\Video;
use Dbseller\AluraPlay\Repository\VideoRepository;

class NewJsonVideoController implements Controller
{

    private VideoRepository $videoRepository;

    public function __construct()
    {
        
    }

    public function processaRequisicao(): void
    {

        $request = file_get_contents('php://input');
        $videoData = json_decode($request, true);

        $video = new Video(
            $videoData['url'],
            $videoData['title']);
        $this->videoRepository->add($video);

        http_response_code(201);
    }
}