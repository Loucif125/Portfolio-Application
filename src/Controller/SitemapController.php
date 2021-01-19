<?php

namespace App\Controller;

use App\Repository\ActivityRepository;
use App\Repository\ContactRepository;
use App\Repository\ExperienceRepository;
use App\Repository\FooterRepository;
use App\Repository\FormationRepository;
use App\Repository\HeaderRepository;
use App\Repository\LeisureRepository;
use App\Repository\SeoRepository;
use App\Repository\SkillRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    private $userRepository;
    private $contactRepository;
    private $headerRepository;
    private $footerRepository;
    private $activityRepository;
    private $skillRepository;
    private $entityManager;
    private $experienceRepository;
    private $formationRepository;
    private $leisureRepository;
    private $seoRepository;

    public function __construct(UserRepository $userRepository,
                                ContactRepository $contactRepository,
                                HeaderRepository $headerRepository,
                                FooterRepository $footerRepository,
                                ActivityRepository $activityRepository,
                                SkillRepository $skillRepository,
                                EntityManagerInterface $entityManager,
                                ExperienceRepository $experienceRepository,
                                FormationRepository $formationRepository,
                                LeisureRepository $leisureRepository,
                                SeoRepository $seoRepository)
    {
        $this->userRepository = $userRepository;
        $this->contactRepository = $contactRepository;
        $this->headerRepository = $headerRepository;
        $this->footerRepository = $footerRepository;
        $this->activityRepository = $activityRepository;
        $this->skillRepository = $skillRepository;
        $this->entityManager = $entityManager;
        $this->experienceRepository = $experienceRepository;
        $this->formationRepository = $formationRepository;
        $this->leisureRepository = $leisureRepository;
        $this->seoRepository = $seoRepository;
    }

    /**
     * @Route("/sitemap.xml", name="sitemap", defaults={"_format"="xml"})
     */
    public function index()
    {
        $users = $this->userRepository->findAll();
        $contacts = $this->contactRepository->findAll();
        $activities = $this->activityRepository->findAll();
        $headers = $this->headerRepository->findAll();
        $footers = $this->footerRepository->findAll();
        $skills = $this->skillRepository->findAll();
        $experiences = $this->experienceRepository->findAll();
        $formations = $this->formationRepository->findAll();
        $leisure = $this->leisureRepository->findAll();
        $seo = $this->seoRepository->findAll();

        return $this->render('sitemap/index.html.twig', [
            'users' => $users,
            'contacts' => $contacts,
            'activities' => $activities,
            'experiences' => $experiences,
            'formations' => $formations,
            'leisure' => $leisure,
            'headers' => $headers,
            'footers' => $footers,
            'skills' => $skills,
            'seo' => $seo,
        ]);
    }
}
