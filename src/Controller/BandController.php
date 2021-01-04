<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BandRepository;
use Symfony\Component\HttpFoundation\Request;

class BandController extends AbstractController
{
    /**
     * @Route("/bands", name="bands_list")
     */
    public function index(BandRepository $bandRepository): Response
    {
        $list = $bandRepository->findAll();
        return $this->render('band/index.html.twig', [
            'bands' => $list,
        ]);
    }

    /**
     * @Route("/band/{id}", name="band_show", requirements={"id":"\d+"})
     */
    public function detail(BandRepository $bandRepository, int $id): Response
    {
        $band = $bandRepository->find($id);
        date_default_timezone_set('Europe/Paris');
        $date = date('Y/m/d', time());
        return $this->render('band/show.html.twig', [
            'band' => $band,
            'members' => $band->getMembers(),
        ]);
    }

    /**
     * @Route("/band/", name="band_index", methods={"GET"})
     */
    public function list(BandRepository $bandRepository): Response
    {
        return $this->render('band/indexAdmin.html.twig', [
            'bands' => $bandRepository->findAll(),
        ]);
    }

  

}
