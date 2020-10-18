<?php

namespace App\Controller\Admin;

use App\Controller\BaseController;
use App\Controller\Service\UploadService;
use App\Entity\PlayExternal;
use App\Form\PlayExternalType;
use App\Repository\PlayExternalRepository;
use App\Repository\PlayPhotoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/play-external")
 */
class PlayExternalController extends BaseController
{
    /**
     * @Route("/", name="play_external_index", methods={"GET"})
     */
    public function index(PlayExternalRepository $playExternalRepository): Response
    {
        return $this->render('admin/play_external/index.html.twig', [
            'play_externals' => $playExternalRepository->findBy([],['premiere_date'=>'desc']),
        ]);
    }

    /**
     * @Route("/new", name="play_external_new", methods={"GET","POST"})
     */
    public function new(Request $request, UploadService $uploadService): Response
    {
        $playExternal = new PlayExternal();
        $form = $this->createForm(PlayExternalType::class, $playExternal);
        $form->handleRequest($request);
        $photos = $playExternal->getPhotos();

        if ($form->isSubmitted() && $form->isValid()) {
          if (array_key_exists('photos', $request->files->get('play_external') )){
            $imageFiles = $request->files->get('play_external')['photos'];
          }else{
            $imageFiles = null;
          }
            $entityManager = $this->getDoctrine()->getManager();
          $imageFile = $form->get('poster')->getData();
          if ($imageFile) {
            $imageFileName = $uploadService->uploadFile(
              $imageFile,
              'uploads/image'
            );
          }

          $playExternal->setPoster($imageFileName);

          if ($imageFiles != null) {
            $imageFiles = array_values(array_values($imageFiles));
            foreach ($photos as $index => $photo) {
              $image = array_values(array_values($imageFiles)[$index])[0];

              if (!empty($image)) {
                $imageFileName = $uploadService->uploadFile(
                  $image,
                  'uploads/image'
                );
                $photo->setPhoto($imageFileName);
              }
              $photo->setPlayExternal($playExternal);
            }
          }

            $videoLinks = $form->getData()->getVideoLinks();
            foreach ($videoLinks as $item){
              $videoLink = $item->getVideoLink();
              $videoLink = $this->getVideoLinks($videoLink);
              $item->setVideoLink($videoLink);
              $entityManager->persist($item);
            }

            $entityManager->persist($playExternal);
            $entityManager->flush();

            return $this->redirectToRoute('play_external_index');
        }

        return $this->render('admin/play_external/new.html.twig', [
            'play_external' => $playExternal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="play_external_show", methods={"GET"})
     */
    public function show(PlayExternal $playExternal): Response
    {
      $photos = $playExternal->getPhotos();
      $videos = $playExternal->getVideoLinks();

        return $this->render('admin/play_external/show.html.twig', [
            'play_external' => $playExternal,
            'photos' => $photos,
            'videos' => $videos
        ]);
    }

    /**
     * @Route("/{id}/edit", name="play_external_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlayExternal $playExternal, UploadService $uploadService): Response
    {
        $form = $this->createForm(PlayExternalType::class, $playExternal);
        $form->handleRequest($request);
        $photos = $playExternal->getPhotos();
        $imageFiles = $request->files->get('play_external');
        $imageFiles = isset($imageFiles['photos']) ? $imageFiles['photos'] : null;

        if ($form->isSubmitted() && $form->isValid()) {
          $entityManager = $this->getDoctrine()->getManager();
          $imageFile = $form->get('poster')->getData();
          if ($imageFile) {
            $imageFileName = $uploadService->uploadFile(
              $imageFile,
              'uploads/image'
            );
            $playExternal->setPoster($imageFileName);
          }

          if ($imageFiles) {
            $imageFiles = array_values(array_values($imageFiles));
            foreach ($photos as $index => $photo) {
              $image = array_values(array_values($imageFiles)[$index])[0];

              if (!empty($image)) {
                $imageFileName = $uploadService->uploadFile(
                  $image,
                  'uploads/image'
                );
                $photo->setPhoto($imageFileName);
              }
              $photo->setPlayExternal($playExternal);
            }
          }

          $videoLinks = $form->getData()->getVideoLinks();
          foreach ($videoLinks as $item){
            $videoLink = $item->getVideoLink();
            $videoLink = $this->getVideoLinks($videoLink);
            $item->setVideoLink($videoLink);
            $entityManager->persist($item);
          }

          $entityManager->persist($playExternal);
          $entityManager->flush();

            return $this->redirectToRoute('play_external_index');
        }

        return $this->render('admin/play_external/edit.html.twig', [
            'play_external' => $playExternal,
            'form' => $form->createView(),
            'photos'=>$photos
        ]);
    }

    /**
     * @Route("/{id}", name="play_external_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlayExternal $playExternal, UploadService $uploadService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playExternal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($playExternal);
            $photos = $playExternal->getPhotos();
            if ($photos){
              foreach ($photos as $photo){
                $uploadService->delete($photo->getPhoto());
              }
            }
            if ($playExternal->getPoster()) {
              $uploadService->delete($playExternal->getPoster());
            }
            $entityManager->flush();
        }

        return $this->redirectToRoute('play_external_index');
    }
}
