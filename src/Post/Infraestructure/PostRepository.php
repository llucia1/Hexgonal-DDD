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
            // Podemos crear una entidad Post de dominio y devolverlo. Si creamos un servicio de dominio, 
            // por ejemplo llamado 'new' o 'created', este serrvicio puede lanzar un evento o lo agregamos a un array de eventos para lanzalos 
            // cuando consideremos oportuno. Estos eventos pertenecen a negocio, es decir lo contendra el metodo del servicio de dominio.
        } catch (\Throwable $th) {
            throw new crearPostInBDException('Error when inserting a new Post in the Database.') ;
        }
    }
}
