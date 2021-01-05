<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BandRepository;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Band;
use App\Form\BandType;

class BandController extends AbstractController
{
    /**
     * @Route("/bands", name="bands_list")
     * 
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
            'band_concerts' => $bandRepository->nextConcerts($date, $id),
        ]);
    }

    /**
     * @Route("/band/", name="band_index", methods={"GET"})
     * @isGranted("ROLE_ADMIN")
     */
    public function list(BandRepository $bandRepository): Response
    {
        return $this->render('band/indexAdmin.html.twig', [
            'bands' => $bandRepository->findAll(),
        ]);
    }

    /**
     * @Route("/bands/new", name="band_new", methods={"GET","POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response
    {
        $band = new Band();
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($band);
            $entityManager->flush();

            return $this->redirectToRoute('band_index');
        }

        return $this->render('band/new.html.twig', [
            'band' => $band,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/bands/{id}/edit", name="band_edit", methods={"GET","POST"})
     * @isGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Band $band): Response
    {
        $form = $this->createForm(BandType::class, $band);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('band_index');
        }

        return $this->render('band/edit.html.twig', [
            'band' => $band,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/bands/delete/{id}", name="band_delete")
     * @isGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Band $band): Response
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($band);
        $entityManager->flush();
        
        return $this->redirectToRoute('band_index');
    }

  

}
