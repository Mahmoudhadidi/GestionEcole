<?php

namespace NotesBundle\Controller;

use MatiereBundle\Entity\Matiere;
use NotesBundle\Entity\Note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;

class StatController extends Controller
{
    public function StatAction()
    {

        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('Browser market shares at a specific website in 2010');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));

        $em = $this->getDoctrine()->getEntityManager();
        $query = $em->createQuery('SELECT p.nomMatier as Matiere, max(p.noteExamun) as NoteExamen FROM NotesBundle:Note p GROUP by p.nomMatier');

        $resultat = $query->getResult();
        var_dump($resultat);

        $data = array();
        foreach ($resultat as $values)
        {
            $a= array($values['Matiere'],$values['NoteExamen']);
            array_push($data, $a);
        }



        $ob->series(array(array('type' => 'pie','name' => 'Browser share', 'data' => $data)));


        return $this->render('NotesBundle:Default:statistics.html.twig', array(
            'chart' => $ob
        ));
    }

    public function majeurAction (Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $query1 = 'SELECT  user.username, note.nom_matier, max(note.moyenne) as majeur 
                                   from user, note
                                   WHERE user.id=note.cin 
                                   GROUP by note.nom_matier ;';
        $statement = $em->getConnection()->prepare($query1);
        $statement->execute();

        $result = $statement->fetchAll();

        return $this->render('NotesBundle:Default:majeur.html.twig',array('result'=>$result));

    }
    public  function exportAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Evaluations= $em->getRepository('EvaliatBundle:Evaluation')->findAll();
        $writer = $this->container->get('egyg33k.csv.writer');
        $csv = $writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(['id_etd', 'presence', 'rendement','discipline', 'nom_matiere', 'id_enseignant']);
        foreach ($Evaluations as $eval){

            $csv->insertOne([$eval->getIdEtd(), $eval->getPresence(), $eval->getRendement(), $eval->getDiscipline(), $eval->getNomMatiere(), $eval->getIdEnseignant()]);
        }

        $csv->output('Evaluations.csv');
        die('export');
    }


}