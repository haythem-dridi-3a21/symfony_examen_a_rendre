<?php

namespace App\Controller;

use App\Entity\Show;
use App\Form\ShowType;
use App\Form\TheatrePlayType;
use App\Repository\TheatrePlayRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TheatrePlayController extends AbstractController
{
    #[Route('/displayplay', name: 'app_displayplay')]
    public function DisplayPlay(TheatrePlayRepository $theatrePlayRepository): Response
    {
        $theatres = $theatrePlayRepository->findAll();

        return $this->render('TheatrePlay/list.html.twig', [
            'theatres' => $theatres,
        ]);
    }

    #[Route('/displayplay/order', name: 'app_displayplay_order')]
    public function DisplayPlayOrderByTitleAndDuration(TheatrePlayRepository $theatrePlayRepository): Response
    {
        $theatres = $theatrePlayRepository->orderByTitleAndDuration();

        return $this->render('TheatrePlay/list.html.twig', [
            'theatres' => $theatres,
        ]);
    }

    #[Route('/ajoutershow', name: 'app_add_show')]
    public function Addshow(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $show = new Show();

        $show->setNbrseat(30);

        $form = $this->createForm(ShowType::class, $show);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $managerRegistry->getManager();

            $em->persist($show);

            $em->flush();

            return $this->redirectToRoute('app_displayplay');
        }

        return $this->render('TheatrePlay/add-show.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/update/{id}', name: 'update_theatre_play')]
    public function UpdateTheatrePlay($id, ManagerRegistry $managerRegistry, TheatrePlayRepository $theatrePlayRepository, Request $request)
    {

        $em = $managerRegistry->getManager();

        $play = $theatrePlayRepository->find($id);

        $form = $this->createform(TheatrePlayType::class, $play);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->persist($play);

            $em->flush();

            return $this->redirectToRoute('app_displayplay');
        }

        return $this->render('TheatrePlay/update.html.twig', [
            "f" => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'delete_theatre_play')]
    public function DeleteTheatrePlay($id, ManagerRegistry $managerRegistry, TheatrePlayRepository $theatrePlayRepository)
    {
        $em = $managerRegistry->getManager();

        $play = $theatrePlayRepository->find($id);

        $em->remove($play);

        $em->flush();

        return $this->redirectToRoute('app_displayplay');

    }

    #[Route('/total_number/{id}', name: 'app_total_number')]
    public function totalNumber($id, TheatrePlayRepository $theatrePlayRepository): Response
    {
        $nb = $theatrePlayRepository->TotalNumber($id);

        return $this->render('TheatrePlay/total-number.html.twig', [
            'nb' => $nb,
        ]);
    }

}
