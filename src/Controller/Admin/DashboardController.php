<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\User;
use App\Entity\Picture;
use App\Entity\Testimony;
use App\Repository\PictureRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
public function __construct(private PictureRepository $pictureRepository)
{
}
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $pictures = $this->pictureRepository->findBy([], ['updatedAt' => 'DESC'], 5);


        return $this->render('admin/index.html.twig', [
            'pictures' => $pictures,
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Assistante Maternelle')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Photos', 'fa-regular fa-images', Picture::class);
        yield MenuItem::linkToCrud('Messages', 'fa-regular fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Avis clients', 'fa-solid fa-comment', Testimony::class);
        yield MenuItem::linkToCrud('Gestion du compte', 'fa-solid fa-address-card', User::class);
    }

}
