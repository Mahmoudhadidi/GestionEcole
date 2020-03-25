<?php

namespace SalleBundle\Controller;

use SalleBundle\Entity\Salle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Salle controller.
 *
 */
class SalleController extends Controller
{
    /**
     * Lists all salle entities.
     *
     */
    public function indexAction(Request $request)
    {
        $salle = new Salle();
        $form = $this->createForm('SalleBundle\Form\SalleType', $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salle);
            $em->flush();

            return $this->redirectToRoute('salle_index');
        }

        $em = $this->getDoctrine()->getManager();

        $salles = $em->getRepository('SalleBundle:Salle')->findAll();
        if (isset($_GET['idSalle'])) {
            $this->getDoctrine()->getRepository('SalleBundle:Salle')->supprimerSalle();
            return $this->redirectToRoute('salle_index');
        }

        return $this->render('salle/index.html.twig', array(
            'salles' => $salles,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new salle entity.
     *
     */
    public function newAction(Request $request)
    {
        $salle = new Salle();
        $form = $this->createForm('SalleBundle\Form\SalleType', $salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($salle);
            $em->flush();

            return $this->redirectToRoute('salle_index');
        }

        return $this->render('salle/new.html.twig', array(
            'salle' => $salle,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a salle entity.
     *
     */
    public function showAction(Salle $salle)
    {
        $deleteForm = $this->createDeleteForm($salle);

        return $this->render('salle/show.html.twig', array(
            'salle' => $salle,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing salle entity.
     *
     */
    public function editAction(Request $request, Salle $salle)
    {
        $deleteForm = $this->createDeleteForm($salle);
        $editForm = $this->createForm('SalleBundle\Form\SalleType', $salle);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('salle_index');
        }

        return $this->render('salle/edit.html.twig', array(
            'salle' => $salle,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a salle entity.
     *
     */
    public function deleteAction(Request $request, Salle $salle)
    {
        $form = $this->createDeleteForm($salle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($salle);
            $em->flush();
        }

        return $this->redirectToRoute('salle_index');
    }

    /**
     * Creates a form to delete a salle entity.
     *
     * @param Salle $salle The salle entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Salle $salle)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('salle_delete', array('idSalle' => $salle->getIdsalle())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
