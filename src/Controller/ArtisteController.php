<?php

namespace App\Controller;

use App\Entity\Artiste;
use App\Entity\Type;
use App\Repository\ArtisteRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtisteController extends AbstractController
{
    #[Route('/discotheque/artistes', name: 'app_artiste')]
    public function index(): Response
    {
        return $this->render('artiste/index.html.twig', [
            'controller_name' => 'ArtisteController',
        ]);
    }

    #[Route('/discotheque/artistes/type/{name}', name: 'app_artists_by_type')]
    public function aristsByType(Type $artistType) {
        return $this->render('artiste_crud/index.html.twig', [
            'artistes' => $artistType->getArtistes(),
            'type' => $artistType->getName(),
        ]);
    }

    #[Route('/discotheque/artiste/{id}', name: 'app_artiste_show', methods: ['GET'])]
    public function show(Artiste $artiste): Response
    {
        return $this->render('artiste_crud/show.html.twig', [
            'artiste' => $artiste,
        ]);
    }
}
