<?php

 namespace App\Services\Admin;
use App\Models\Admin;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AdminAuthService
{

    public function login(array $credentials): array
    {
        if (! $token = Auth::guard('admin')->attempt($credentials)) {
            throw new AuthenticationException('Invalid credentials');
        }

        $admin = $this->findByEmail($credentials['email']);

        return [
            'admin' => $admin->only(['name', 'email']),
            'token' => $token,
        ];
    }

    public function refresh(): array
    {
        $token = Auth::guard('admin')->refresh();

        return $this->generateTokenResponse($token);
    }

    public function logout(): void
    {
        Auth::guard('admin')->logout();
    }

    private function generateTokenResponse(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('admin')->factory()->getTTL() * 60,
        ];
    }

    public function findByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }
}
