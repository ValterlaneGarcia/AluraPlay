<?php
namespace Dbseller\AluraPlay\Repository;
use Dbseller\AluraPlay\Entity\Video;

use PDO;

class VideoRepository
{   
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function add(Video $video): Video
    {
        $sql = 'INSERT INTO videos (url, title) VALUES (?, ?)';
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->url);
        $statement->bindValue(2, $video->title);

        $statement->execute();

        $video->setId($this->pdo->lastInsertId());
        return $video;

    }

    public function remove(int $id): void
    {
      $sql = 'DELETE FROM videos WHERE id = ?';
      $statement = $this->pdo->prepare($sql);
      $statement->bindValue(1, $id);
              $statement->execute();
      }

      public function update(Video $video): void
      {
     
             $sql = 'UPDATE videos SET url = :url, title = :title WHERE id = :id;';
             $statement = $this->pdo->prepare($sql);
     
             $statement->bindValue(':url', $video->url);
             $statement->bindValue(':title', $video->title);
             $statement->bindValue(':id', $video->id, \PDO::PARAM_INT);
     

         }

        public function all(): array
        {

            $videoList = $this->pdo
                            ->query('SELECT * FROM videos;')
                            ->fetchAll(PDO::FETCH_ASSOC);

                return array_map(function (array $videoData) {
                    $video = new Video($videoData['url'], $videoData['title']);
                    $video->setId($videoData['id']);

                    return $video;
                }, 
                $videoList
            );
        }

}