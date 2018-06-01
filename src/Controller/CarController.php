<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/car")
 * @Security("has_role('ROLE_USER')")
 */
class CarController extends Controller
{
    /**
     * @Route("/", name="car_index", methods="GET")
     */
    public function index(): Response
    {
        $cars = $this->getDoctrine()
            ->getRepository(Car::class)
            ->findAll();

        return $this->render('car/index.html.twig', ['cars' => $cars]);
    }

    /**
     * @Route("/new", name="car_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();
        $car = new Car($user);

        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($car);
            $em->flush();

            return $this->redirectToRoute('car_index');
        }

        return $this->render('car/new.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="car_show", methods="GET")
     */
    public function show(Car $car): Response
    {
        return $this->render('car/show.html.twig', ['car' => $car]);
    }

    /**
     * @Route("/{id}/edit", name="car_edit", methods="GET|POST")
     */
    public function edit(Request $request, Car $car): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('car_edit', ['id' => $car->getId()]);
        }

        return $this->render('car/edit.html.twig', [
            'car' => $car,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="car_delete", methods="DELETE")
     */
    public function delete(Request $request, Car $car): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($car);
            $em->flush();
        }

        return $this->redirectToRoute('car_index');
    }
}
