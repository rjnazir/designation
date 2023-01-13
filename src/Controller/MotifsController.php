<?php

namespace App\Controller;

use App\Entity\Motifs;
use App\Form\MotifsType;
use App\Repository\MotifsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/motifs")
 */
class MotifsController extends AbstractController
{
    /**
     * @Route("/", name="app_motifs_index", methods={"GET"})
     */
    public function index(MotifsRepository $motifsRepository): Response
    {
        return $this->render('motifs/index.html.twig', [
            // 'motifs' => $motifsRepository->findAll(),
            'motifs' => $motifsRepository->findBy([],['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="app_motifs_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MotifsRepository $motifsRepository): Response
    {
        $motif = new Motifs();
        $form = $this->createForm(MotifsType::class, $motif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $motif->setMtfCreated(new DateTime());
            $motif->setMtfUpdated(new DateTime());
            $motif->setUser($this->getUser());

            $motifsRepository->add($motif, true);

            return $this->redirectToRoute('app_motifs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('motifs/new.html.twig', [
            'motif' => $motif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_motifs_show", methods={"GET"})
     */
    public function show(Motifs $motif): Response
    {
        return $this->render('motifs/show.html.twig', [
            'motif' => $motif,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_motifs_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Motifs $motif, MotifsRepository $motifsRepository): Response
    {
        $form = $this->createForm(MotifsType::class, $motif);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $motif->setMtfUpdated(new DateTime());
            $motifsRepository->add($motif, true);

            return $this->redirectToRoute('app_motifs_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('motifs/edit.html.twig', [
            'motif' => $motif,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_motifs_delete", methods={"POST"})
     */
    public function delete(Request $request, Motifs $motif, MotifsRepository $motifsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motif->getId(), $request->request->get('_token'))) {
            $motifsRepository->remove($motif, true);
        }

        return $this->redirectToRoute('app_motifs_index', [], Response::HTTP_SEE_OTHER);
    }
}
