<?php

namespace App\Controller\Admin;
use App\Entity\Projet;
use App\Entity\Categorie;
use App\Entity\Image;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LCR V3');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Revenir sur le site', 'fas fa-undo', 'app_home');

        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Toutes les categories', 'fas fa-newspaper', Categorie::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Categorie::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Catégories', 'fas fa-list', Category::class)
        ]);

        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Tous les projets', 'fas fa-newspaper', Projet::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Projet::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Projets', 'fas fa-list', Projet::class)
        ]);

        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Toutes les images', 'fas fa-newspaper', Image::class),
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Image::class)->setAction(Crud::PAGE_NEW),
        ]);
    }
}
