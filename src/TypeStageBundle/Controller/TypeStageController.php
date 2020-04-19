<?php

namespace TypeStageBundle\Controller;

use TypeStageBundle\Entity\TypeStage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Typestage controller.
 *
 */
class TypeStageController extends Controller
{
    /**
     * Lists all typeStage entities.
     *
     */
    public function indexAction(Request $request)
    {
        $typeStage = new Typestage();
        $form = $this->createForm('TypeStageBundle\Form\TypeStageType', $typeStage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeStage);
            $em->flush();

            return $this->redirectToRoute('typestage_index');
        }
        $em = $this->getDoctrine()->getManager();

        if (isset($_GET['id'])) {
            $this->getDoctrine()->getRepository('TypeStageBundle:TypeStage')->supprimerTypeStage();
            return $this->redirectToRoute('typestage_index');
        }
        $typeStages = $em->getRepository('TypeStageBundle:TypeStage')->findAll();

        return $this->render('typestage/index.html.twig', array(
            'typeStages' => $typeStages,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new typeStage entity.
     *
     */
    public function newAction(Request $request)
    {
        $typeStage = new Typestage();
        $form = $this->createForm('TypeStageBundle\Form\TypeStageType', $typeStage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeStage);
            $em->flush();

            return $this->redirectToRoute('typestage_show', array('id' => $typeStage->getId()));
        }

        return $this->render('typestage/new.html.twig', array(
            'typeStage' => $typeStage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeStage entity.
     *
     */
    public function showAction(TypeStage $typeStage)
    {
        $deleteForm = $this->createDeleteForm($typeStage);

        return $this->render('typestage/show.html.twig', array(
            'typeStage' => $typeStage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeStage entity.
     *
     */
    public function editAction(Request $request, TypeStage $typeStage)
    {
        $deleteForm = $this->createDeleteForm($typeStage);
        $editForm = $this->createForm('TypeStageBundle\Form\TypeStageType', $typeStage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typestage_edit', array('id' => $typeStage->getId()));
        }

        return $this->render('typestage/edit.html.twig', array(
            'typeStage' => $typeStage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a typeStage entity.
     *
     */
    public function deleteAction(Request $request, TypeStage $typeStage)
    {
        $form = $this->createDeleteForm($typeStage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeStage);
            $em->flush();
        }

        return $this->redirectToRoute('typestage_index');
    }

    /**
     * Creates a form to delete a typeStage entity.
     *
     * @param TypeStage $typeStage The typeStage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TypeStage $typeStage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('typestage_delete', array('id' => $typeStage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
