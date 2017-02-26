<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Soil;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Soil controller.
 *
 * @Route("admin/soil")
 */
class SoilController extends Controller
{
    /**
     * Lists all soil entities.
     *
     * @Route("/", name="admin_soil_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $soils = $em->getRepository('AppBundle:Soil')->findAll();

        return $this->render('soil/index.html.twig', array(
            'soils' => $soils,
        ));
    }

    /**
     * Creates a new soil entity.
     *
     * @Route("/new", name="admin_soil_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $soil = new Soil();
        $form = $this->createForm('AppBundle\Form\SoilType', $soil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($soil);
            $em->flush($soil);

            return $this->redirectToRoute('admin_soil_show', array('id' => $soil->getId()));
        }

        return $this->render('soil/new.html.twig', array(
            'soil' => $soil,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a soil entity.
     *
     * @Route("/{id}", name="admin_soil_show")
     * @Method("GET")
     */
    public function showAction(Soil $soil)
    {
        $deleteForm = $this->createDeleteForm($soil);

        return $this->render('soil/show.html.twig', array(
            'soil' => $soil,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing soil entity.
     *
     * @Route("/{id}/edit", name="admin_soil_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Soil $soil)
    {
        $deleteForm = $this->createDeleteForm($soil);
        $editForm = $this->createForm('AppBundle\Form\SoilType', $soil);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_soil_edit', array('id' => $soil->getId()));
        }

        return $this->render('soil/edit.html.twig', array(
            'soil' => $soil,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a soil entity.
     *
     * @Route("/{id}", name="admin_soil_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Soil $soil)
    {
        $form = $this->createDeleteForm($soil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($soil);
            $em->flush($soil);
        }

        return $this->redirectToRoute('admin_soil_index');
    }

    /**
     * Creates a form to delete a soil entity.
     *
     * @param Soil $soil The soil entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Soil $soil)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_soil_delete', array('id' => $soil->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
