<?php

namespace StageBundle\Repository;

use Doctrine\ORM\EntityRepository;




/**
 * StageRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StageRepository extends EntityRepository
{
    public function supprimerStage()
    {
        $conn = $this->getEntityManager()->getConnection();
$b=$_GET['idStage'];
        $sql = "
        
        DELETE FROM Stage 
WHERE id_stage= $b
        ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    }

    public function PostulerStage($user)
    {

       
        $conn = $this->getEntityManager()->getConnection();


        $b=$_GET['idStageaffect'];
        $sql = "INSERT INTO Affectation 
( `id_stage`, `id_user`, `postuler`) VALUES 
(  $b , $user ,  'nonvalid' );

        
        ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();


    }
    public function AffecterStage($user)
    {
       

        $conn = $this->getEntityManager()->getConnection();
        $b=$_GET['idStageaffected'];
        $sqlu = "UPDATE Affectation SET postuler='valid' WHERE `id_user`= $user and id_stage=$b  and postuler='nonvalid'";

        $sql = " UPDATE Stage SET capacite_max=capacite_max-1 WHERE id_stage=$b  ";

        $sqla ="DELETE FROM Stage WHERE capacite_max= 0";

        $stmt = $conn->prepare($sqlu);
        $stmtt = $conn->prepare($sql);
        $stmttt = $conn->prepare($sqla);

        $stmt->execute();
        $stmtt->execute();
        $stmttt->execute();

    }
    public function VerifAffecterStage($user,$idStage)
    {

        $query=$this->getEntityManager()
            ->createQuery("SELECT a FROM StageBundle:Affectation a WHERE a.idUser='$user' AND a.idStage='$idStage'  ");
        return $query->getResult();

    }
}
