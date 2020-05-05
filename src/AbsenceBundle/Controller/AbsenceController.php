<?php

namespace AbsenceBundle\Controller;

use AbsenceBundle\Entity\Absence;
use AbsenceBundle\Repository\AbsenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SeanceBundle\Entity\Seance;
use ClasseBundle\Entity\Classe;

/**
 * Absence controller.
 *
 */
class AbsenceController extends Controller
{
    /**
     * Lists all absence entities.
     *
     */
    public function indexAction()
    {
        $id1= $this->getUser()->getId();
        $id=intval($id1);
        $seances=$this->getDoctrine()->getRepository('SeanceBundle:Seance')->findseance($id);

        $listFanction=array();

        $seance = new Seance();
        foreach ($seances as $seance){
            $idClasses=$this->getDoctrine()->getRepository('ClasseBundle:Classe')->findIdClasse($seance->getIdClasse());
            foreach ($idClasses as $id) {
                $listFanction[$seance->getIdSeance()] = $this->getDoctrine()->getRepository('UserBundle:User')->findEtudiantClasse($id->getIdClasse());
                                        }
            }
        
        return $this->render('absence/index.html.twig', array(
            'seances' => $seances,
            'etudiants'=>$listFanction,
        ));
    }

    /**
     * Creates a new absence entity.
     *
     */
    public function newAction(Request $request)
    {
        $absence = new Absence();
        $form = $this->createForm('AbsenceBundle\Form\AbsenceType', $absence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($absence);
            $em->flush();

            return $this->redirectToRoute('absence_show', array('idAbsence' => $absence->getIdabsence()));
        }

        return $this->render('absence/new.html.twig', array(
            'absence' => $absence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a absence entity.
     *
     */
    public function showAction(Absence $absence)
    {
        $deleteForm = $this->createDeleteForm($absence);

        return $this->render('absence/show.html.twig', array(
            'absence' => $absence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing absence entity.
     *
     */
    public function editAction(Request $request, Absence $absence)
    {
        $deleteForm = $this->createDeleteForm($absence);
        $editForm = $this->createForm('AbsenceBundle\Form\AbsenceType', $absence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('absence_edit', array('idAbsence' => $absence->getIdabsence()));
        }

        return $this->render('absence/edit.html.twig', array(
            'absence' => $absence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a absence entity.
     *
     */
    public function deleteAction(Request $request, Absence $absence)
    {
        $form = $this->createDeleteForm($absence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($absence);
            $em->flush();
        }

        return $this->redirectToRoute('absence_index');
    }

    /**
     * Creates a form to delete a absence entity.
     *
     * @param Absence $absence The absence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Absence $absence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('absence_delete', array('idAbsence' => $absence->getIdabsence())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function indAction()
    {
        $em = $this->getDoctrine()->getManager();

        $absences = $em->getRepository('AbsenceBundle:Absence')->findAll();
        $count=$this->getDoctrine()->getRepository('AbsenceBundle:Absence')->count();

        return $this->render('absence/index1.html.twig', array(
            'absences' => $absences,
            'count'=>$count,
        ));
    }
}
