<?php

namespace App\Controller;

use App\Domain\Journey\JourneyStepHelper;
use App\Entity\Journey;
use App\Form\JourneyType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class JourneyController
 * @Route("/journey")
 */
class JourneyController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * JourneyController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param Request $request
     * @param EntityManager $entityManager
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route("/create", name="journey_create")
     */
    public function create(Request $request, JourneyStepHelper $journeyStepHelper)
    {
        $journey = new Journey();
        $journeyForm = $this->createForm(JourneyType::class, $journey, [
            'currentUser' => $this->getUser(),
        ])->add('submit', SubmitType::class);

        $journeyForm->handleRequest($request);

        if ($journeyForm->isSubmitted() && $journeyForm->isValid()) {
            $journey->setConductor($this->getUser());
            $journeyStepHelper->setStep($journey);
            $this->entityManager->persist($journey);
            $this->entityManager->flush();

            $this->addFlash('success','new journey was added');
            return $this->redirectToRoute('homepage');
        }

        return $this->render('journey/create.html.twig', [
            'form' => $journeyForm->createView(),
        ]);
    }
}