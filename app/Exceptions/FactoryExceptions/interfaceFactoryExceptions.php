<?php
namespace App\Exceptions\FactoryExceptions;

use Throwable;



interface interfaceFactoryExceptions
{
    public function renderException(Throwable $e);
}