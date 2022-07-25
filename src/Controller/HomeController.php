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
use App\Entity\Testimony;
use App\Form\TestimonyType;


class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PictureRepository $pictureRepository, UserRepository $userRepository, Request $request, EntityManagerInterface $entityManager): Response
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

        $testimony = new Testimony();
        $testimonyForm = $this->createForm(TestimonyType::class, $testimony);
        $testimonyForm->handleRequest($request);
        if ($testimonyForm->isSubmitted() && $testimonyForm->isValid()) {
            $entityManager->persist($testimony);
            $entityManager->flush();
            $this->addFlash('success', 'Votre commentaire a bien été envoyé');
            return $this->redirect($this->generateUrl('app_home') . '#testimony');
        }

        return $this->render('home/index.html.twig', [
            'pictures' => $pictures,
            'form' => $form->createView(),
            'testimonyForm' => $testimonyForm->createView()
        ]);
    }
}
