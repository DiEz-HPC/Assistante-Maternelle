<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PictureRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PictureRepository $pictureRepository, UserRepository $userRepository): Response
    {
        // If no user exists, redirect to first user creation page
        if(count($userRepository->findAll()) === 0) {
            return $this->redirectToRoute('app_first_user');
        }
        $pictures = $pictureRepository->findBy([
            'isPublished' => true
        ]);

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        return $this->render('home/index.html.twig', [
            'pictures' => $pictures,
            'form' => $form->createView(),
        ]);
    }
}
