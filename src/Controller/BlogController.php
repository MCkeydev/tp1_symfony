<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * La route suivante accepte deux paramètres : "id" et "title", qui sont respectivement un int et une string.
     */
    #[Route('/blog/{id}/{title}', name: 'app_blog', requirements: ['name' => '[a-zA-Z]{5,50}', 'id' => '[0-9]{2,6}'], methods: ['GET'])]
    public function index(int $id, string $title): Response
    {
        return $this->render('blog/index.html.twig', [
            'id' => $id,
            'title' => $title,
        ]);
    }

    #[Route('/blog/articles', name: 'app_blog_article')]
    public function getAllArticles(ArticleRepository $articleRepository, CategoryRepository $categoryRepository) {
        $articles = $articleRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
        ]);
    }

    #[Route('/blog/articles/{slug}', name: 'app_single_article')]
    public function singleArticle(Article $article, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('blog/single.html.twig', [
            'article' => $article,
            'categories' => $categories,
        ]);
    }

    #[Route('/blog/category/{slug}', name: 'app_articles_by_category')]
    public function articlesByCategory(Category $category, CategoryRepository $categoryRepository) {
        $categories = $categoryRepository->findAll();

        return $this->render('blog/index.html.twig', [
            'articles' => $category->getArticles(),
            'categories' => $categories,
            'category' => $category,
        ]);
    }
    /**
     * Route GET du contrôleur afin de tester le principe de routage.
     */
    #[Route('/', name: 'app_hello_world', methods: ['GET'])]
    public function helloWorld(): Response
    {
        // Renvoie au client un header d'ordre 1
        return new Response('<h1>Hello world !</h1>');
    }
}
