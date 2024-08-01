<?php 

require_once 'vendor/autoload.php';
use Dbseller\AluraPlay\Infra\Persistence\ConexaoBd;
    $pdo = ConexaoBd::createConnection();

    $id = $_GET['id'];
    $video = [
        'url' => '',
        'title' => '',
    ];
    if ($id !== false) {
        $statement = $pdo->prepare('SELECT * FROM videos WHERE id = ?;');
        $statement->bindValue(1, $id, PDO::PARAM_INT);
        $statement->execute();
        $video = $statement->fetch(\PDO::FETCH_ASSOC);
    }

?> <?php require_once 'inicio-html.php'; ?>
    <main class="container">

    <form class="container__formulario"
      action="<?=   '/editar-video.php?id=' . $id; ?>"
      method="post">
            <h2 class="formulario__titulo">Edite um vídeo!</h3>
                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="url">Link novo</label>
                    <input name="url"
                           value="<?= $video['url']; ?>"
                           class="campo__escrita"
                           required
                           placeholder="Por exemplo: https://www.youtube.com/embed/FAY1K2aUg5g"
                           id='url' />
                </div>


                <div class="formulario__campo">
                    <label class="campo__etiqueta" for="titulo">Titulo do vídeo</label>
                    < <input name="titulo"
                           value="<?= $video['title']; ?>"
                           class="campo__escrita"
                           required
                           placeholder="Neste campo, dê o nome do vídeo"
                           id='titulo' />
                </div>

                <input class="formulario__botao" type="submit" value="Editar" />
        </form>

    </main>
<?php  require_once 'fim-html.php'; ?>