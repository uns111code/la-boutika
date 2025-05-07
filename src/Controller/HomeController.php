<?php

namespace App\Controller;

use App\Repository\PosteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(PosteRepository $posteRepository): Response
    {
        // récupérer les postes
        $posts = $posteRepository->findAll();
        // dd($posts);
        // transmettre les postes à la vue
        return $this->render('home/index.html.twig', [
            'posts' => $posts,
        ]);

        // afficher la vue
        // return $this->render('home/index.html.twig', [
        //     'controller_name' => 'HomeController',
        // ]);
    }
}
