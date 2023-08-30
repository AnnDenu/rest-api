<?php
namespace App\Http\Library;

use Illuminate\Http\JsonResponse;

trait ApiHelpers
{
    protected function Admin($user): bool{
        if(!empty($user)){
            return $user ->tokenCan('admin');
        }
        return false;
    }
    protected function Author($user): bool{
        if(!empty($user)){
            return $user ->tokenCan('author');
        }
        return false;
    }

    protected function onSuccess($data, string $message = '', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
    protected function onError(int $code, string $message = ''): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
        ], $code);
    }

    protected function postValidationRules(): array
    {
        return response()->json([
            'title' => 'required|string',
            'content'=> 'required|string',
        ]);
    }
    protected function userValidatedRules(): array
    {
        return [
            'name' => ['required','string','max:255'],
            'email'=> ['required','string','email','max:255','unique:users' ],
            'password'=> ['required','string','min:8','confirmed'],
        ];
    }
}