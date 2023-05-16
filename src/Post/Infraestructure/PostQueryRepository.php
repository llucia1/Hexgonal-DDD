<?php
namespace Src\Post\Infraestructure;

use Src\Post\Domain\Post;
use Src\Post\Domain\PostCollection;
use Src\Post\Domain\PostQueryRepoContract;
use Src\Shared\Infraestructure\AccessDatas\BaseApiRepository;

use Src\Shared\Domain\Exception\findOrFailException;

class PostQueryRepository extends baseApiRepository implements PostQueryRepoContract
{
    public function __construct( array $relation = []) 
    {
        parent::__construct( 'posts', $relation );
    }

    public function findOrFail(string $id): ?Post
    {
        if ($id == null)
        {
            throw new findOrFailException('The Post-Id to search for is null. Not valid.');
        }

        $result = $this->get($id)->json();

        if (empty($result))// Sino encuentra valor retonoar null
            return null;

        return Post::create($result);        
    }


    public function all(): array
    {
        $result = $this->get('')->json();
        if (empty($result)) // Validaciones que aceptamos por retorno o exceptions.
            return [];

        $all = new PostCollection($result);
        return $all->gets();// Aqui podemos retornar tambien el objeto Colletion. Puede tener beneficios en otros casos.
    }

}