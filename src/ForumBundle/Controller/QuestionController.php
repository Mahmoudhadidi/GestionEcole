<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\FosUser;
use ForumBundle\Entity\Question;
use ForumBundle\Entity\Reponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Question controller.
 *
 */
class QuestionController extends Controller
{
    /**
     * Lists all question entities.
     *
     */
    public function indexAction(Request $request)
    {
        if(isset($_GET['idQues']))
            $this->getDoctrine()->getRepository('ForumBundle:Question')->supprimerQuestion();
       if(isset($_GET['idReponse']))
           $this->getDoctrine()->getRepository('ForumBundle:Reponse')->supprimerReponse();


        if(isset($_POST['submit'])){
            extract($_POST);

            $reponse=$_POST['reponse'];
            $idQ=$_POST['idQ'];
            $date="21/04/2020";


                    $this->getDoctrine()->getRepository('ForumBundle:Reponse')->findByReponse($reponse,$date,$idQ );


               }


        $em = $this->getDoctrine()->getManager();

        $questions = $em->getRepository('ForumBundle:Question')->findAll();
        $listFanction=array();
        foreach ($questions as $q){
            $listFanction[$q->getIdQues()] = $this->getDoctrine()->getRepository('ForumBundle:Reponse')->findreponse($q->getIdQues());


        }
        $question = new Question();
        $form = $this->createForm('ForumBundle\Form\QuestionType', $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fosuser=new FosUser();//setId
            $question->setDate("CURRENT_DATE()");
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('question_index');
        }

        return $this->render('question/index.html.twig', array(
            'questions' => $questions,
            'form' => $form->createView(),
            'map'=>$listFanction,

        ));
    }

    /**
     * Creates a new question entity.
     *
     */
    public function newAction(Request $request)
    {
        $question = new Question();
        $form = $this->createForm('ForumBundle\Form\QuestionType', $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute('question_show', array('idQues' => $question->getIdques()));
        }

        return $this->render('question/new.html.twig', array(
            'question' => $question,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a question entity.
     *
     */
    public function showAction(Question $question)
    {
        $deleteForm = $this->createDeleteForm($question);

        return $this->render('question/show.html.twig', array(
            'question' => $question,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing question entity.
     *
     */
    public function editAction(Request $request, Question $question)
    {
        $deleteForm = $this->createDeleteForm($question);
        $editForm = $this->createForm('ForumBundle\Form\QuestionType', $question);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('question_index', array('idQues' => $question->getIdques()));
        }

        return $this->render('question/edit.html.twig', array(
            'question' => $question,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a question entity.
     *
     */
    public function deleteAction(Request $request, Question $question)
    {
        $form = $this->createDeleteForm($question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($question);
            $em->flush();
        }

        return $this->redirectToRoute('question_index');
    }

    /**
     * Creates a form to delete a question entity.
     *
     * @param Question $question The question entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Question $question)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('question_delete', array('idQues' => $question->getIdques())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
