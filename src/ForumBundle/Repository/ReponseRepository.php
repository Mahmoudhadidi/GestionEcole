<?php

namespace ForumBundle\Repository;

use Doctrine\ORM\EntityRepository;


/**
 * ReponseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReponseRepository extends EntityRepository
{
    public function supprimerReponse()
    {
        $conn = $this->getEntityManager()->getConnection();
        $b=$_GET['idReponse'];
        $sql = "
        
        DELETE FROM Reponse 
WHERE id= $b
        ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    }
    public function repondre($id,$reponse){

        $query = $this->getEntityManager()
            ->createQuery(" UPDATE ForumBundle:reponse e SET e.reponse=:reponse  where e.id=:id ")
            ->setParameter('id', $id)
            ->setParameter('reponse',$reponse);
        return $query->getResult();
    }


    public function modifierReponse()
    {
        $conn = $this->getEntityManager()->getConnection();
        $b=$_GET['idReponse'];
        $sql = "
        
        Edit FROM Reponse 
WHERE id= $b
        ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    }

    public function  findByReponse($reponse,$date,$id_Q )
    {


        $conn = $this->getEntityManager()->getConnection();



        $sql = "INSERT INTO Reponse
 ( reponse, date, id_ques) VALUES
 (  '$reponse' , '$date'  , $id_Q );


 ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();


    }

    public function findreponse($idQ)
    {
        $query=$this->getEntityManager()
            ->createQuery("SELECT a FROM ForumBundle:Reponse a WHERE   a.idQues='$idQ' ");
        return $query->getResult();
    }

}
