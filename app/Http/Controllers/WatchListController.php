<?php

namespace App\Http\Controllers;

use App\Models\Watchlist;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WatchlistController extends Controller
{
    public function goToWatchlist()
    {
        $animes = Watchlist::join('animes', 'fk_anime_id', '=', 'animes.id')
                           ->where('fk_user_id', '=', Auth::id())
                           ->get();
        // dd($animes);
        return view('watchlist', ['animes' => $animes]);
    }

    // fonction qui ajoute un anime a la watchlist
    public function addToWatchlist($id)
    {
        // requete pour verifier si un anime est deja(ou pas) dans la watchlist de l'utilisateur courant
        $query = Watchlist::where('fk_user_id', '=', Auth::id())
                         ->where('fk_anime_id', '=', $id)
                         ->get();
        $alreadyInWatchlist = count($query);  

        // si l'anime n'est pas present dans la watclist alors on l'ajoute
        if ($alreadyInWatchlist === 0) {
            $watchlist = new Watchlist();
            $watchlist->fk_user_id = Auth::id();
            $watchlist->fk_anime_id = $id;
            $watchlist->save();
        } 
        return redirect()->route('getAnime', [$id]);    
    }

    // fonction qui retire un anime de la watchlist
    public function removeFromWatchlist($id)
    {
        Watchlist::where('fk_user_id', '=', Auth::id())
                         ->where('fk_anime_id', '=', $id)
                         ->delete();
        return redirect()->route('getAnime', [$id]);
    }
}
