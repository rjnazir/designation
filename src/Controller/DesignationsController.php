<?php

namespace App\Controller;

use App\Entity\Designations;
use App\Form\DesignationsType;
use App\Form\Designations2Type;
use App\Repository\AutresRepository;
use App\Repository\DesignationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;

/**
 * @Route("/designations")
 */
class DesignationsController extends AbstractController
{
    /**
     * @Route("/", name="app_designations_index", methods={"GET"})
     */
    public function index(DesignationsRepository $designationsRepository,AutresRepository $autresRepository): Response
    {
        return $this->render('designations/index.html.twig', [
            'designations' => $designationsRepository->findAll(),'autres' => $autresRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_designations_new", methods={"GET", "POST"})
     */
    public function new(Request $request, DesignationsRepository $designationsRepository): Response
    {
        $designation = new Designations();
        /* $form = $this->createForm(Designations2Type::class, $designation); */
        $form = $this->createForm(DesignationsType::class, $designation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $designation->setDesgnCreated(new \DateTime());
            $designation->setDesignUpdated(new \DateTime());
            $designation->setUser($this->getUser());
            $designationsRepository->add($designation, true);

            return $this->redirectToRoute('app_designations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('designations/new.html.twig', [
            /* 'designation' => $designation, */
            'designation' => $designation,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/newdivers", name="app_designations_newdivers", methods={"GET", "POST"})
     */
    public function newdivers(Request $request, DesignationsRepository $designationsRepository): Response
    {
        $designation = new Designations();
        $form = $this->createForm(DesignationsType::class, $designation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $designation->setDesgnCreated(new DateTime());
            $designation->setDesignUpdated(new DateTime());
            $designation->setUser($this->getUser());
            $designationsRepository->add($designation, true);

            return $this->redirectToRoute('app_designations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('designations/newdivers.html.twig', [
            'designation' => $designation,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}", name="app_designations_show", methods={"GET"})
     */
    public function show(Designations $designation): Response
    {
        return $this->render('designations/show.html.twig', [
            'designation' => $designation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_designations_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Designations $designation, DesignationsRepository $designationsRepository): Response
    {
        $form = $this->createForm(DesignationsType::class, $designation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $designationsRepository->add($designation, true);

            return $this->redirectToRoute('app_designations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('designations/edit.html.twig', [
            'designation' => $designation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_designations_delete", methods={"POST"})
     */
    public function delete(Request $request, Designations $designation, DesignationsRepository $designationsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$designation->getId(), $request->request->get('_token'))) {
            $designationsRepository->remove($designation, true);
        }

        return $this->redirectToRoute('app_designations_index', [], Response::HTTP_SEE_OTHER);
    }

}
