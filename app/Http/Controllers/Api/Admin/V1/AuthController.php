<?php

namespace App\Http\Controllers\Api\Admin\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Services\Admin\AdminAuthService;
use Illuminate\Http\JsonResponse;
use Spatie\RouteAttributes\Attributes\Post;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        private readonly AdminAuthService $adminAuthService
    ) {}

    #[Post('login', withoutMiddleware: ['auth:admin'])]
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $data = $this->adminAuthService->login($request->validated());

            return ApiResponse::sendResponse(
                Response::HTTP_OK,
                'Login successful',
                $data
            );

        } catch (\Exception $e) {
            return ApiResponse::sendResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                'Login failed',
                $e->getMessage()
            );
        }
    }

    #[Post('refresh')]
    public function refresh(): JsonResponse
    {
        try {
            return ApiResponse::sendResponse(
                Response::HTTP_OK,
                'Token refreshed successfully',
                $this->adminAuthService->refresh()
            );
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(
                Response::HTTP_UNAUTHORIZED,
                'Token refresh failed',
                $e->getMessage()
            );
        }
    }

    #[Post('logout')]
    public function logout(): JsonResponse
    {
        try {
            $this->adminAuthService->logout();

            return ApiResponse::sendResponse(
                Response::HTTP_OK,
                'Logged out successfully'
            );
        } catch (\Exception $e) {
            return ApiResponse::sendResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                'Logout failed',
                $e->getMessage()
            );
        }
    }
}
