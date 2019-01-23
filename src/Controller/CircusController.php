<?php

namespace App\Controller;

use App\Entity\Circus;
use App\Form\CircusType;
use App\Repository\CircusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/circus")
 */
class CircusController extends AbstractController
{
    /**
     * @Route("/", name="circus_index", methods={"GET"})
     */
    public function index(CircusRepository $circusRepository): Response
    {
        return $this->render('circus/index.html.twig', [
            'circuses' => $circusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="circus_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $circus = new Circus();
        $form = $this->createForm(CircusType::class, $circus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($circus);
            $entityManager->flush();

            return $this->redirectToRoute('circus_index');
        }

        return $this->render('circus/new.html.twig', [
            'circus' => $circus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circus_show", methods={"GET"})
     */
    public function show(Circus $circus): Response
    {
        return $this->render('circus/show.html.twig', [
            'circus' => $circus,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="circus_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Circus $circus): Response
    {
        $form = $this->createForm(CircusType::class, $circus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('circus_index', [
                'id' => $circus->getId(),
            ]);
        }

        return $this->render('circus/edit.html.twig', [
            'circus' => $circus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="circus_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Circus $circus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$circus->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($circus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('circus_index');
    }
}
