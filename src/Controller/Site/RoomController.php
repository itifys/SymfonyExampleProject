<?php

namespace App\Controller\Site;

use App\Entity\Room;
use App\Form\Room1Type;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/room")
 */
class RoomController extends AbstractController
{
    /**
     * @Route("/", name="room_site_index", methods={"GET"})
     */
    public function index(RoomRepository $roomRepository): Response
    {
        return $this->render('site/room/index.html.twig', [
            'rooms' => $roomRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="room_site_show", methods={"GET"})
     */
    public function show(Room $room): Response
    {
        return $this->render('site/room/show.html.twig', [
            'room' => $room,
        ]);
    }

}
