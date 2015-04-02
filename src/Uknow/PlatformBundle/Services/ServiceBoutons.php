<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 05/03/15
 * Time: 11:27
 */

namespace Uknow\PlatformBundle\Services;

class ServiceBoutons {

    public function boutonSauvegarder($donnee, $compte, $em){

        if ($compte->getDonneesSauvegardees() != null) {
            $compte->setDonneesSauvegardees($compte->getDonneesSauvegardees() . '/' . $donnee->getId());
        }else{
            $compte->setDonneesSauvegardees($donnee->getId());
        }
        $em->persist($compte);
        $em->flush();
    }

    public function boutonSupprimer($donnee, $compte, $em){

        $tableauDonnees = explode('/', $compte->getDonneesSauvegardees());
        if(count($tableauDonnees) > 1){
           for ($i = 0; $i < count($tableauDonnees); $i++) {
                if ($tableauDonnees[$i] == $donnee->getId()) {
                    unset($tableauDonnees[$i]);
                    $compte->setDonneesSauvegardees(implode('/', $tableauDonnees));
                }
            }
        }else{
            $compte->setDonneesSauvegardees(null);
        }
        $em->persist($compte);
        $em->flush();
    }

    public function boutonPertinent($donnee, $compte, $em){

        if ($compte->getDonneesEvaluees() != null) {
            $compte->setDonneesEvaluees($compte->getDonneesEvaluees() . '/' . $donnee->getId() . '.1');
        }else{
            $compte->setDonneesEvaluees($donnee->getId() . '.1');
        }
        $donnee->setPertinent($donnee->getPertinent() + 1);
        $em->persist($donnee);
        $em->flush();
        $em->persist($compte);
        $em->flush();
    }

    public function boutonDevelopper($donnee, $compte, $em){

        if ($compte->getDonneesEvaluees() != null) {
            $compte->setDonneesEvaluees($compte->getDonneesEvaluees() . '/' . $donnee->getId() . '.2');
        }else{
            $compte->setDonneesEvaluees($donnee->getId() . '.2');
        }
        $donnee->setDevelopper($donnee->getDevelopper() + 1);
        $em->persist($donnee);
        $em->flush();
        $em->persist($compte);
        $em->flush();
    }

    public function boutonInutile($donnee, $compte, $em){

        if ($compte->getDonneesEvaluees() != null) {
            $compte->setDonneesEvaluees($compte->getDonneesEvaluees() . '/' . $donnee->getId() . '.3');
        }else{
            $compte->setDonneesEvaluees($donnee->getId() . '.3');
        }
        $donnee->setInutile($donnee->getInutile() + 1);
        $em->persist($donnee);
        $em->flush();
        $em->persist($compte);
        $em->flush();
    }
}