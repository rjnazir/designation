<?php

namespace App\Controller;

use App\Entity\Tenues;
use App\Form\TenuesType;
use App\Repository\TenuesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/tenues")
 */
class TenuesController extends AbstractController
{
    /**
     * @Route("/", name="app_tenues_index", methods={"GET"})
     */
    public function index(TenuesRepository $tenuesRepository): Response
    {
        return $this->render('tenues/index.html.twig', [
            // 'tenues' => $tenuesRepository->findAll(),
            'tenues' => $tenuesRepository->findBy([],['id'=>'desc']),
        ]);
    }

    /**
     * @Route("/new", name="app_tenues_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TenuesRepository $tenuesRepository): Response
    {
        $tenue = new Tenues();
        $form = $this->createForm(TenuesType::class, $tenue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tenue->setTnCreated(new DateTime());
            $tenue->setTnUpdated(NULL);
            $tenue->setUser($this->getUser());
            
            $tenuesRepository->add($tenue, true);

            $this->addFlash('success', 'Ajout de tenue effectué avec succès.');

            return $this->redirectToRoute('app_tenues_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tenues/new.html.twig', [
            'tenue' => $tenue,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_tenues_show", methods={"GET"})
     */
    public function show(Tenues $tenue): Response
    {
        return $this->render('tenues/show.html.twig', [
            'tenue' => $tenue,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_tenues_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Tenues $tenue, TenuesRepository $tenuesRepository): Response
    {
        $form = $this->createForm(TenuesType::class, $tenue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $tenue->setTnUpdated(new DateTime());
            $tenue->setUser($this->getUser());

            $tenuesRepository->add($tenue, true);

            $this->addFlash('success', 'Modification de tenue effectuée avec succès.');

            return $this->redirectToRoute('app_tenues_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('tenues/edit.html.twig', [
            'tenue' => $tenue,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_tenues_delete", methods={"POST"})
     */
    public function delete(Request $request, Tenues $tenue, TenuesRepository $tenuesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tenue->getId(), $request->request->get('_token'))) {
            $tenuesRepository->remove($tenue, true);
        }

        $this->addFlash('success', 'Suppression de tenue effectuée avec succès.');

        return $this->redirectToRoute('app_tenues_index', [], Response::HTTP_SEE_OTHER);
    }
}
