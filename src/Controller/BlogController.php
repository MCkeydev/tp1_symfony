<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * La route suivante accepte deux paramètres : "id" et "title", qui sont respectivement un int et une string.
     */
    #[Route('/blog/{id}/{title}', name: 'app_blog', methods: ['GET'], requirements: ['name' => '[a-zA-Z]{5,50}', 'id' => '[0-9]{2,6}'])]
    public function index(int $id, string $title): Response
    {
        return $this->render('blog/index.html.twig', [
            'id' => $id,
            'title' => $title,
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
