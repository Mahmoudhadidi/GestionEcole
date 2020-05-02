<?php

namespace SeanceBundle\Controller;

use SeanceBundle\Entity\Seance;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Seance controller.
 *
 */
class SeanceController extends Controller
{
    /**
     *
     *
     */
    public function calendarAction()
    {


        return $this->render('seance/calendar.html.twig', array(


        ));
    }

    /**
     * Lists all seance entities.
     *
     */
    public function indexAction(Request $request)
    {

        $seance = new Seance();
        $form = $this->createForm('SeanceBundle\Form\SeanceType', $seance);
        $form->handleRequest($request);
        $msg="";
        if(isset($_GET['msg']))
            $msg=$_GET['msg'];



        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seance);
            $em->flush();
            $msg=  "la nouvelle seance a bien été enregistrée";//La nouvelle matière a bien été enregistrée
            return $this->redirectToRoute('seance_index',array('msg'=>$msg,));

            return $this->redirectToRoute('seance_index');
        }
        $em = $this->getDoctrine()->getManager();

        $seances = $em->getRepository('SeanceBundle:Seance')->findAll();

        if (isset($_GET['idSeance'])) {
            $msg=  " la seance a bien été supprimée";//La nouvelle matière a bien été enregistrée

            $this->getDoctrine()->getRepository('SeanceBundle:Seance')->supprimerSeance();
            return $this->redirectToRoute('seance_index',array('msg'=>$msg,));
        }
        return $this->render('seance/index.html.twig', array(
            'seances' => $seances,
            'msg'=>$msg,
            'form' => $form->createView(),

        ));
    }

    /**
     * Creates a new seance entity.
     *
     */
    public function newAction(Request $request)
    {
        $seance = new Seance();
        $form = $this->createForm('SeanceBundle\Form\SeanceType', $seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($seance);
            $em->flush();

            return $this->redirectToRoute('seance_show', array('idSeance' => $seance->getIdseance()));
        }

        return $this->render('seance/new.html.twig', array(
            'seance' => $seance,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a seance entity.
     *
     */
    public function showAction(Seance $seance)
    {
        $deleteForm = $this->createDeleteForm($seance);

        return $this->render('seance/show.html.twig', array(
            'seance' => $seance,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing seance entity.
     *
     */
    public function editAction(Request $request, Seance $seance)
    {
        $deleteForm = $this->createDeleteForm($seance);
        $editForm = $this->createForm('SeanceBundle\Form\SeanceType', $seance);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seance_edit', array('idSeance' => $seance->getIdseance()));
        }

        return $this->render('seance/edit.html.twig', array(
            'seance' => $seance,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a seance entity.
     *
     */
    public function deleteAction(Request $request, Seance $seance)
    {
        $form = $this->createDeleteForm($seance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($seance);
            $em->flush();
        }

        return $this->redirectToRoute('seance_index');
    }

    /**
     * Creates a form to delete a seance entity.
     *
     * @param Seance $seance The seance entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Seance $seance)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('seance_delete', array('idSeance' => $seance->getIdseance())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
