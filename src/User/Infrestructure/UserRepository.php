<?php
namespace Src\User\Infrestructure;

use Src\User\Domain\User;
use Src\Shared\Infraestructure\AccessDatas\BaseApiRepository;

use Src\User\Domain\UserQueryRepoContract;
use Src\Shared\Domain\Exception\findOrFailException;

class UserRepository extends baseApiRepository implements UserQueryRepoContract
{
    public function __construct() 
    {
        parent::__construct( 'users' );
    }

    public function findOrFail(string $id): ?User
    {
        if ($id == null)
        {
            throw new findOrFailException('The User-Id to search for is null. Not valid.');
        }

        $result = $this->get($id)->json();

        if(empty($result))
            return null;

        return User::fromArray($result);        
    }

}