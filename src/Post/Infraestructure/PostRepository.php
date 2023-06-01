<?php
namespace Src\Post\Infraestructure;

use Src\Post\Domain\Post;
use Src\Shared\Infraestructure\AccessDatas\BaseApiRepository;

use Src\Post\Domain\PostRepoContract;
use Src\Shared\Domain\Exception\crearPostInBDException;

class PostRepository extends baseApiRepository implements PostRepoContract
{
    public function __construct() 
    {
        parent::__construct( 'posts' );
    }

    public function save(Post $post): void
    {
        try {
            $this->persist($post);
            /* 
                Si fuera un model de Eloquent:
                        $this->model->id = $post->id();
                        $this->model->userId = $post->userId();
                        $this->model->title = $post->title();
                        $this->model->body = $post->body();
                        $this->save($this->model);
            */
            // Podemos crear una entidad Post del y devolverlo al dominio. Si creamos un servicio de dominio, 
            // por ejemplo llamado 'new' o 'created' 
            // se puede lanzar un evento o agregamos a un array de eventos para lanzalos cuando consideremos oportuno
        } catch (\Throwable $th) {
            throw new crearPostInBDException('Error when inserting a new Post in the Database.') ;
        }
    }
}