<?php

declare(strict_types=1);

namespace App\Core;

/*
* Permet d'afficher un template.php. Pour se construire cet objet 
* a besoin du chemin vers le dossier contenant les templates
*/

class View
{

    public const GLOBAL_NAME = 'app';


    /* chemin du dossier templates */ 
    public string $templateDir;


    /* tableau des varaible globals du templates. Accesible à tous nos templates */
    public array $globals;


    /* construteur d'une vue. Prérequis obligatoire : envoyer le chemin du dossier contenant tout les templates */
    public function __construct(string $templateDir, array $globals=[]){

        $this -> templateDir = $templateDir;
        $this -> globals = $globals;
    }
    
    
    /* afficher le contenu d'un template */
    public function render (string $template, array $variables=[]){

        //création du nom complet pour le fichier
        $filename = "{$this -> templateDir}/{$template}.php";

        //Démarrer le buffer d'affichage
        ob_start();

        // extraction des variables
        extract($variables);
        extract([self::GLOBAL_NAME => $this -> globals]);

        //inclusion du fichier template
        include $filename;

        //retourner le fichier compiler
        return ob_get_clean();
    }
}
