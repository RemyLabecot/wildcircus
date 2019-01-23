<?php

namespace App\Controller;

use App\Entity\Performers;
use App\Form\PerformersType;
use App\Repository\PerformersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/performers")
 */
class PerformersController extends AbstractController
{
    /**
     * @Route("/", name="performers_index", methods={"GET"})
     */
    public function index(PerformersRepository $performersRepository): Response
    {
        return $this->render('performers/index.html.twig', [
            'performers' => $performersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="performers_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $performer = new Performers();
        $form = $this->createForm(PerformersType::class, $performer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($performer);
            $entityManager->flush();

            return $this->redirectToRoute('performers_index');
        }

        return $this->render('performers/new.html.twig', [
            'performer' => $performer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performers_show", methods={"GET"})
     */
    public function show(Performers $performer): Response
    {
        return $this->render('performers/show.html.twig', [
            'performer' => $performer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="performers_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Performers $performer): Response
    {
        $form = $this->createForm(PerformersType::class, $performer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('performers_index', [
                'id' => $performer->getId(),
            ]);
        }

        return $this->render('performers/edit.html.twig', [
            'performer' => $performer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performers_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Performers $performer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$performer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($performer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('performers_index');
    }
}
