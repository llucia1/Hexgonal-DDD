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
        } catch (\Throwable $th) {
            throw new crearPostInBDException('Error when inserting a new Post in the Database.') ;
        }
    }
}
