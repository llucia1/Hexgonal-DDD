<?php
namespace App\Exceptions;



use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;


use App\Exceptions\FactoryExceptions\MapExceprion;



class CustomHandler extends ExceptionHandler
{
    
    public function render($request, Throwable $e)
    {

        $exception = MapExceprion::select($e);
        if ($exception)
            return $exception->renderException($e);


        return parent::render($request, $e);

    }

    public static function isDeferred() {}


}