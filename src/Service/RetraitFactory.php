<?php

declare(strict_types = 1);

namespace App\Service;

use App\Entity\Billet;
use App\Entity\Retrait;

/**
 * Class RetraitFactory
 */
class RetraitFactory
{
    /**
     * @param array $billets
     * un tableau clé valeurs
     * les clés sont les montants des billets
     * les valeurs sont les quantités des billets
     *
     * @return Retrait
     */
    public static function create($billets): Retrait
    {
        // création d'une instance de Retrait
        $retrait = new Retrait();
        $retrait->setDate(new \DateTime());
        // gestion des quantités de billets du DAB
        foreach ($billets as $montant => $nbBillet) {
            // si aucun billet
            if (0 === $nbBillet) {
                continue;
            }
            // création d'une instance de Billet
            $billet = new Billet();
            $billet->setMontantUnitaire($montant);
            $billet->setQuantite($nbBillet);
            // ajout des billet au retrait
            $retrait->addBillet($billet);
        }

        return $retrait;
    }
}
