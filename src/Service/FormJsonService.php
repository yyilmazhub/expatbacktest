<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

class FormJsonService
{
    /**
     * Crée une réponse JSON pour une réussite de formulaire.
     *
     * @param string $redirectRoute La route de redirection
     * @param string|null $category La catégorie
     * @return JsonResponse La réponse JSON
     */
    public function createSuccessResponse(string $redirectRoute, ?string $category): JsonResponse
    {
        return new JsonResponse([
            'code' => '200',
            'html' => $redirectRoute,
            'category' => $category,
        ]);
    }

    /**
     * Crée une réponse JSON pour une erreur de formulaire.
     *
     * @param array $errors Les erreurs du formulaire
     * @return JsonResponse La réponse JSON
     */
    public function createErrorResponse(array $errors): JsonResponse
    {
        return new JsonResponse([
            'code' => '400',
            'errors' => $errors,
        ]);
    }
}
