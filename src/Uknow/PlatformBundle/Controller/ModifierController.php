<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 28/03/15
 * Time: 19:28
 */

namespace Uknow\PlatformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Uknow\PlatformBundle\Form\AjoutCoursType;
use Uknow\PlatformBundle\Services;
use Uknow\PlatformBundle\Classes\FormulaireModifierCours;
use Uknow\PlatformBundle\Entity\Donnees;

class ModifierController extends Controller{

    public function coursAction($id, Request $request){

        // Initialisation des variables principales

        $k = 0;
        $donnees = new Donnees();
        $em = $this->getDoctrine()->getManager();
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $formQuestion = $servicesQuestion->initialisationQuestion($this);
        $formRecherche = $servicesRecherche->initialisationRecherche($this);

        // Initialisation des bases de données à utiliser

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();

        $donneerecu = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);


        // Gestion des requètes demandées

        if ($formQuestion->handleRequest($request)->isValid()){

        }

        if ($formRecherche->handleRequest($request)->isValid()){

        }

        if($donneerecu->getType() == 'Exercice'){
            $formModifier = new FormulaireModifierExercice();
            $formModifier->setExercice($donneerecu->getTexte());
            $formModifier->setTemps($donneerecu->getTemps());
            $formDonnees = $this->get('form.factory')->create(new ModifierExerciceType(), $formModifier);
        }else{
            $formModifier = new FormulaireModifierCours();
            $formModifier->setCours($donneerecu->getTexte());
            $formModifier->setTemps($donneerecu->getTemps());
            $formDonnees = $this->get('form.factory')->create(new ModifierCoursType(), $formModifier);
        }

        if ($formDonnees->handleRequest($request)->isValid()){
            for ($i = 0; $i < count($listStructure); $i++){
                if ($listStructure[$i]->getChapitreLien() == $donneerecu->getChapitre()
                    && $listStructure[$i]->getThemeLien() == $donneerecu->getTheme()
                    && $listStructure[$i]->getMatiereLien() == $donneerecu->getMatiere()
                    && $listStructure[$i]->getDomaineLien() == $donneerecu->getDomaine()){
                    $donnees->setDomaine($listStructure[$i]->getDomaineLien());
                    $donnees->setMatiere($listStructure[$i]->getMatiereLien());
                    $donnees->setTheme($listStructure[$i]->getThemeLien());
                    $donnees->setChapitre($listStructure[$i]->getChapitreLien());
                    $donnees->setTitre($donneerecu->getTitre());
                    if($donneerecu->getType() == 'Exercice'){
                        $donnees->setTexte($formModifier->getExercice());
                    }else{
                        $donnees->setTexte($formModifier->getCours());
                    }
                    $donnees->setTemps($formModifier->getTemps());
                    $donnees->setType($donneerecu->getType());
                    $donnees->setNiveau($donneerecu->getNiveau());
                    $listDonnees = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('UknowPlatformBundle:Donnees')
                        ->findAll();
                    $k = 0;
                    for($j = 0 ; $j < count($listDonnees); $j++){
                        if($listDonnees[$j]->getDomaine() == $donnees->getDomaine()
                            && $listDonnees[$j]->getMatiere() == $donnees->getMatiere()
                            && $listDonnees[$j]->getTheme() == $donnees->getTheme()
                            && $listDonnees[$j]->getChapitre() == $donnees->getChapitre()
                            && $listDonnees[$j]->getTitre() == $donnees->getTitre()){
                            $k++;
                        }
                    }
                    $donnees->setModification($k);
                }
            }
            $em->persist($donnees);
            $em->flush();
            return $this->redirect($this->generateUrl('uknow_platform_recherche_chapitre', array(
                'domaine' => $donnees->getDomaine(),
                'matiere' => $donnees->getMatiere(),
                'theme' => $donnees->getTheme(),
                'chapitre' => $donnees->getChapitre(),
            )));
        }


        // Mise à jour des bases de données modifiées à afficher

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();

