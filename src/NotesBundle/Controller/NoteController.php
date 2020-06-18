<?php

namespace NotesBundle\Controller;


use Cassandra\Float_;
use Knp\Bundle\PaginatorBundle\KnpPaginatorBundle;
use Mukadi\Chart\Builder;
use Mukadi\Chart\Chart;
use Mukadi\Chart\Utils\RandomColorFactory;
use NotesBundle\Entity\Note;
use AppBundle\Entity\User;
use PDO;
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
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $notes = $em->getRepository('NotesBundle:Note')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
          $notes,
          $request->query->getInt('page',1),
          $request->query->getInt('limit', 3)


        );



        return $this->render('note/index.html.twig', array(
            'result' => $result,
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
          #  $matiere1 = strval($matiere);


         #   var_dump($cc1);
          #  var_dump($ds1);
           # var_dump($examen1);
            #var_dump($matiere1);


      #notre requette sql
            $em = $this->getDoctrine()->getManager();

            $RAW_QUERY = "UPDATE `Note`
                          SET `moyenne`= (moyenne * 0) + (note_cc * $cc1) + (note_ds * $ds1) + (note_examun * $examen1)";

                     #    WHERE nom_matier='\"$matiere1\"' " ;


            $statement = $em->getConnection()->prepare($RAW_QUERY);
            $statement->execute();



        # return  $result = $statement->fetchAll();


          #  return $this->render('note/admin.html.twig');
          return $this->redirectToRoute('note_admin');

    }

    }
    public function adminAction()
    {
        return $this->render('note/admin.html.twig');
    }

    public function initialiserAction(){

        if (isset($_POST['choko'])){
            $em = $this->getDoctrine()->getManager();

            $RAW_QUERY = "UPDATE `Note`
                          SET `moyenne`= (moyenne * 0)";

            $statement = $em->getConnection()->prepare($RAW_QUERY);
            $statement->execute();

            return $this->redirectToRoute('note_admin');

        }


    }


    public function chartAction() {
        $connection = new PDO('mysql:dbname=esprit;host=127.0.0.1','root','');
        $builder = new Builder($connection);
        $builder

            ->query("SELECT COUNT(*) total, (nom_matier) nom_matier, nom_matier FROM matiere GROUP BY nom_matier")
           


            ->addDataset('total','Total',[
                "backgroundColor" => RandomColorFactory::getRandomRGBAColors(20)])
            ->labels('nom_matier')
        ;


        $chart = $builder->buildChart('chart',Chart::PIE);


        return $this->render('@Notes/chart.html.twig',[
            "chart" => $chart,
        ]);

    }
    public function searchAction(){
        if(isset($_POST['ok'])){
            $motif = $_POST['rechercher'];
            $em = $this->getDoctrine()->getManager();

            $RAW_QUERY = "SELECT * FROM `note` WHERE note_examun=$motif";

            $statement = $em->getConnection()->prepare($RAW_QUERY);
            $statement->execute();
          #  return $this->redirectToRoute('note_index', array(
           #     'result1' => $statement
            #));

        }

    }
}
