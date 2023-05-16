<?php
namespace Src\Utils\Response;

trait ResponseTrait
{
    function responseJsonInView($results, $status = 200,  array $headers = [], $options = 0 )
    {
        return ResponseClass::JsontoView( $results, $status, $headers, $options );
    }

    function responseJson( $results, $status = 200,  array $headers = [], $options = 0 )
    {
        return ResponseClass::Json( $results, $status, $headers, $options );
    }

}
