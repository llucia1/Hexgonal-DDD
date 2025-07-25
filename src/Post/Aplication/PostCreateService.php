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

       $uuid = $this->uuid();
       
       $this->postRepository->save( new Post( $datas['userId'], $uuid, $datas['title'], $datas['body']  ));

       return $uuid;   
    }

    public function uuid(): string
    {
        return '456';
    }
}


