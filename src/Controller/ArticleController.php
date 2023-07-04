<?php

namespace App\Controller;

use App\Service\FormService;
use App\Repository\ArticleRepository;
use App\Form\Type\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="app_article")
     */
    public function index(
        ArticleRepository $articleRepository,
        FormService $formService,
        RequestStack $requestStack
    ): Response {
        $request = $requestStack->getMainRequest();
        $articleForm = $this->createForm(
            ArticleType::class,
            $articleRepository->new()
        );
        $articleForm->handleRequest($request);
        if ($request->isMethod('POST') && $articleForm->isSubmitted()) {
            $formData = $request->request->all();
            return $formService->handleArticleFormData($articleForm);
            
        }

        return $this->render('article/create_article.html.twig', [
            'form' => $articleForm->createView(),
        ]);
    }
}
