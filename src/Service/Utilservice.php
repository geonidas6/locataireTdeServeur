<?php


namespace App\Service;


use App\Entity\Compte;
use App\Entity\HistoriqueCompte;
use Doctrine\ORM\EntityManager;


class Utilservice
{

    protected $em ;

    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


    public function createHistorique(Compte $compte, $creditHistorique, $Motif){
       /* $relation_user_enseigne = $this->em->getRepository('AppBundle:Relation')->findOneBy(
            [
                "enseigne"=>$enseigne,
                "user"=>$user,
            ]
        );*/
       //ajout de l'historique
        $HistoriqueCompte = new HistoriqueCompte();
        $HistoriqueCompte->setCompte($compte);
        $HistoriqueCompte->setMotif($Motif);
        $HistoriqueCompte->setCredit($creditHistorique);
        $this->em->persist($HistoriqueCompte);
        $this->em->flush();
        return true;
    }


}