<?php
namespace Src\Post\Domain;

class PostCollection
{
    private ?array $Posts;
    public function __construct( array $Posts  )
    {
        $this->fromArray($Posts);
    }

    public function gets(): array
    {
        return $this->Posts;
    }

    public function fromArray(array $all): void
    {
        foreach ($all as $post)
            $this->Posts[] = Post::fromArray($post);
    }

}

