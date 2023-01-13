<?php

namespace App\Controller;

use App\Entity\Unites;
use App\Form\UnitesType;
use App\Repository\UnitesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/unites")
 */
class UnitesController extends AbstractController
{
    /**
     * @Route("/", name="app_unites_index", methods={"GET"})
     */
    public function index(UnitesRepository $unitesRepository): Response
    {
        return $this->render('unites/index.html.twig', [
            // 'unites' => $unitesRepository->findAll(),
            'unites' => $unitesRepository->findBy([],['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="app_unites_new", methods={"GET", "POST"})
     */
    public function new(Request $request, UnitesRepository $unitesRepository): Response
    {
        $unite = new Unites();
        $form = $this->createForm(UnitesType::class, $unite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $unite->setUteCreated(new DateTime());
            $unite->setUteUpdated(NULL);
            $unite->setUser($this->getUser());

            $unitesRepository->add($unite, true);

            return $this->redirectToRoute('app_unites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unites/new.html.twig', [
            'unite' => $unite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_unites_show", methods={"GET"})
     */
    public function show(Unites $unite): Response
    {
        return $this->render('unites/show.html.twig', [
            'unite' => $unite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_unites_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Unites $unite, UnitesRepository $unitesRepository): Response
    {
        $form = $this->createForm(UnitesType::class, $unite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $unite->setUteUpdated(new DateTime());
            $unite->setUser($this->getUser());

            $unitesRepository->add($unite, true);

            return $this->redirectToRoute('app_unites_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('unites/edit.html.twig', [
            'unite' => $unite,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_unites_delete", methods={"POST"})
     */
    public function delete(Request $request, Unites $unite, UnitesRepository $unitesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unite->getId(), $request->request->get('_token'))) {
            $unitesRepository->remove($unite, true);
        }

        return $this->redirectToRoute('app_unites_index', [], Response::HTTP_SEE_OTHER);
    }
}
