<?php

namespace App\Controller;

use App\Entity\Absences;
use App\Form\AbsencesType;
use App\Repository\AbsencesRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/absences")
 */
class AbsencesController extends AbstractController
{
    /**
     * @Route("/", name="app_absences_index", methods={"GET"})
     */
    public function index(AbsencesRepository $absencesRepository): Response
    {
        return $this->render('absences/index.html.twig', [
            // 'absences' => $absencesRepository->findAll(),
            'absences' => $absencesRepository->findBy([],['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="app_absences_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AbsencesRepository $absencesRepository): Response
    {
        $absence = new Absences();
        $form = $this->createForm(AbsencesType::class, $absence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $absence->setAbsCreated(new DateTime());
            $absence->setAbsUpdated(NULL);
            $absence->setUser($this->getUser());

            $absencesRepository->add($absence, true);

            $this->addFlash('success', 'L\'ajout de l\'absence du personnel est effectué avec succès.');

            return $this->redirectToRoute('app_absences_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('absences/new.html.twig', [
            'absence' => $absence,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_absences_show", methods={"GET"})
     */
    public function show(Absences $absence): Response
    {
        return $this->render('absences/show.html.twig', [
            'absence' => $absence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_absences_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Absences $absence, AbsencesRepository $absencesRepository): Response
    {
        $form = $this->createForm(AbsencesType::class, $absence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $absence->setAbsUpdated(new DateTime());
            $absence->setUser($this->getUser());

            $absencesRepository->add($absence, true);

            $this->addFlash('success', 'La modification de l\'absence est effectuée avec succès.');

            return $this->redirectToRoute('app_absences_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('absences/edit.html.twig', [
            'absence' => $absence,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_absences_delete", methods={"POST"})
     */
    public function delete(Request $request, Absences $absence, AbsencesRepository $absencesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$absence->getId(), $request->request->get('_token'))) {
            $absencesRepository->remove($absence, true);

            $this->addFlash('success', 'La suppression de l\'absence est effectuée avec succès.');
        }

        return $this->redirectToRoute('app_absences_index', [], Response::HTTP_SEE_OTHER);
    }
}
