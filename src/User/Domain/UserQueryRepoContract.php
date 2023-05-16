<?php
namespace Src\User\Domain;

interface UserQueryRepoContract
{
    public function findOrFail(string $id): mixed;
}