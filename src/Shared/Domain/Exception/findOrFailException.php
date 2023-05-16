<?php
namespace Src\Shared\Domain\Exception;

use App\Exceptions\FactoryExceptions\QueryTypeFindException;

use Exception;
use Throwable;

class findOrFailException extends \Exception implements QueryTypeFindException
{
}





