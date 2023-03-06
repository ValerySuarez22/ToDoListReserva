<?php

namespace App\Controller;

use App\Entity\Reservaciones;
use App\Form\ReservacionesType;
use App\Repository\ReservacionesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservaciones')]
class ReservacionesController extends AbstractController
{
    #[Route('/', name: 'app_reservaciones_index', methods: ['GET'])]
    public function index(ReservacionesRepository $reservacionesRepository): Response
    {
        return $this->render('reservaciones/index.html.twig', [
            'reservaciones' => $reservacionesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservaciones_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReservacionesRepository $reservacionesRepository): Response
    {
        $reservacione = new Reservaciones();
        $form = $this->createForm(ReservacionesType::class, $reservacione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservacionesRepository->save($reservacione, true);

            return $this->redirectToRoute('app_reservaciones_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservaciones/new.html.twig', [
            'reservacione' => $reservacione,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservaciones_show', methods: ['GET'])]
    public function show(Reservaciones $reservacione): Response
    {
        return $this->render('reservaciones/show.html.twig', [
            'reservacione' => $reservacione,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservaciones_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservaciones $reservacione, ReservacionesRepository $reservacionesRepository): Response
    {
        $form = $this->createForm(ReservacionesType::class, $reservacione);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservacionesRepository->save($reservacione, true);

            return $this->redirectToRoute('app_reservaciones_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservaciones/edit.html.twig', [
            'reservacione' => $reservacione,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservaciones_delete', methods: ['POST'])]
    public function delete(Request $request, Reservaciones $reservacione, ReservacionesRepository $reservacionesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservacione->getId(), $request->request->get('_token'))) {
            $reservacionesRepository->remove($reservacione, true);
        }

        return $this->redirectToRoute('app_reservaciones_index', [], Response::HTTP_SEE_OTHER);
    }
}
