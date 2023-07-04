<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainPageController extends AbstractController
{
    /**
     * @Route("/main/{categoryName}", name="app_main_page")
     */
    public function index(
        ArticleRepository $articleRepository,
        ?string $categoryName = null
    ): Response {
        // Récupérer les articles en fonction du nom de catégorie
        $articles = $articleRepository->findByField($categoryName);

        return $this->render('main_page/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
