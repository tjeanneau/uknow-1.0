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

    public function boutonPertinent($listStructure, $listDonnees, $compte, $request, $em){

        $listDonnees = $this->affichage->correctionLien($listStructure, $listDonnees);

        if ($compte->getDonneesEvaluees() != null) {
            $compte->setDonneesEvaluees($compte->getDonneesEvaluees() . '/' . $listDonnees[$request->request->get('valeur', null)-1]->getId() . '.1');
        }else{
            $compte->setDonneesEvaluees($listDonnees[$request->request->get('valeur', null)-1]->getId() . '.1');
        }
        $listDonnees[$request->request->get('valeur', null)-1]->setPositive(
            $listDonnees[$request->request->get('valeur', null)-1]->getPositive()+1);
        $em->persist($listDonnees[$request->request->get('valeur', null)-1]);
        $em->flush();
        $em->persist($compte);
        $em->flush();
    }

    public function boutonDevelopper($listStructure, $listDonnees, $compte, $request, $em){

        $listDonnees = $this->affichage->correctionLien($listStructure, $listDonnees);

        if ($compte->getDonneesEvaluees() != null) {
            $compte->setDonneesEvaluees($compte->getDonneesEvaluees() . '/' . $listDonnees[$request->request->get('valeur', null)-1]->getId() . '.0');
        }else{
            $compte->setDonneesEvaluees($listDonnees[$request->request->get('valeur', null)-1]->getId() . '.0');
        }
        $listDonnees[$request->request->get('valeur', null)-1]->setNegative(
            $listDonnees[$request->request->get('valeur', null)-1]->getNegative()+1);
        $em->persist($listDonnees[$request->request->get('valeur', null)-1]);
        $em->flush();
        $em->persist($compte);
        $em->flush();
    }
}