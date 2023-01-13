<?php

namespace App\Controller;

use App\Entity\Transports;
use App\Form\TransportsType;
use App\Repository\TransportsRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/transports")
 */
class TransportsController extends AbstractController
{
    /**
     * @Route("/", name="app_transports_index", methods={"GET"})
     */
    public function index(TransportsRepository $transportsRepository): Response
    {
        return $this->render('transports/index.html.twig', [
            // 'transports' => $transportsRepository->findAll(),
            'transports' => $transportsRepository->findBy([], ['id'=>'DESC']),
        ]);
    }

    /**
     * @Route("/new", name="app_transports_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TransportsRepository $transportsRepository): Response
    {
        $transport = new Transports();
        $form = $this->createForm(TransportsType::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $transport->setTranspCreated(new DateTime());
            $transport->setTranspUpdated(NULL);
            $transport->setUser($this->getUser());

            $transportsRepository->add($transport, true);

            $this->addFlash('success', 'L\'ajout de nouvel transport est effectué.');

            return $this->redirectToRoute('app_transports_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transports/new.html.twig', [
            'transport' => $transport,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_transports_show", methods={"GET"})
     */
    public function show(Transports $transport): Response
    {
        return $this->render('transports/show.html.twig', [
            'transport' => $transport,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_transports_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Transports $transport, TransportsRepository $transportsRepository): Response
    {
        $form = $this->createForm(TransportsType::class, $transport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $transport->setTranspUpdated(new DateTime());
            $transport->setUser($this->getUser());

            $this->addFlash('success', 'La modification de transport est effectuée avec succès.');

            $transportsRepository->add($transport, true);

            return $this->redirectToRoute('app_transports_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('transports/edit.html.twig', [
            'transport' => $transport,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_transports_delete", methods={"POST"})
     */
    public function delete(Request $request, Transports $transport, TransportsRepository $transportsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transport->getId(), $request->request->get('_token'))) {
            $transportsRepository->remove($transport, true);

            $this->addFlash('success','La suppression de transport esteffectuée.');
        }

        return $this->redirectToRoute('app_transports_index', [], Response::HTTP_SEE_OTHER);
    }
}
