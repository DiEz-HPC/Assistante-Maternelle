<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PictureRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PictureRepository $pictureRepository): Response
    {
        $pictures = $pictureRepository->findBy([
            'isPublished' => true
        ]);

        return $this->render('home/index.html.twig', [
            'pictures' => $pictures,
        ]);
    }

  
}
