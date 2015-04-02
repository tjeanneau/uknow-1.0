<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 06/03/15
 * Time: 10:30
 */

namespace Uknow\PlatformBundle\Services;

class ServiceEvaluation {

    public function ratio($donnee){
        $ratio = $donnee->getPertinent() - $donnee->getInutile();
        return $ratio;
    }

    public function fiabilite($listDonnees, $listCompte, $em)
    {

        for($l = 0 ; $l < count($listDonnees) ; $l++ ){
            $nbEva = 0;
            $nbPers = 0;
            for ($i = 0; $i < count($listCompte); $i++) {
                $donneesEvaluees = explode('/', $listCompte[$i]->getDonneesEvaluees());
                $voixChapitre = explode('/', $listCompte[$i]->getVoixChapitre());
                for ($j = 0; $j < count($donneesEvaluees); $j++) {
                    if (explode('.', $donneesEvaluees[$j])[0] == $listDonnees[$l]->getId()) {
                        for ($k = 0; $k < count($voixChapitre); $k++) {
                            if (explode('.', $voixChapitre[$k])[0] == $listDonnees[$l]->getId()) {
                                if (explode('.', $donneesEvaluees[$j])[1] == 1) {
                                    $nbEva = $nbEva + explode('.', $voixChapitre[$k])[1];
                                } elseif (explode('.', $donneesEvaluees[$j])[1] == 0) {
                                    $nbEva = $nbEva - explode('.', $voixChapitre[$k])[1];
                                }
                            }
                        }
                    }
                }
            }

            for ($m = 0; $m < count($listCompte); $m++) {
                $voixChapitre = explode('/', $listCompte[$m]->getVoixChapitre());
                for ($n = 0; $n < count($voixChapitre); $n++) {
                    if (explode('.', $voixChapitre[$n])[0] == $listDonnees[$l]->getId()) {
                        $nbPers = $nbPers + explode('.', $voixChapitre[$n])[1];
                    }
                }
            }

            if($nbPers != 0){
                if(($nbEva*100/$nbPers) > 0){
                    $listDonnees[$l]->setFiabilite($nbEva*100/$nbPers);
                }else{
                    $listDonnees[$l]->setFiabilite(0);
                }
            }else{
                $listDonnees[$l]->setFiabilite(0);
            }

            $em->persist($listDonnees[$l]);
            $em->flush();
        }

        return $listDonnees;
    }

    public function niveauChapitreIni(){

        $chaineNiveau = '';
        $json = file_get_contents('json/domaines.json');
        $jsonDomaine = json_decode($json, true);
        $json = file_get_contents('json/matieres.json');
        $jsonMatiere = json_decode($json, true);
        $json = file_get_contents('json/themes.json');
        $jsonTheme = json_decode($json, true);
        $json = file_get_contents('json/chapitres.json');
        $jsonChapitre = json_decode($json, true);
        for($i = 0 ; $i < count($jsonDomaine['domaine']) ; $i++){
            for($j = 0 ; $j < count($jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']]) ; $j++){
                for($j = 0 ; $j < count($jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']]) ; $j++){
                    for($j = 0 ; $j < count($jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']]) ; $j++){
                        if($lien == $jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']][$j]['lien']){
                            $donnee = new Structure();
                            $donnee->setLien($jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']][$j]['lien']);
                            $donnee->setNom($jsonMatiere['matiere'][$jsonDomaine['domaine'][$i]['lien']][$j]['nom']);
                            return $donnee;
                        }
                    }
                }
            }
        }

        for ( $i = 0; $i < (count($listStructure)); $i++){
            if($i == 0){
                $chaineNiveau = $listStructure[$i]->getId() . '.0';
            }else{
                $chaineNiveau = $chaineNiveau . '/' . $listStructure[$i]->getId() . '.0';
            }
        }
        return $chaineNiveau;
    }

    public function voixChapitreIni()
    {

        $chaineNiveau = '';

        for ($i = 0; $i < (count($listStructure)); $i++) {
            if ($i == 0) {
                $chaineNiveau = $listStructure[$i]->getId() . '.1';
            } else {
                $chaineNiveau = $chaineNiveau . '/' . $listStructure[$i]->getId() . '.1';
            }
        }
        return $chaineNiveau;
    }
}