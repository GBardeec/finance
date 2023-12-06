<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function __construct(private readonly AuthService $loginService)
    {

    }

    public function __invoke(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::query()->where('login', $data['login'])->first() ?? $this->loginService->createUser($data['login'], $data['password']);

        abort_if(!password_verify($data['password'], $user->password), 403, 'Вы ввели неправельный пароль.');

        Auth::login($user);

        $token = $user->createToken($user->login)->plainTextToken;

        return response()->json(['success' => true, 'token' => $token]);
    }
}
