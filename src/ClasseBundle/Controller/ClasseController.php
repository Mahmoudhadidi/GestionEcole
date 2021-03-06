<?php

namespace ClasseBundle\Controller;

use ClasseBundle\Entity\Classe;
use ClasseBundle\Repository\ClasseRepository;
use SeanceBundle\Repository\SeanceRepository;
use UserBundle\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Util\OrderedHashMap;

/**
 * Classe controller.
 *
 */
class ClasseController extends Controller
{
    
    /**
     * Lists all classe entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $classes = $em->getRepository('ClasseBundle:Classe')->findAll();
        $etudiants=$this->getDoctrine()->getRepository('UserBundle:User')->findAffect();
      //  $nbrEtud=$this->getDoctrine()->getRepository('UserBundle:User')->findAffectclasse($classes->getNumClasse());
      //  $idClasses=$this->getDoctrine()->getRepository('ClasseBundle:Classe')->findIdClasse();
       // $nbrclasse=$this->getDoctrine()->getRepository('UserBundle:User')->findAffectclasse(1);;
        //$map = new OrderedHashMap();
        $listFanction=array();
        $verifFanction=array();

        foreach ($classes as $idC){


            $listFanction[$idC->getIdClasse()] = $this->getDoctrine()->getRepository('UserBundle:User')->findAffectclasse($idC->getIdClasse());
            $verifFanction[$idC->getIdClasse()] = $this->getDoctrine()->getRepository('SeanceBundle:Seance')->findOneByVerifClasse($idC->getIdClasse());


        }






        $classe = new Classe();
        $form = $this->createForm('ClasseBundle\Form\ClasseType', $classe);
        $form->handleRequest($request);

        $msg="";
        if(isset($_GET['msg']))
            $msg=$_GET['msg'];


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classe);
            $em->flush();
            $msg=  "la nouvelle classe ".$classe->getNumClasse()." a bien été enregistrée";//La nouvelle matière a bien été enregistrée
            return $this->redirectToRoute('classe_homepage',array('msg'=>$msg,));
        }


        if (isset($_GET['idClasse'])) {
            $msg=  " la classe ".$classe->getNumClasse()." a bien été supprimée";//La nouvelle matière a bien été enregistrée

            $this->getDoctrine()->getRepository('ClasseBundle:Classe')->supprimerClasse();
            return $this->redirectToRoute('classe_homepage',array('msg'=>$msg,));
        }

        return $this->render('classe/index.html.twig', array(
            'classes' => $classes,
            'form' => $form->createView(),
            'msg'=>$msg,
            'etudiants'=>$etudiants,
            'map'=>$listFanction,
            'verif'=>$verifFanction,


        ));
    }

    /**
     * Creates a new classe entity.
     *
     */
    public function newAction(Request $request)
    {
        $classe = new Classe();
        $form = $this->createForm('ClasseBundle\Form\ClasseType', $classe);
        $form->handleRequest($request);
        //$deleteForm = $this->createDeleteForm($classe);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($classe);
            $em->flush();

            return $this->redirectToRoute('classe_homepage');
        }


        return $this->render('classe/new.html.twig', array(
            'classe' => $classe,
            'form' => $form->createView(),

        ));
    }

    /**
     * Finds and displays a classe entity.
     *
     */
    public function showAction(Classe $classe)
    {
        $deleteForm = $this->createDeleteForm($classe);

        return $this->render('classe/show.html.twig', array(
            'classe' => $classe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing classe entity.
     *
     */
    public function editAction(Request $request, Classe $classe)
    {
        $deleteForm = $this->createDeleteForm($classe);
        $editForm = $this->createForm('ClasseBundle\Form\ClasseType', $classe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $msg=  "la classe ".$classe->getNumClasse()." a bien été modifiée";
            return $this->redirectToRoute('classe_homepage',array('msg'=>$msg,));
        }

        return $this->render('classe/edit.html.twig', array(
            'classe' => $classe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a classe entity.
     *
     */
    public function deleteAction(Request $request, Classe $classe)
    {
        $form = $this->createDeleteForm($classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($classe);
            $em->flush();
        }

        return $this->redirectToRoute('classe_index');
    }

    /**
     * Creates a form to delete a classe entity.
     *
     * @param Classe $classe The classe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Classe $classe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('classe_delete', array('idClasse' => $classe->getIdclasse())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }



    /**
     * Creates a form to delete a classe entity.
     *
     *
     */
    private function createDelete2Form(Classe $classe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('classe_index'))
            ->setMethod('POST')
            ->getForm()
            ;
    }
    public function accAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render("base.html.twig");
    }


}
