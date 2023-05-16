<?php
namespace App\Exceptions\FactoryExceptions;

use Throwable;



use Src\Utils\Response\ResponseTrait;


class RenderExceptionInvalidArgument implements interfaceFactoryExceptions
{
    use ResponseTrait;
    public function renderException(Throwable $e)
    {
        return $this->responseJson($e->getMessage(), 404);
   
    }
}