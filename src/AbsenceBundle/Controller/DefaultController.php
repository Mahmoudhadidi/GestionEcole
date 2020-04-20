<?php

namespace AbsenceBundle\Controller;

use AbsenceBundle\Entity\Absence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AbsenceBundle:Default:index.html.twig');
    }

    public function convertAction(Request $request, Absence $absence)
    {
        $snappy = $this->get("knp_snappy.pdf");

        $html = $this->renderView("@Absence/Default/absencePdf.html.twig", array(
            "title" => "Awesome PDF Title",
            'Absence'=>$absence
        ));

        $filename = "resultat";

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'.pdf"',
            )
        );

    }
}
