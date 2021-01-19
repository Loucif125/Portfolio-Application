<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Entity\MessageVisitor;
use App\Repository\ActivityRepository;
use App\Repository\ContactRepository;
use App\Repository\CookiesConfigRepository;
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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
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
    private $mailer;

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
                                SeoRepository $seoRepository,
                                CookiesConfigRepository $cookiesConfigRepository,
                                \Swift_Mailer $mailer
    )
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
        $this->cookiesConfigRepository = $cookiesConfigRepository;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
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

        $messageVisitor = new MessageVisitor();
        $form = $this->createFormBuilder($messageVisitor)
            ->setAction($this->generateUrl('post_form'))
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->getForm();
        $form->handleRequest($request);

        // Cookies configuration
        $cookiesConfig = false;
        $cookiesContent = $this->cookiesConfigRepository->findAll();

        if(!$request->cookies->get('LK_COOKIES_CONFIG')){
            $cookiesConfig = true;

            $cookie = new Cookie(
                'LK_COOKIES_CONFIG',
                true,
                time() + (60 * 60)
            );
            $res = new Response();
            $res->headers->setCookie($cookie);
            $res->send();
        }

        return $this->render('home/index.html.twig', [
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
            'cookiesConfig' => $cookiesConfig,
            'cookiesContent' => $cookiesContent,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/post", name="post_form")
     */
    public function post(Request $request){

        $messageVisitor = new MessageVisitor();
        $form = $this->createFormBuilder($messageVisitor)
            ->setAction($this->generateUrl('post_form'))
            ->add('email', EmailType::class)
            ->add('message', TextareaType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $messageVisitor->setCreatedAt(new \DateTime());
            $this->entityManager->persist($messageVisitor);
            $this->entityManager->flush();
            $this->addFlash(
                'success',
                'Votre message bien reçu !'
            );
            //Mailer
            $message = (new \Swift_Message())
                ->setFrom($form->get('email')->getData())
                ->setTo("loucif.khabache@gmail.com")
                ->setSubject("Message Portfolio")
                ->setBody(
                    $this->render("mailer/mailer.html.twig", [
                        'from' => $form->get('email')->getData(),
                        'message' => $form->get('message')->getData()
                    ]),
                    "text/html"
                );
            $this->mailer->send($message);
            //End Mailer
        }
        return $this->redirectToRoute('home');
    }
}
