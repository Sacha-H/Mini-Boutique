<?php

namespace App\Controller;


use App\Repository\GameRepository;
use App\Repository\PlayerRepository;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ArticleRepository $articleRepository, GameRepository $gameRepository, PlayerRepository $playerRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'articles' => $articleRepository->findAll(),
            'articlesByDate' => $articleRepository->findByDate(),
            'game' => $gameRepository->findAll(),
            'player' => $playerRepository->findAll(),
        ]);
    }
}
