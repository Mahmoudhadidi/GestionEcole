<?php

namespace AbsenceEmployeBundle\Controller;

use AbsenceEmployeBundle\Entity\AbsenceEmploye;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Absenceemploye controller.
 *
 */
class AbsenceEmployeController extends Controller
{
    /**
     * Lists all absenceEmploye entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $absenceEmployes = $em->getRepository('AbsenceEmployeBundle:AbsenceEmploye')->findAll();

        return $this->render('absenceemploye/index.html.twig', array(
            'absenceEmployes' => $absenceEmployes,
        ));
    }

    /**
     * Creates a new absenceEmploye entity.
     *
     */
    public function newAction(Request $request)
    {
        $absenceEmploye = new Absenceemploye();
        $form = $this->createForm('AbsenceEmployeBundle\Form\AbsenceEmployeType', $absenceEmploye);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($absenceEmploye);
            $em->flush();

            return $this->redirectToRoute('absenceemploye_show', array('idAbsenceE' => $absenceEmploye->getIdabsencee()));
        }

        return $this->render('absenceemploye/new.html.twig', array(
            'absenceEmploye' => $absenceEmploye,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a absenceEmploye entity.
     *
     */
    public function showAction(AbsenceEmploye $absenceEmploye)
    {
        $deleteForm = $this->createDeleteForm($absenceEmploye);

        return $this->render('absenceemploye/show.html.twig', array(
            'absenceEmploye' => $absenceEmploye,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing absenceEmploye entity.
     *
     */
    public function editAction(Request $request, AbsenceEmploye $absenceEmploye)
    {
        $deleteForm = $this->createDeleteForm($absenceEmploye);
        $editForm = $this->createForm('AbsenceEmployeBundle\Form\AbsenceEmployeType', $absenceEmploye);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('absenceemploye_edit', array('idAbsenceE' => $absenceEmploye->getIdabsencee()));
        }

        return $this->render('absenceemploye/edit.html.twig', array(
            'absenceEmploye' => $absenceEmploye,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a absenceEmploye entity.
     *
     */
    public function deleteAction(Request $request, AbsenceEmploye $absenceEmploye)
    {
        $form = $this->createDeleteForm($absenceEmploye);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($absenceEmploye);
            $em->flush();
        }

        return $this->redirectToRoute('absenceemploye_index');
    }

    /**
     * Creates a form to delete a absenceEmploye entity.
     *
     * @param AbsenceEmploye $absenceEmploye The absenceEmploye entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AbsenceEmploye $absenceEmploye)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('absenceemploye_delete', array('idAbsenceE' => $absenceEmploye->getIdabsencee())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
