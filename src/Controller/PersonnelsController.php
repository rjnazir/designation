<?php

namespace App\Controller;

use App\Entity\Personnels;
use App\Form\PersonnelsType;
use App\Repository\PersonnelsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/personnels")
 */
class PersonnelsController extends AbstractController
{
    /**
     * @Route("/", name="app_personnels_index", methods={"GET"})
     */
    public function index(PersonnelsRepository $personnelsRepository): Response
    {
        return $this->render('personnels/index.html.twig', [
            // 'personnels' => $personnelsRepository->findAll(),
            'personnels' => $personnelsRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="app_personnels_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PersonnelsRepository $personnelsRepository): Response
    {
        $personnel = new Personnels();
        $form = $this->createForm(PersonnelsType::class, $personnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $personnel->setPersCreated(new DateTime());
            $personnel->setPersUpdated(NULL);
            $personnel->setUser($this->getUser());

            $personnelsRepository->add($personnel, true);

            $this->addFlash('success', 'L\'ajout de personnel effectué avec succès.');

            return $this->redirectToRoute('app_personnels_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('personnels/new.html.twig', [
            'personnel' => $personnel,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_personnels_show", methods={"GET"})
     */
    public function show(Personnels $personnel): Response
    {
        return $this->render('personnels/show.html.twig', [
            'personnel' => $personnel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_personnels_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Personnels $personnel, PersonnelsRepository $personnelsRepository): Response
    {
        $form = $this->createForm(PersonnelsType::class, $personnel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $personnel->setPersUpdated(new DateTime());
            $personnel->setUser($this->getUser());

            $personnelsRepository->add($personnel, true);

            $this->addFlash('success', 'La modification des renseignements du personnel est effectué avec succès.');

            return $this->redirectToRoute('app_personnels_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('personnels/edit.html.twig', [
            'personnel' => $personnel,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_personnels_delete", methods={"POST"})
     */
    public function delete(Request $request, Personnels $personnel, PersonnelsRepository $personnelsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personnel->getId(), $request->request->get('_token'))) {
            $personnelsRepository->remove($personnel, true);
        }

        $this->addFlash('success', 'La suppression du personnel est effectué avec succès.');

        return $this->redirectToRoute('app_personnels_index', [], Response::HTTP_SEE_OTHER);
    }
}
