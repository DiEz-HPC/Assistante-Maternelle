<?php

namespace App\Controller;

use App\Form\RegistrationType;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FirstUserController extends AbstractController
{
    #[Route('/first/user', name: 'app_first_user')]
    public function index(Request $request, EntityManagerInterface $em, UserRepository $userRepository,  UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        // If no user exists, create an admin user
        if (count($userRepository->findAll()) === 0) {
            $user = new User();
            $form = $this->createForm(RegistrationType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $user->setRoles(['ROLE_ADMIN']);
                $password = $userPasswordHasherInterface->hashPassword($user, $user->getPassword());
                $user->setPassword($password);
                $em->persist($user);
                $em->flush();
                return $this->redirectToRoute('app_home');
            }
            return $this->render(
                'first_user/index.html.twig',
                array('form' => $form->createView())
            );
        }


        return $this->redirectToRoute('app_home'); 
    }
}
