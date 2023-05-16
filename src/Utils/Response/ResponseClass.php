<?php
namespace Src\Utils\Response;



class ResponseClass
{
    public static function JsontoView( mixed $result, $status = 200,  array $headers = [], $options = 0 ): mixed // Response Json View
    {
        return back()->with('flash', [ 'message' => 'success', 'data' => response()->json( $result, $status, $headers, $options )]);
    }

    public static function Json( mixed $result, $status = 200,  array $headers = [], $options = 0 ): mixed // Response Json
    {
        return response()->json( $result, $status, $headers, $options );
    }


}