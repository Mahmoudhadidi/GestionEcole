<?php

namespace NotesBundle\Controller;


use Cassandra\Float_;
use NotesBundle\Entity\Note;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Note controller.
 *
 */
class NoteController extends Controller
{
    /**
     * Lists all note entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $notes = $em->getRepository('NotesBundle:Note')->findAll();

        return $this->render('note/index.html.twig', array(
            'notes' => $notes,
        ));
    }

    /**
     * Creates a new note entity.
     *
     */
    public function newAction(Request $request)
    {
        $note = new Note();
        $form = $this->createForm('NotesBundle\Form\NoteType', $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();

            return $this->redirectToRoute('note_show', array('idNote' => $note->getIdnote()));
        }

        return $this->render('note/new.html.twig', array(
            'note' => $note,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a note entity.
     *
     */
    public function showAction(Note $note)
    {
        $deleteForm = $this->createDeleteForm($note);

        return $this->render('note/show.html.twig', array(
            'note' => $note,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing note entity.
     *
     */
    public function editAction(Request $request, Note $note)
    {
        $deleteForm = $this->createDeleteForm($note);
        $editForm = $this->createForm('NotesBundle\Form\NoteType', $note);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('note_edit', array('idNote' => $note->getIdnote()));
        }

        return $this->render('note/edit.html.twig', array(
            'note' => $note,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a note entity.
     *
     */
    public function deleteAction(Request $request, Note $note)
    {
        $form = $this->createDeleteForm($note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($note);
            $em->flush();
        }

        return $this->redirectToRoute('note_index');
    }

    /**
     * Creates a form to delete a note entity.
     *
     * @param Note $note The note entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Note $note)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('note_delete', array('idNote' => $note->getIdnote())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function RelvéeNoteAction()
    {




        $em = $this->getDoctrine()->getManager();


        $x =  $this->getUser()->getId();
        $y =intval($x);

        var_dump($y);
        #pour afficher le nom
        $nom = $this->getUser()->getUsername();
        #pour afficher le le prenom
        $add = $this->getUser()->getEmail();




        $RAW_QUERY = "SELECT note_cc, note_ds, note_examun, moyenne, nom_matier 
                      FROM  user, note
                      where user.id=note.cin and note.cin = $y" ;


        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll();


        return $this->render('note/ReleveeNotes.html.twig',array('result'=>$result, 'nom'=>$nom, 'email'=>$add));
    }

    #calculer les moyenne de la matiere
    public function  calculeMoyenneMatiereAction(){
        if(isset($_POST['submit'])) {
            $cc = $_POST['cc'];
            $ds = $_POST['ds'];
            $examen = $_POST['examen'];
            $matiere = $_POST['matiere'];


            $cc1 = floatval($cc);
            $ds1 = floatval($ds);
            $examen1 = floatval($examen);
            $matiere1 = strval($matiere);


            var_dump($cc1);
            var_dump($ds1);
            var_dump($examen1);
            var_dump($matiere1);


      #notre requette sql
            $em = $this->getDoctrine()->getManager();

            $RAW_QUERY = "UPDATE `Note`
                          SET `moyenne`= (moyenne * 0) + (note_cc * $cc1) + (note_ds * $ds1) + (note_examun * $examen1)";

                    #      WHERE nom_matier='\"$matiere1\"' " ;


            $statement = $em->getConnection()->prepare($RAW_QUERY);
            $statement->execute();


        # return  $result = $statement->fetchAll();



            return $this->redirectToRoute('note_admin');

    }

    }
    public function adminAction()
    {
        return $this->render('note/admin.html.twig');
    }
}