        $donneerecu = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);


        // Gestion de l'affichage des données

        if ($id == null){
            return $this->render('UknowPlatformBundle::erreur.html.twig', array(
                'formQuestion' => $formQuestion->createView(),
                'listQuestion' => $listQuestion));
        }

        for ($i = 0; $i < count($listStructure); $i++) {
            if ($listStructure[$i]->getChapitreLien() == $donneerecu->getChapitre()
                && $listStructure[$i]->getMatiereLien() == $donneerecu->getMatiere()
                && $listStructure[$i]->getDomaineLien() == $donneerecu->getDomaine()
                && $listStructure[$i]->getThemeLien() == $donneerecu->getTheme()
            ) {
                $k = $i;
            }
        }

        return $this->render('UknowPlatformBundle::modifier.html.twig', array(
            'formQuestion' => $formQuestion->createView(),
            'formRecherche' => $formRecherche->createView(),
            'formModifier' => $formDonnees->createView(),
            'listQuestion' => $listQuestion,
            'titredonnee' => $donneerecu->getTitre(),
            'type' => $donneerecu->getType(),
            'niveau' => $donneerecu->getNiveau(),
            'chapitre' => $donneerecu->getChapitre(),
            'matiere' => $donneerecu->getMatiere(),
            'theme' => $donneerecu->getTheme(),
            'domaine' => $donneerecu->getDomaine(),
            'titreDomaine' => $listStructure[$k]->getDomaine(),
            'titreMatiere' => $listStructure[$k]->getMatiere(),
            'titreTheme' => $listStructure[$k]->getTheme(),
            'titreChapitre' => $listStructure[$k]->getChapitre(),
        ));
    }

    public function exerciceAction($id, Request $request){

        // Initialisation des variables principales

        $k = 0;
        $donnees = new Donnees();
        $em = $this->getDoctrine()->getManager();
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $formQuestion = $servicesQuestion->initialisationQuestion($this);
        $formRecherche = $servicesRecherche->initialisationRecherche($this);

        // Initialisation des bases de données à utiliser

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();

        $donneerecu = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);


        // Gestion des requètes demandées

        if ($formQuestion->handleRequest($request)->isValid()){

        }

        if ($formRecherche->handleRequest($request)->isValid()){

        }

        if($donneerecu->getType() == 'Exercice'){
            $formModifier = new FormulaireModifierExercice();
            $formModifier->setExercice($donneerecu->getTexte());
            $formModifier->setTemps($donneerecu->getTemps());
            $formDonnees = $this->get('form.factory')->create(new ModifierExerciceType(), $formModifier);
        }else{
            $formModifier = new FormulaireModifierCours();
            $formModifier->setCours($donneerecu->getTexte());
            $formModifier->setTemps($donneerecu->getTemps());
            $formDonnees = $this->get('form.factory')->create(new ModifierCoursType(), $formModifier);
        }

        if ($formDonnees->handleRequest($request)->isValid()){
            for ($i = 0; $i < count($listStructure); $i++){
                if ($listStructure[$i]->getChapitreLien() == $donneerecu->getChapitre()
                    && $listStructure[$i]->getThemeLien() == $donneerecu->getTheme()
                    && $listStructure[$i]->getMatiereLien() == $donneerecu->getMatiere()
                    && $listStructure[$i]->getDomaineLien() == $donneerecu->getDomaine()){
                    $donnees->setDomaine($listStructure[$i]->getDomaineLien());
                    $donnees->setMatiere($listStructure[$i]->getMatiereLien());
                    $donnees->setTheme($listStructure[$i]->getThemeLien());
                    $donnees->setChapitre($listStructure[$i]->getChapitreLien());
                    $donnees->setTitre($donneerecu->getTitre());
                    if($donneerecu->getType() == 'Exercice'){
                        $donnees->setTexte($formModifier->getExercice());
                    }else{
                        $donnees->setTexte($formModifier->getCours());
                    }
                    $donnees->setTemps($formModifier->getTemps());
                    $donnees->setType($donneerecu->getType());
                    $donnees->setNiveau($donneerecu->getNiveau());
                    $listDonnees = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('UknowPlatformBundle:Donnees')
                        ->findAll();
                    $k = 0;
                    for($j = 0 ; $j < count($listDonnees); $j++){
                        if($listDonnees[$j]->getDomaine() == $donnees->getDomaine()
                            && $listDonnees[$j]->getMatiere() == $donnees->getMatiere()
                            && $listDonnees[$j]->getTheme() == $donnees->getTheme()
                            && $listDonnees[$j]->getChapitre() == $donnees->getChapitre()
                            && $listDonnees[$j]->getTitre() == $donnees->getTitre()){
                            $k++;
                        }
                    }
                    $donnees->setModification($k);
                }
            }
            $em->persist($donnees);
            $em->flush();
            return $this->redirect($this->generateUrl('uknow_platform_recherche_chapitre', array(
                'domaine' => $donnees->getDomaine(),
                'matiere' => $donnees->getMatiere(),
                'theme' => $donnees->getTheme(),
                'chapitre' => $donnees->getChapitre(),
            )));
        }


        // Mise à jour des bases de données modifiées à afficher

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();

        $donneerecu = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);


        // Gestion de l'affichage des données

        if ($id == null){
            return $this->render('UknowPlatformBundle::erreur.html.twig', array(
                'formQuestion' => $formQuestion->createView(),
                'listQuestion' => $listQuestion));
        }

        for ($i = 0; $i < count($listStructure); $i++) {
            if ($listStructure[$i]->getChapitreLien() == $donneerecu->getChapitre()
                && $listStructure[$i]->getMatiereLien() == $donneerecu->getMatiere()
                && $listStructure[$i]->getDomaineLien() == $donneerecu->getDomaine()
                && $listStructure[$i]->getThemeLien() == $donneerecu->getTheme()
            ) {
                $k = $i;
            }
        }

        return $this->render('UknowPlatformBundle::modifier.html.twig', array(
            'formQuestion' => $formQuestion->createView(),
            'formRecherche' => $formRecherche->createView(),
            'formModifier' => $formDonnees->createView(),
            'listQuestion' => $listQuestion,
            'titredonnee' => $donneerecu->getTitre(),
            'type' => $donneerecu->getType(),
            'niveau' => $donneerecu->getNiveau(),
            'chapitre' => $donneerecu->getChapitre(),
            'matiere' => $donneerecu->getMatiere(),
            'theme' => $donneerecu->getTheme(),
            'domaine' => $donneerecu->getDomaine(),
            'titreDomaine' => $listStructure[$k]->getDomaine(),
            'titreMatiere' => $listStructure[$k]->getMatiere(),
            'titreTheme' => $listStructure[$k]->getTheme(),
            'titreChapitre' => $listStructure[$k]->getChapitre(),
        ));
    }

    public function correctionAction($id, Request $request){

        // Initialisation des variables principales

        $k = 0;
        $donnees = new Donnees();
        $em = $this->getDoctrine()->getManager();
        $servicesRecherche = $this->container->get('uknow_platform.recherche');
        $servicesQuestion = $this->container->get('uknow_platform.question');
        $formQuestion = $servicesQuestion->initialisationQuestion($this);
        $formRecherche = $servicesRecherche->initialisationRecherche($this);

        // Initialisation des bases de données à utiliser

        $listStructure = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Structure')
            ->findAll();

        $donneerecu = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);


        // Gestion des requètes demandées

        if ($formQuestion->handleRequest($request)->isValid()){

        }

        if ($formRecherche->handleRequest($request)->isValid()){

        }

        if($donneerecu->getType() == 'Exercice'){
            $formModifier = new FormulaireModifierExercice();
            $formModifier->setExercice($donneerecu->getTexte());
            $formModifier->setTemps($donneerecu->getTemps());
            $formDonnees = $this->get('form.factory')->create(new ModifierExerciceType(), $formModifier);
        }else{
            $formModifier = new FormulaireModifierCours();
            $formModifier->setCours($donneerecu->getTexte());
            $formModifier->setTemps($donneerecu->getTemps());
            $formDonnees = $this->get('form.factory')->create(new ModifierCoursType(), $formModifier);
        }

        if ($formDonnees->handleRequest($request)->isValid()){
            for ($i = 0; $i < count($listStructure); $i++){
                if ($listStructure[$i]->getChapitreLien() == $donneerecu->getChapitre()
                    && $listStructure[$i]->getThemeLien() == $donneerecu->getTheme()
                    && $listStructure[$i]->getMatiereLien() == $donneerecu->getMatiere()
                    && $listStructure[$i]->getDomaineLien() == $donneerecu->getDomaine()){
                    $donnees->setDomaine($listStructure[$i]->getDomaineLien());
                    $donnees->setMatiere($listStructure[$i]->getMatiereLien());
                    $donnees->setTheme($listStructure[$i]->getThemeLien());
                    $donnees->setChapitre($listStructure[$i]->getChapitreLien());
                    $donnees->setTitre($donneerecu->getTitre());
                    if($donneerecu->getType() == 'Exercice'){
                        $donnees->setTexte($formModifier->getExercice());
                    }else{
                        $donnees->setTexte($formModifier->getCours());
                    }
                    $donnees->setTemps($formModifier->getTemps());
                    $donnees->setType($donneerecu->getType());
                    $donnees->setNiveau($donneerecu->getNiveau());
                    $listDonnees = $this->getDoctrine()
                        ->getManager()
                        ->getRepository('UknowPlatformBundle:Donnees')
                        ->findAll();
                    $k = 0;
                    for($j = 0 ; $j < count($listDonnees); $j++){
                        if($listDonnees[$j]->getDomaine() == $donnees->getDomaine()
                            && $listDonnees[$j]->getMatiere() == $donnees->getMatiere()
                            && $listDonnees[$j]->getTheme() == $donnees->getTheme()
                            && $listDonnees[$j]->getChapitre() == $donnees->getChapitre()
                            && $listDonnees[$j]->getTitre() == $donnees->getTitre()){
                            $k++;
                        }
                    }
                    $donnees->setModification($k);
                }
            }
            $em->persist($donnees);
            $em->flush();
            return $this->redirect($this->generateUrl('uknow_platform_recherche_chapitre', array(
                'domaine' => $donnees->getDomaine(),
                'matiere' => $donnees->getMatiere(),
                'theme' => $donnees->getTheme(),
                'chapitre' => $donnees->getChapitre(),
            )));
        }


        // Mise à jour des bases de données modifiées à afficher

        $listQuestion = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Question')
            ->findAll();

        $donneerecu = $this->getDoctrine()
            ->getManager()
            ->getRepository('UknowPlatformBundle:Donnees')
            ->find($id);


        // Gestion de l'affichage des données

        if ($id == null){
            return $this->render('UknowPlatformBundle::erreur.html.twig', array(
                'formQuestion' => $formQuestion->createView(),
                'listQuestion' => $listQuestion));
        }

        for ($i = 0; $i < count($listStructure); $i++) {
            if ($listStructure[$i]->getChapitreLien() == $donneerecu->getChapitre()
                && $listStructure[$i]->getMatiereLien() == $donneerecu->getMatiere()
                && $listStructure[$i]->getDomaineLien() == $donneerecu->getDomaine()
                && $listStructure[$i]->getThemeLien() == $donneerecu->getTheme()
            ) {
                $k = $i;
            }
        }

        return $this->render('UknowPlatformBundle::modifier.html.twig', array(
            'formQuestion' => $formQuestion->createView(),
            'formRecherche' => $formRecherche->createView(),
            'formModifier' => $formDonnees->createView(),
            'listQuestion' => $listQuestion,
            'titredonnee' => $donneerecu->getTitre(),
            'type' => $donneerecu->getType(),
            'niveau' => $donneerecu->getNiveau(),
            'chapitre' => $donneerecu->getChapitre(),
            'matiere' => $donneerecu->getMatiere(),
            'theme' => $donneerecu->getTheme(),
            'domaine' => $donneerecu->getDomaine(),
            'titreDomaine' => $listStructure[$k]->getDomaine(),
            'titreMatiere' => $listStructure[$k]->getMatiere(),
            'titreTheme' => $listStructure[$k]->getTheme(),
            'titreChapitre' => $listStructure[$k]->getChapitre(),
        ));
    }
}