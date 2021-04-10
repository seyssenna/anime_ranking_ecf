<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Review;
use App\Models\Watchlist;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReviewController;

class AnimeController extends Controller
{
    // affiche tous les animes sur la page d'accueil
    public function getAllAnime()
    {
        $animes = Anime::All();
        return view('welcome', ["animes" => $animes]);
    }

    // fonction qui retourne la moyenne d'un tableau
    public function getAvg(array $tab)
    {
        $somme = 0;
        $i = 0;
        foreach($tab as $valeur)
        {
        $i++; // On incrémente la variable qui nous dit combien de tour on fait
        $somme+=$valeur;
        // équivaut a $somme = $somme + $valeur
        }
        $moyenne = $somme / $i;
        return $moyenne;
    }


    // affiche un anime 
    public function showAnime($id)
    {
        //requete pour recuperer l'anime
        $anime = Anime::find($id);
        
        // requete pour recuperer les reviews
        $reviews = Review::join('animes', 'fk_anime_id', '=', 'animes.id')
                         ->join('users', 'fk_user_id', '=', 'users.id')
                         ->where('fk_anime_id', '=', $id)
                         ->get();

        // recupere le nombre de reviews
        $reviewsCount = count($reviews);
        
        // calcule la moyenne des notes
        $moyenne = round($reviews->avg('rating'), 1);

        // requete pour savoir si l'utilisateur connecté as déjà écrit une critique sur l'anime affiché
        $query = Review::where('fk_user_id', '=', Auth::id())
                                    ->where('fk_anime_id', '=', $id)
                                    ->get();
        // contient le nombre de critique de l'utilisateur connecté sur l'anime affiché
        $alreadyCommented = count($query);

        // requete pour verifier si un anime est deja(ou pas) dans la watchlist de l'utilisateur courant
        $query = Watchlist::where('fk_user_id', '=', Auth::id())
                         ->where('fk_anime_id', '=', $id)
                         ->get();
        $alreadyInWatchlist = count($query); 

        return view('anime', 
                  ["anime" => $anime, 
                 'reviews' => $reviews, 
            'reviewsCount' => $reviewsCount, 
                 'moyenne' => $moyenne,
        'alreadyCommented' => $alreadyCommented,
      'alreadyInWatchlist' => $alreadyInWatchlist]);
    }

    // envoi sur la page d'ajout de review d'un anime
    public function getAnime($id) 
    {
        $anime = Anime::find($id);

        //  // requete pour savoir si l'utilisateur connecté as déjà écrit une critique sur l'anime affiché
        //  $query = Review::where('fk_user_id', '=', Auth::id())
        //  ->where('fk_anime_id', '=', $id)
        //  ->get();
        //  // contient le nombre de critique de l'utilisateur connecté sur l'anime affiché
        //  $alreadyCommented = count($query);
         $alreadyCommented = ReviewController::AlreadyCommented($id);

        // dd($alreadyCommented);
        return view('new_review', ["anime" => $anime, 'alreadyCommented' => $alreadyCommented]);
    }
}
