<?php

namespace App\Controller\Upload;

use App\Entity\Image;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploadImageController extends AbstractController
{
    /**
     * @param Request $request
     * @param SluggerInterface $slugger
     * @return JsonResponse
     */
    #[Route('/api/image/upload', name: 'image.upload')]
    public function index(Request $request, SluggerInterface $slugger, ManagerRegistry $manager): JsonResponse
    {
        /**
         * @var UploadedFile $brochureFile
         */
        $brochureFile = $request->files->get('file');

        $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
        // this is needed to safely include the file name as part of the URL
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

        // Move the file to the directory where brochures are stored
        try {
            $uploadedFile = $brochureFile->move(
                'uploads',
                $newFilename
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        $params = getimagesize($uploadedFile);

        return new JsonResponse([
            'name' => $uploadedFile->getBasename(),
            'fileName' => $uploadedFile->getBasename(),
            'path' => $uploadedFile->getPathname(),
            'width' => $params[0],
            'height' => $params[1],
            'type' => $params['mime'],
            'size' => $uploadedFile->getSize(),
        ]);
    }
}