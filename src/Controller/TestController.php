<?php

namespace App\Controller;

use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test/twig', name: 'app_test')]
    public function index(): Response
    {
        // Instanciation de faker avec la locale française
        $faker = Factory::create('fr_FR');
        // Initialisation d'un tableau de users
        $users =  [];

        // Génération de nom de users dans l'array
        for ($i = 0; $i < 9; $i++) {
            $user = [
                'name' => $faker->name(),
                'email' => $faker->email(),
                'age' => $faker->randomNumber(2, false),
                'address' => [
                    'street' => $faker->streetName(),
                    'code_postal' => $faker->postcode(),
                    'city' => $faker->city(),
                    'country' => $faker->country(),
                ],
                'picture' => $faker->imageUrl(360, 360, 'animals', true, 'dogs', true, 'jpg')
            ];

            $users[$i] = $user;
        }

        // Rendu du template avec les users
        return $this->render('test/index.html.twig', [
            'title' => "page d'accueil",
            'users' => $users,
        ]);
    }
}
