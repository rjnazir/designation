<?php

namespace App\Controller;

use App\Entity\TypeArmements;
use App\Form\TypeArmementsType;
use App\Repository\TypeArmementsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/type_armements")
 */
class TypeArmementsController extends AbstractController
{
    /**
     * @Route("/", name="app_type_armements_index", methods={"GET"})
     */
    public function index(TypeArmementsRepository $typeArmementsRepository): Response
    {
        return $this->render('type_armements/index.html.twig', [
            // 'type_armements' => $typeArmementsRepository->findAll(),
            'type_armements' => $typeArmementsRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="app_type_armements_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TypeArmementsRepository $typeArmementsRepository): Response
    {
        $typeArmement = new TypeArmements();
        $form = $this->createForm(TypeArmementsType::class, $typeArmement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $typeArmement->setArmCreated(new DateTime());
            $typeArmement->setArmUpdated(NULL);
            $typeArmement->setUser($this->getUser());

            $typeArmementsRepository->add($typeArmement, true);

            $this->addFlash('success', 'L\'ajout de type d\'armement est effectué avec succès.');

            return $this->redirectToRoute('app_type_armements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_armements/new.html.twig', [
            'type_armement' => $typeArmement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_type_armements_show", methods={"GET"})
     */
    public function show(TypeArmements $typeArmement): Response
    {
        return $this->render('type_armements/show.html.twig', [
            'type_armement' => $typeArmement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_type_armements_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypeArmements $typeArmement, TypeArmementsRepository $typeArmementsRepository): Response
    {
        $form = $this->createForm(TypeArmementsType::class, $typeArmement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $typeArmement->setArmUpdated(new DateTime());
            $typeArmement->setUser($this->getUser());

            $this->addFlash('success', 'La modification de type d\'armement est effectué avec succès');

            $typeArmementsRepository->add($typeArmement, true);

            return $this->redirectToRoute('app_type_armements_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_armements/edit.html.twig', [
            'type_armement' => $typeArmement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_type_armements_delete", methods={"POST"})
     */
    public function delete(Request $request, TypeArmements $typeArmement, TypeArmementsRepository $typeArmementsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeArmement->getId(), $request->request->get('_token'))) {
            $typeArmementsRepository->remove($typeArmement, true);

            $this->addFlash('success', 'La suppression de type d\'armement effetué avec succès');
        }

        return $this->redirectToRoute('app_type_armements_index', [], Response::HTTP_SEE_OTHER);
    }
}
