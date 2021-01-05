<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ConcertRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Concert;
use App\Form\ConcertType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ConcertController extends AbstractController
{
    /**
     * @Route("/concert", name="concert")
     * @Route("/concert", name="concert_success")
     */
    public function index(ConcertRepository $concertRepository): Response
    {
        date_default_timezone_set('Europe/Paris');
        $date = date('Y/m/d', time());
        
        $concertToCome = $concertRepository->findByLaterDate($date);

        return $this->render('concert/index.html.twig', [
            'date' => $date,
            'concerts' => $concertToCome,
        ]);
    }

    /**
     * @Route("/archive", name="archive")
     */
    public function archive(ConcertRepository $concertRepository): Response
    {
        date_default_timezone_set('Europe/Paris');
        $date = date('Y/m/d', time());
        
        $concertDone = $concertRepository->findByPriorDate($date);

        return $this->render('concert/archive.html.twig', [
            'concerts' => $concertDone,
        ]);
    }

    


    /**
     * @Route("/concert/create", name="concert_create")
     * @isGranted("ROLE_ADMIN")
     */
    public function createConcert(Request $request): Response
    {
        $concert = new Concert();

        $form = $this->createForm(ConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $concert = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            return $this->redirectToRoute('concert_success');
        }
        return $this->render('concert/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/delete/{id}", name="concert_delete")
     * @isGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Concert $concert): Response {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($concert);
        $entityManager->flush();

        return $this->redirectToRoute('concert');
    }

    /**
     * @Route("/concert/edit/{id}", name="concert_update")
     * @isGranted("ROLE_ADMIN")
     */
    public function updateConcert(Request $request, Concert $concert): Response
    {

        $form = $this->createForm(ConcertType::class, $concert);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $concert = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($concert);
            $entityManager->flush();

            return $this->redirectToRoute('concert_success');
        }
        return $this->render('concert/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/concert/show/{id}", name="concert_show", methods={"GET"})
     */
    public function show(Concert $concert): Response
    {
        return $this->render('concert/show.html.twig', [
            'concert' => $concert,
        ]);
    }
}
