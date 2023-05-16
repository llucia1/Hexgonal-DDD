<?php
namespace App\Exceptions\FactoryExceptions;




use Throwable;
use ParseError;
use TypeError;
use Error;


class MapExceprion
{
    
    
    public static function select(Throwable $e): interfaceFactoryExceptions | null
    {
        $concreteExcepton = null;
        
        if ($e instanceof QueryTypeFindException ) {
            $concreteExcepton = new RenderExceptionInvalidArgument();
        } else if ($e instanceof VoException ) {
            $concreteExcepton = new RenderExceptionVo();
        }  

        
        return $concreteExcepton; 
    }



}