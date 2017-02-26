<?php

namespace AppBundle\Controller;

use AppBundle\Entity\plant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Plant controller.
 *
 * @Route("admin/plant")
 */
class plantController extends Controller
{
    /**
     * Lists all plant entities.
     *
     * @Route("/", name="admin_plant_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $plants = $em->getRepository('AppBundle:plant')->findAll();

        return $this->render('plant/index.html.twig', array(
            'plants' => $plants,
        ));
    }

    /**
     * Creates a new plant entity.
     *
     * @Route("/new", name="admin_plant_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $plant = new Plant();
        $form = $this->createForm('AppBundle\Form\plantType', $plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($plant);
            $em->flush($plant);

            return $this->redirectToRoute('admin_plant_show', array('id' => $plant->getId()));
        }

        return $this->render('plant/new.html.twig', array(
            'plant' => $plant,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a plant entity.
     *
     * @Route("/{id}", name="admin_plant_show")
     * @Method("GET")
     */
    public function showAction(plant $plant)
    {
        $deleteForm = $this->createDeleteForm($plant);

        return $this->render('plant/show.html.twig', array(
            'plant' => $plant,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing plant entity.
     *
     * @Route("/{id}/edit", name="admin_plant_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, plant $plant)
    {
        $deleteForm = $this->createDeleteForm($plant);
        $editForm = $this->createForm('AppBundle\Form\plantType', $plant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_plant_edit', array('id' => $plant->getId()));
        }

        return $this->render('plant/edit.html.twig', array(
            'plant' => $plant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a plant entity.
     *
     * @Route("/{id}", name="admin_plant_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, plant $plant)
    {
        $form = $this->createDeleteForm($plant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($plant);
            $em->flush($plant);
        }

        return $this->redirectToRoute('admin_plant_index');
    }

    /**
     * Creates a form to delete a plant entity.
     *
     * @param plant $plant The plant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(plant $plant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_plant_delete', array('id' => $plant->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
