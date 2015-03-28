<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/03/15
 * Time: 17:22
 */

namespace Uknow\PlatformBundle\Services;


class ServiceList {

    public function listDomaine(){

        $listDomaine = array();
        $json = file_get_contents('json/domaines.json');
        $jsonDomaine = json_decode($json, true);

        foreach ($jsonDomaine['domaine'] as $domaine){
            $listDomaine[$domaine['lien']] = $domaine['nom'];
        }

        return $listDomaine;

    }

    public function listMatiere(){

        $listMatiere = array();
        $json = file_get_contents('json/matieres.json');
        $jsonMatiere = json_decode($json, true);

        foreach ($jsonMatiere['matiere'] as $domaine){
            foreach ($domaine as $matiere){
                $listMatiere[$matiere['lien']] = $matiere['nom'];
            }
        }

        return $listMatiere;

    }

    public function listTheme(){

        $listTheme = array();
        $json = file_get_contents('json/themes.json');
        $jsonTheme = json_decode($json, true);

        foreach ($jsonTheme['theme'] as $domaine){
            foreach ($domaine as $matiere){
                foreach ($matiere as $theme){
                    $listTheme[$theme['lien']] = $theme['nom'];
                }
            }
        }

        return $listTheme;

    }

    public function listChapitre(){

        $listChapitre = array();
        $json = file_get_contents('json/chapitres.json');
        $jsonMatiere = json_decode($json, true);

        foreach ($jsonMatiere['chapitre'] as $domaine){
            foreach ($domaine as $matiere){
                foreach ($matiere as $theme){
                    foreach ($theme as $chapitre){
                        $listChapitre[$chapitre['lien']] = $chapitre['nom'];
                    }
                }
            }
        }

        return $listChapitre;

    }
}