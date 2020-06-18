<?php

namespace NotesBundle\Controller;

use MatiereBundle\Entity\Matiere;
use Mukadi\Chart\Builder;
use NotesBundle\Entity\Note;
use PDO;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Dompdf\Dompdf;
use Dompdf\Options;
use Mukadi\Chart\Utils\RandomColorFactory;
use Mukadi\Chart\Chart;
use Mukadi\ChartJSBundle\Chart\NativeBuilder;


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
       # var_dump($resultat);

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
    /**
     * Lists all association entities.
     *
     */
    public function pdfAction()
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $em = $this->getDoctrine()->getManager();
        $associations = $em->getRepository('NotesBundle:Note')->findAll();
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('note/listA.html.twig', array(
            'notes' => $associations,
        ));
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);
    }




}