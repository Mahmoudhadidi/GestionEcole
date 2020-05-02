<?php

namespace TypeStageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class TypeStageBundle extends Bundle
{
    public function supprimerStage()
    {
        $conn = $this->getEntityManager()->getConnection();
        $b=$_GET['idStage'];
        $sql = "
        
        DELETE FROM type_stage 
WHERE id_type_stage= $b
        ";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    }

}


