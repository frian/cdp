<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $plants = $em->getRepository('AppBundle:Plant')->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [

        ]);
    }

    /**
     * @Route("/calendar", name="calendar")
     */
    public function calendarAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $plants = $em->getRepository('AppBundle:Plant')->findAll();

        // replace this example code with whatever you need
        return $this->render('default/calendar.html.twig', [

        ]);
    }


    /**
     * @Route("/loadplants", name="load_plants")
     */
     public function loadAction(Request $request)
     {
         $em = $this->getDoctrine()->getManager();

         $plants = $em->getRepository('AppBundle:Plant')->findAll();

         $serializer = $this->get('jms_serializer');

         $response = $serializer->serialize($plants,'json');

         return new Response($response);
     }
}
