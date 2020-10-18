<?php

namespace App\Controller\Service;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UploadService extends AbstractController
{
  private $publicDir;

  public function __construct(KernelInterface $kernel)
  {
    $this->publicDir = $kernel->getProjectDir() . '/public';
  }

  public function uploadFile(UploadedFile $file, $dir)
  {
    $fileName = uniqid() . '-' . time();
    $extension = $file->guessExtension();

    $newFilename = $fileName . '.' . $extension;
    $newFile = $file->move($this->publicDir . '/' . $dir, $newFilename);
    $filePath = $dir . '/' . $newFilename;

    return $filePath;
  }

  public function delete($filePath)
  {
    $filePath = $this->publicDir.'/'.$filePath;

    // Delete original file
    if (file_exists($filePath)) {
      $fileSystem = new Filesystem();
      $fileSystem->remove($filePath);
    }
  }

}