<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PictureRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(UserRepository $userRepository, PictureRepository $pictureRepository): Response
    {
        // If no user exists, redirect to first user creation page
        if(count($userRepository->findAll()) === 0) {
            return $this->redirectToRoute('app_first_user');
        }
        $pictures = $pictureRepository->findBy([
            'isPublished' => true
        ]);

        return $this->render('home/index.html.twig', [
            'pictures' => $pictures,
        ]);
    }
}
