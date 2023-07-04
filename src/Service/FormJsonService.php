<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

class FormJsonService
{
    public function createSuccessResponse(string $redirectRoute, ?string $category): JsonResponse
    {
        return new JsonResponse([
            'code' => '200',
            'html' => $redirectRoute,
            'category' => $category,
        ]);
    }

    public function createErrorResponse(array $errors): JsonResponse
    {
        return new JsonResponse([
            'code' => '400',
            'errors' => $errors,
        ]);
    }
}
