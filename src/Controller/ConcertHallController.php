<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConcertHallController extends AbstractController
{
    /**
     * @Route("/concert/hall", name="concert_hall")
     */
    public function index(): Response
    {
        return $this->render('concert_hall/index.html.twig', [
            'controller_name' => 'ConcertHallController',
        ]);
    }
}
