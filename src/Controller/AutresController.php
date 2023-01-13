<?php

namespace App\Controller;

use App\Entity\Autres;
use App\Form\AutresType;
use App\Repository\AutresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;
/**
 * @Route("/autres")
 */
class AutresController extends AbstractController
{
    /**
     * @Route("/", name="app_autres_index", methods={"GET"})
     */
    public function index(AutresRepository $autresRepository): Response
    {
        return $this->render('autres/index.html.twig', [
            'autres' => $autresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_autres_new", methods={"GET", "POST"})
     */
    public function new(Request $request, AutresRepository $autresRepository): Response
    {
        $autre = new Autres();
        $form = $this->createForm(AutresType::class, $autre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $autre->setUser($this->getUser());
            $autre->setAutreCreated(new DateTime());
            $autresRepository->add($autre, true);

            return $this->redirectToRoute('app_designations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('autres/new.html.twig', [
            'autre' => $autre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_autres_show", methods={"GET"})
     */
    public function show(Autres $autre): Response
    {
        return $this->render('autres/show.html.twig', [
            'autre' => $autre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_autres_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Autres $autre, AutresRepository $autresRepository): Response
    {
        $form = $this->createForm(AutresType::class, $autre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $autresRepository->add($autre, true);

            return $this->redirectToRoute('app_designations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('autres/edit.html.twig', [
            'autre' => $autre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_autres_delete", methods={"POST"})
     */
    public function delete(Request $request, Autres $autre, AutresRepository $autresRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$autre->getId(), $request->request->get('_token'))) {
            $autresRepository->remove($autre, true);
        }

        // return $this->redirectToRoute('app_autres_index', [], Response::HTTP_SEE_OTHER);
        return $this->redirectToRoute('app_designations_index', [], Response::HTTP_SEE_OTHER);
    }
}
