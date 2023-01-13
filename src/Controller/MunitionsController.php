<?php

namespace App\Controller;

use App\Entity\Munitions;
use App\Form\MunitionsType;
use App\Repository\MunitionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/munitions")
 */
class MunitionsController extends AbstractController
{
    /**
     * @Route("/", name="app_munitions_index", methods={"GET"})
     */
    public function index(MunitionsRepository $munitionsRepository): Response
    {
        return $this->render('munitions/index.html.twig', [
            // 'munitions' => $munitionsRepository->findAll(),
            'munitions' => $munitionsRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="app_munitions_new", methods={"GET", "POST"})
     */
    public function new(Request $request, MunitionsRepository $munitionsRepository): Response
    {
        $munition = new Munitions();
        $form = $this->createForm(MunitionsType::class, $munition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $munition->setMunCreated(new DateTime());
            $munition->setMunUpdated(NULL);
            $munition->setUser($this->getUser());

            $this->addFlash('success', 'L\'ajout de munition de la munition est effectuée avec succès');

            $munitionsRepository->add($munition, true);

            return $this->redirectToRoute('app_munitions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('munitions/new.html.twig', [
            'munition' => $munition,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_munitions_show", methods={"GET"})
     */
    public function show(Munitions $munition): Response
    {
        return $this->render('munitions/show.html.twig', [
            'munition' => $munition,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_munitions_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Munitions $munition, MunitionsRepository $munitionsRepository): Response
    {
        $form = $this->createForm(MunitionsType::class, $munition);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $munition->setMunUpdated(new DateTime());
            $munition->setUser($this->getUser());

            $this->addFlash('success', 'La modification de la munition est effectuée avec succès');

            $munitionsRepository->add($munition, true);

            return $this->redirectToRoute('app_munitions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('munitions/edit.html.twig', [
            'munition' => $munition,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_munitions_delete", methods={"POST"})
     */
    public function delete(Request $request, Munitions $munition, MunitionsRepository $munitionsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$munition->getId(), $request->request->get('_token'))) {
            $munitionsRepository->remove($munition, true);

            $this->addFlash('success', 'La suppression de la munition est effectuée avec succès');
        }

        return $this->redirectToRoute('app_munitions_index', [], Response::HTTP_SEE_OTHER);
    }
}
