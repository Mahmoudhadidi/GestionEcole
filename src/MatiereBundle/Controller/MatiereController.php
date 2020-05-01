<?php

namespace MatiereBundle\Controller;

use MatiereBundle\Entity\Matiere;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Matiere controller.
 *
 */
class MatiereController extends Controller
{
    /**
     * Lists all matiere entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $msg="";
        if(isset($_GET['msg']))
            $msg=$_GET['msg'];
        $matieres = $em->getRepository('MatiereBundle:Matiere')->findAll();
        $matiere = new Matiere();
        $form = $this->createForm('MatiereBundle\Form\MatiereType', $matiere);
        $form->handleRequest($request);

        $verifFanction=array();
        foreach ($matieres as $idM){
            $verifFanction[$idM->getIdMatiere()] = $this->getDoctrine()->getRepository('SeanceBundle:Seance')->findOneByVerifClasse($idM->getIdMatiere());
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();
            $msg=  "la nouvelle matière ".$matiere->getNomMatier()." a bien été enregistrée";//La nouvelle matière a bien été enregistrée
            return $this->redirectToRoute('matiere_index',array('msg'=>$msg,));

        }
        if (isset($_GET['idMatiere'])) {
            $msg=  "la matière ".$matiere->getNomMatier()." a bien été supprimée";//La nouvelle matière a bien été enregistrée

            $this->getDoctrine()->getRepository('MatiereBundle:Matiere')->supprimerMatiere();
            return $this->redirectToRoute('matiere_index',array('msg'=>$msg,));
        }

        return $this->render('matiere/index.html.twig', array(
            'matieres' => $matieres,
            'form' => $form->createView(),
            'msg'=>$msg,
            'verif'=>$verifFanction,
        ));
    }


/**
     * Creates a new matiere entity.
     *
     */
    public function newAction(Request $request)
    {
        $matiere = new Matiere();
        $form = $this->createForm('MatiereBundle\Form\MatiereType', $matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($matiere);
            $em->flush();

            return $this->redirectToRoute('matiere_show', array('idMatiere' => $matiere->getIdmatiere()));
        }

        return $this->render('matiere/new.html.twig', array(
            'matiere' => $matiere,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a matiere entity.
     *
     */
    public function showAction(Matiere $matiere)
    {
        $deleteForm = $this->createDeleteForm($matiere);

        return $this->render('matiere/show.html.twig', array(
            'matiere' => $matiere,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing matiere entity.
     *
     */
    public function editAction(Request $request, Matiere $matiere)
    {
        $deleteForm = $this->createDeleteForm($matiere);
        $editForm = $this->createForm('MatiereBundle\Form\MatiereType', $matiere);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $msg=  "la matière ".$matiere->getNomMatier()." a bien été modifée";//La nouvelle matière a bien été enregistrée

            return $this->redirectToRoute('matiere_index',array('msg'=>$msg,));
        }

        return $this->render('matiere/edit.html.twig', array(
            'matiere' => $matiere,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a matiere entity.
     *
     */
    public function deleteAction(Request $request, Matiere $matiere)
    {
        $form = $this->createDeleteForm($matiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($matiere);
            $em->flush();
        }

        return $this->redirectToRoute('matiere_index');
    }

    /**
     * Creates a form to delete a matiere entity.
     *
     * @param Matiere $matiere The matiere entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Matiere $matiere)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('matiere_delete', array('idMatiere' => $matiere->getIdmatiere())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    
}
