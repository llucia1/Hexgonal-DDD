<?php
namespace Src\Post\Aplication;

use Src\Post\Domain\Post;

use Src\Post\Domain\PostRepoContract;
use Src\User\Domain\UserQueryRepoContract;
use Src\Shared\Domain\Exception\crearPostInBDException;

final class PostCreateService
{
    public function __construct(private readonly PostRepoContract $postRepository, private readonly UserQueryRepoContract $userQueryRepository)
    {
    }

    public function execute(array $datas): ?string
    {
    
       $user = $this->userQueryRepository->findOrFail($datas['userId']);

       if($user === null)
        throw new crearPostInBDException('The user does not exist. We cannot insert post in database.') ;

       $uuid = $this->uuid();// Creamos el uuid. Pero se puede crear desde infraestructura con otro metodo llamado create, por ejemplo. A continuacion,
                             // podemos tener un servicio de dominio, que sea para cuando se crea un nuevo Post y este puede asociar un listern o incluso puede disparar un Event(Depende de la decision que se quiera tomar).
       $this->postRepository->save( new Post( $datas['userId'], $uuid, $datas['title'], $datas['body']  ));

       return $uuid;// Este retorno es discutible ...   
    }

    public function uuid(): string
    {
        return '456';
    }
}


