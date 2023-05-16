<?php
namespace Src\Post\Domain;

use Src\User\Domain\User;



final class Post
{
    public ?User $user = null;
    public function __construct(public string $userId, public string $id, public string $title, public string $body )
    {
        $this->userId = new Id($userId);
        $this->id = new Id($id);
        $this->title = new Stringvo($title);
        $this->body = new Stringvo($body);
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function body(): string
    {
        return $this->body;
    }

    public function user(): ?User
    {
        return $this->user;
    }

    public function addUser(?User $user): void
    {
        $this->user = $user;
    }

    public function get(): self
    {
        return $this;
    }

    public function addUserFromArray(?array $user): void
    {
        if ( $this->userId() === strval($user['id']) )
            $this->addUser( new User($user['id'], $user['name'], $user['username'], $user['email'], $user['address'], $user['phone'], $user['website'], $user['company']) );
        else
            $this->addUser(null);
    }

    public static function create(array $datos): ?static
    {
        if( !empty($datos) )
        {
            $instance = new static($datos['userId'], $datos['id'], $datos['title'], $datos['body']);
            $instance->addUserFromArray($datos['user']);
            return $instance;
        }
        return null;
    }

    public function toArray(): array
    {
        return [
            'userId' => $this->userId(),
            'id' => $this->id(),
            'title' => $this->title(),
            'body' => $this->body(),
            'user' => ($this->user() !== null)? $this->user()->toArray() : null,
        ];
    }


}

