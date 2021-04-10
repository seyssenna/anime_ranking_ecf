<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Support\Facades\DB;



class TopController extends Controller
{
    public function goToTop()
    {
        //  ________________________________________________________________________________________________________ 
        // | ICI LA REQUETE EN SQL PURE, j'ai eu du mal a trouver la bonne methode pour la faire avec l"ORM Eloquent|
        // | j'ai commencer par ca avant de enfin trouver (avec un peu d'aides) comment faire avec Eloquent.        |
        // | c'est pour moi la requete la plus dur du projet.                                                       |
        // |                                                    |                                                   |
        // |                                                    V                                                   |
        // |  $animes = DB::select('SELECT ROUND(AVG(rating), 1) AS moyenne, id, title, animes.description, cover   |
        // |                      FROM reviews                                                                      |
        // |                      JOIN animes ON fk_anime_id = animes.id                                            |
        // |                      GROUP BY fk_anime_id                                                              |
        // |                      ORDER BY moyenne DESC');                                                          |
        //  --------------------------------------------------------------------------------------------------------

         
        $animes = Review::join('animes', 'fk_anime_id', '=', 'animes.id')
        // ici on sélectionne la colonne "rating" dans la table "reviews" et on fait la moyenne des notes
        // DB::raw permet l'ajout de chaine de caractere(round, avg, as...) dans la requete eloquent 
        ->select('title',DB::raw("ROUND(AVG(rating),1) AS moyenne"), 'description', 'cover', 'fk_anime_id')
        ->groupBy('fk_anime_id')
        ->orderBy('moyenne', 'desc')
        ->get();

        // conteur pour classement du top
        $i = 1;
        
        return view('top', ["animes" => $animes, "i" => $i]);
    }
}
