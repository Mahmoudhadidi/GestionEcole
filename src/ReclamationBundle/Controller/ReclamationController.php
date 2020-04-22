<?php

namespace ReclamationBundle\Controller;

use ReclamationBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use UseruserBundle\Entity\User;

/**
 * Reclamation controller.
 *
 */
class ReclamationController extends Controller
{
    /**
     * Lists all reclamation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('ReclamationBundle:Reclamation')->findAll();

        return $this->render('reclamation/index.html.twig', array(
            'reclamations' => $reclamations,
        ));
        $user = $this->getUsername();

        $username=$user->getUsername();
        return $this->render('reclamation/index.html.twig',array('reclamations'=> $username));

    }

    public function  consulteAction(Request $request)
    {
        $id=1;
        $reclamations = $this->getDoctrine()->getRepository('ReclamationBundle:Reclamation')->UserReclamation($id);
        $countReclamation = $this->getDoctrine()->getRepository('ReclamationBundle:Reclamation')->countReclamation($id);

        $reclamation = new Reclamation();
        $form = $this->createForm('ReclamationBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reclamation->setIdUser(1);
            $reclamation->setEtat("non traité");
            $reclamation->setDateEnv(000000);
            $reclamation->setDateRep(000000);
            $reclamation->setReponse("");

            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute('reclamation_consulte');
        }



        return $this->render('reclamation/consulte.html.twig', array(
            'reclamations' => $reclamations,
            'countReclamation'=>$countReclamation,
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ));


    }

    /**
     * Creates a new reclamation entity.
     *
     */
    public function newAction(Request $request)
    {
        $reclamation = new Reclamation();
        $form = $this->createForm('ReclamationBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute('reclamation_show', array('id' => $reclamation->getId()));
        }

        return $this->render('reclamation/new.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reclamation entity.
     *
     */
    public function showAction(Request $request, $id,Reclamation $reclamation)
    {
        $am=$this->getDoctrine()->getRepository(reclamation::class)->findBy(array('id'=>$id));

        $reclamation=$this->getDoctrine()->getRepository(reclamation::class)->find($id);


        $form = $this->createFormBuilder()
            ->add('reponse', TextareaType::class)->add('repondre', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $reclamation->setReponse($form->get('reponse')->getData());
            $reclamation->setEtat("traitée");
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute('reclamation_show', array('id' => $reclamation->getId()));
        }


        $deleteForm = $this->createDeleteForm($reclamation);

        return $this->render('reclamation/show.html.twig', array(
            'reclamation' => $reclamation,
            'delete_form' => $deleteForm->createView(),
            'form'=>$form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reclamation entity.
     *
     */
    public function editAction(Request $request, Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);
        $editForm = $this->createForm('ReclamationBundle\Form\ReclamationType', $reclamation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_edit', array('id' => $reclamation->getId()));
        }

        return $this->render('reclamation/edit.html.twig', array(
            'reclamation' => $reclamation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reclamation entity.
     *
     */
    public function deleteAction(Request $request, Reclamation $reclamation)
    {
        $form = $this->createDeleteForm($reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reclamation);
            $em->flush();
        }

        return $this->redirectToRoute('reclamation_index');
    }
    public function  repondreAction(Request $request, $id)
    {
        //$em=$this->getDoctrine()->getManager();
        $reclamation=$this->getDoctrine()->getRepository(reclamation::class)->findBy(array('id'=>$id));

        $reclamation=$this->getDoctrine()->getRepository(reclamation::class)->find($id);


        $form = $this->createFormBuilder()
            ->add('reponse', TextareaType::class)->add('repondre', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {

            $reclamation->setReponse($form->get('reponse')->getData());
            $reclamation->setEtat("traitée");
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();


            return $this->redirectToRoute('reclamation_show', array('id' => $reclamation->getId()));
        }
        return $this->render('reclamation\repondre.html.twig',array('form'=>$form->createView()));

    }
    public function getRealEntities($reclamations){

    foreach ($reclamations as $reclamation){
        //$realEntities[$reclamation->getId()] = $reclamation->getDescription();
        //$user=$this->getDoctrine()->getRepository(user::class)->findBy(array('id'=>$reclamation->getUser()));

        $user = $this->getDoctrine()->getManager()->find('FOSBundle:user', $reclamation->getUser());
        if($reclamation->getEtat()==1)
        {
            $Etat="Traite";
            $bouton="Voir";
        }
        else
        {
            $Etat="En cours";
            $bouton="Repondre";
        }
        $realEntities[$reclamation->getId()] = [$user->getUsername(),$reclamation->getEtat(), $reclamation->getDateEnv(),$Etat,$bouton];
    }

    return $realEntities;
}

    /**
     * Creates a form to delete a reclamation entity.
     *
     * @param Reclamation $reclamation The reclamation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reclamation $reclamation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reclamation_delete', array('id' => $reclamation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
