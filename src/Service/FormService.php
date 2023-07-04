<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use App\Service\FormJsonService;

class FormService
{
    private $em;
    private $urlGenerator;
    private $formErrorService;
    private $jsonResponseService;

    public function __construct(
        EntityManagerInterface $em,
        UrlGeneratorInterface $urlGenerator,
        FormErrorService $formErrorService,
        FormJsonService $jsonResponseService
    ) {
        $this->em = $em;
        $this->urlGenerator = $urlGenerator;
        $this->formErrorService = $formErrorService;
        $this->jsonResponseService = $jsonResponseService;
    }

    public function handleArticleFormData(FormInterface $articleForm)
    {
        if ($articleForm->isSubmitted() && $articleForm->isValid()) {
            return $this->handleValidForm($articleForm);
        } else {
            return $this->handleInvalidForm($articleForm);
        }
    }

    private function handleValidForm(FormInterface $articleForm)
    {
        $article = $articleForm->getData();
        $categoryName = $article->getCategory()
            ? $article->getCategory()->getName()
            : null;

        $this->em->persist($article);
        $this->em->flush();
        $redirectRoute = $this->urlGenerator->generate('app_main_page');

        return $this->jsonResponseService->createSuccessResponse(
            $redirectRoute,
            $categoryName
        );
    }

    private function handleInvalidForm(FormInterface $articleForm)
    {
        $errors = $this->formErrorService->getErrorMessages($articleForm);

        return $this->jsonResponseService->createErrorResponse($errors);
    }
}
