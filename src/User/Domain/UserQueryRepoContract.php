<?php
namespace Src\User\Domain;

interface UserQueryRepoContract
{
    public function findOrFail(string $id): ?User; // El parametro puede ser tambien un Value Objet de id
}