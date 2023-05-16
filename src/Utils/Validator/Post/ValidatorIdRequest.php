<?php
namespace Src\Utils\Validator\Post;

use Illuminate\Support\Facades\Validator;

class ValidatorIdRequest
{
    public static function ValidIdRequest(string $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|string|min:1', // REGLAS VALIDACION DEL id
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
    }
}