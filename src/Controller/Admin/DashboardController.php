<?php

namespace App\Controller\Admin;

use App\Entity\Activity;
use App\Entity\Contact;
use App\Entity\CookiesConfig;
use App\Entity\Experience;
use App\Entity\Footer;
use App\Entity\Formation;
use App\Entity\Header;
use App\Entity\Language;
use App\Entity\Leisure;
use App\Entity\MessageVisitor;
use App\Entity\Project;
use App\Entity\Seo;
use App\Entity\Skill;
use App\Entity\User;
use App\Entity\UserLog;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin-portfolio", name="admin")
     */
    public function index(): Response
    {
        //return parent::index();
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    // DASHBOARD CONFIG
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio | Loucif');
    }

    // MENU CONFIG
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Admin', 'fa fa-home');

        yield  MenuItem::subMenu('Header', 'fas fa-heading')->setSubItems([
            MenuItem::linkToCrud('Home', 'fa fa-home', Header::class),
            MenuItem::linkToCrud('User', 'fa fa-user', User::class)
        ]);
        yield  MenuItem::subMenu('Parcours', 'fas fa-building')->setSubItems([
            MenuItem::linkToCrud('Experience', 'fa fa-building', Experience::class),
            MenuItem::linkToCrud('Formation', 'fa fa-university', Formation::class),
            MenuItem::linkToCrud('Loisir', 'fa fa-tools', Leisure::class),
            MenuItem::linkToCrud('Projet', 'fa fa-tools', Project::class)
        ]);
        yield MenuItem::linkToCrud('Activité', 'fa fa-tools', Activity::class);
        yield  MenuItem::subMenu('Compétence', 'fas fa-building')->setSubItems([
            MenuItem::linkToCrud('Langue', 'fa fa-language', Language::class),
            MenuItem::linkToCrud('Compétence', 'fa fa-puzzle-piece', Skill::class)
        ]);
        yield  MenuItem::subMenu('Footer', 'fas fa-building')->setSubItems([
            MenuItem::linkToCrud('A propos', 'fa fa-bars', Footer::class),
            MenuItem::linkToCrud('Contat', 'fa fa-address-card', Contact::class)
        ]);
        yield MenuItem::linkToCrud('SEO', 'fa fa-globe', Seo::class);
        yield MenuItem::linkToCrud('Cookie', 'fa fa-cookie', CookiesConfig::class);
        yield MenuItem::linkToCrud('Message', 'fa fa-envelope', MessageVisitor::class);
        yield MenuItem::linkToCrud('Password', 'fa fa-lock', UserLog::class);
        yield MenuItem::linkToRoute('Public', 'fa fa-desktop', 'home');
    }
}
