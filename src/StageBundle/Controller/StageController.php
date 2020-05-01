<?php

namespace StageBundle\Controller;

use StageBundle\Entity\Stage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Stage controller.
 *
 */
class StageController extends Controller
{
    /**
     * Lists all stage entities.
     *
     */
    public function indexAction(Request $request)
    {
        {
            $stage = new Stage();
            $form = $this->createForm('StageBundle\Form\StageType', $stage);
            $form->handleRequest($request);
            $role = "";
            $authChecker = $this->container->get('security.authorization_checker');

            if($authChecker->isGranted('ROLE_ETUDIANT')) {

                $role="ROLE_ETUDIANT";
            }elseif ($authChecker->isGranted('ROLE_ADMIN')) {
                $role="ROLE_ADMIN";
            }

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($stage);
                $em->flush();

                return $this->redirectToRoute('stage_index');
            }

            $em = $this->getDoctrine()->getManager();


            if (isset($_GET['idStage'])) {
                $this->getDoctrine()->getRepository('StageBundle:Stage')->supprimerStage();
                return $this->redirectToRoute('stage_index');
            }
            $qs = $this->getUser()->getId();
            $IdUser = intval($qs);
            if (isset($_GET['idStageaffect'])) {
                $this->getDoctrine()->getRepository('StageBundle:Stage')->PostulerStage($IdUser);
                return $this->redirectToRoute('stage_index');
            }
            if (isset($_GET['idStageaffected'])) {
                $this->getDoctrine()->getRepository('StageBundle:Stage')->AffecterStage($IdUser);
                return $this->redirectToRoute('listNonValid');
            }



            $stages = $em->getRepository('StageBundle:Stage')->findAll();
            $verifFanction=array();

            foreach ($stages as $idStage){

                $verifFanction[$idStage->getIdStage()] = $this->getDoctrine()->getRepository('StageBundle:Affectation')->VerifAffecterStage($IdUser,$idStage->getIdStage());


            }

            return $this->render('stage/index.html.twig', array(
                'stages' => $stages,
                'form' => $form->createView(),
                'role'=>$role,
                'verif'=>$verifFanction,

            ));
        }}
   

        public function afficheStagenonvalidAction()
        {
            $qs = $this->getUser()->getId();


            $em = $this->getDoctrine()->getManager();

            $query1 = 'SELECT  user.id,user.username, affectation.postuler,stage.titre,stage.description,stage.type,stage.id_stage 
                       from user,affectation,stage
                       WHERE affectation.id_user=user.id and affectation.id_stage=stage.id_stage and user.id="$qs" and affectation.postuler=\'"nonvalid"\';';
            $statement = $em->getConnection()->prepare($query1);
            $statement->execute();

            $result = $statement->fetchAll();

            return $this->render('stage/adminstage.html.twig',array('result'=>$result));

        }

    /**
     * Creates a new stage entity.
     *
     */
    public function newAction(Request $request)
    {
        $stage = new Stage();

        $form = $this->createForm('StageBundle\Form\StageType', $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($stage);
            $em->flush();

            return $this->redirectToRoute('stage_show', array('idStage' => $stage->getIdstage()));
        }

        return $this->render('stage/new.html.twig', array(
            'stage' => $stage,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a stage entity.
     *
     */
    public function showAction(Stage $stage)
    {
        $deleteForm = $this->createDeleteForm($stage);

        return $this->render('stage/show.html.twig', array(
            'stage' => $stage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing stage entity.
     *
     */
    public function editAction(Request $request, Stage $stage)
    {
        $deleteForm = $this->createDeleteForm($stage);
        $editForm = $this->createForm('StageBundle\Form\StageType', $stage);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stage_edit', array('idStage' => $stage->getIdstage()));
        }

        return $this->render('stage/edit.html.twig', array(
            'stage' => $stage,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a stage entity.
     *
     */
    public function deleteAction(Request $request, Stage $stage)
    {
        $form = $this->createDeleteForm($stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($stage);
            $em->flush();
        }

        return $this->redirectToRoute('stage_index');
    }

    /**
     * Creates a form to delete a stage entity.
     *
     * @param Stage $stage The stage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Stage $stage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('stage_delete', array('idStage' => $stage->getIdstage())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
