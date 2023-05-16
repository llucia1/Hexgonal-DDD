<?php
namespace Src\Post\Aplication;

use Src\Post\Domain\PostCollection;
use Src\Post\Domain\PostQueryRepoContract;



class PostsService
{
    public function __construct(private readonly PostQueryRepoContract $postRepository)
    {
    }

    public function execute(): ?array
    {
    
       $posts = $this->postRepository->all();
       if($posts === null)
        return null;

       return $posts;
    }
}


