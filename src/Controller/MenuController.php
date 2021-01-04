<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ConcertRepository;
use App\Entity\Hall;

class MenuController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ConcertRepository $concertRepository): Response
    {
        date_default_timezone_set('Europe/Paris');
        $date = date('Y/m/d h:i:s a', time());
        
        $concertToCome = $concertRepository->findByLaterDate($date);

        return $this->render('menu/index.html.twig', [
            'concerts' => $concertToCome,
        ]);
    }
}
