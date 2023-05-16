<?php
namespace Src\Shared\Domain\ValueObjets;

use Src\Shared\Domain\Exception\valueObjetsException;

final class EmailVo
{
    
    private $email;
    
    private function __construct(string $email)
    {
        $this->setEmail($email);
    }
    
    public static function create(string $email): ?self
    {
        return new static($email);
    }
    
    public function email(): string
    {
        return $this->email;
    }
    
    private function setEmail(string $email)
    {
        $this->checkIsValidEmail($email);
        $this->email = $email;
    }
    
    private function checkIsValidEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new valueObjetsException('Email ' . $email . ' is not valid');
        }
    }
}