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


    // affiche un anime dans sa page
    public function showAnime($id)
    {
    // j'ai tenté de faire une jointure sur 3 tables mais je n'arrivais pas
    // a afficher les animes sans review. je suis donc parti sur plusieurs requetes
    // 
    // $reviews = Review::join('animes', 'fk_anime_id', '=', 'animes.id')
    //                  ->join('users', 'fk_user_id', '=', 'users.id')
    //                  ->where('fk_anime_id', '=', $id)
    //                  ->get();


        //requete pour recuperer l'anime
        $anime = Anime::find($id);
        
        // requete pour recuperer les reviews
        $reviews = Review::join('users', 'fk_user_id', '=', 'users.id')
                         ->where('fk_anime_id', '=', $id)
                         ->get();

        // recupere le nombre de reviews
        $reviewsCount = count($reviews);
        
        // calcule la moyenne des notes
        $moyenne = round($reviews->avg('rating'), 1);

        // fonction pour savoir si l'utilisateur courant a deja ecrit une review 
        $alreadyCommented = ReviewController::AlreadyCommented($id);

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

    // envoi sur le formulaire d'ajout de review d'un anime
    public function getAnime($id) 
    {
        $anime = Anime::find($id);

        // fonction pour savoir si l'utilisateur courant a deja ecrit une review 
        $alreadyCommented = ReviewController::AlreadyCommented($id);

        return view('new_review', ["anime" => $anime, 'alreadyCommented' => $alreadyCommented]);
    }
}
