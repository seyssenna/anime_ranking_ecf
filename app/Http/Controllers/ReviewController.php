<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // fonction pour savoir combien de critiques on été écrite sur un anime($id) par l'utilisateur courant
    public static function AlreadyCommented($id)
    {
         $query = Review::where('fk_user_id', '=', Auth::id())
                        ->where('fk_anime_id', '=', $id)
                        ->get();
         // contient le nombre de critique de l'utilisateur connecté sur l'anime affiché
         return count($query);
    }



    // fonction qui gere l'ajout d'une review
    public function addReview(Request $request)
    {
        $validatedData = $request->validate(["rate"     => "required",
                                             "comment"  => "required",
                                             "anime_id" => "required",
                                             "user_id"  => "required"]);
        $review = new Review();
        $review->rating      = $validatedData["rate"];
        $review->comment     = $validatedData["comment"];
        $review->fk_user_id  = $validatedData["user_id"];
        $review->fk_anime_id = $validatedData["anime_id"];
        $review->save();

        return redirect()->route('getAnime', [$validatedData["anime_id"]]);
    }

    // fonction qui envoie sur une page d'erreur si l'utilisateur a deja ajouté une critique
    public function goToAddReviewError($id)
    {
        $alreadyCommented = $this->AlreadyCommented($id);
        
        return view('errors/add_review_error', ['id' => $id, 'alreadyCommented' => $alreadyCommented]);
    }

    // fonction qui envoie sur un formulaire de modification d'une critique deja posté
    public function goToeditReviewForm($id)
    {
        $review = Review::join('animes', 'fk_anime_id', '=', 'animes.id')
                        ->where('fk_anime_id', '=', $id)
                        ->where('fk_user_id', '=', Auth::id())
                        ->get();

        $alreadyCommented = $this->AlreadyCommented($id);

        return view('edit_review', ['review' => $review, 'alreadyCommented' => $alreadyCommented]);
    }

    // fonction qui modifie une critique deja posté
    public function editReview(Request $request)
    {
        $validatedData = $request->validate(["rate"     => "required",
                                             "comment"  => "required",
                                             "anime_id" => "required",
                                             "user_id"  => "required"]);
                                            
        Review::where('fk_user_id', '=', $validatedData['user_id'])
              ->where('fk_anime_id', '=', $validatedData['anime_id'])
              ->update(['comment' => $validatedData['comment'], 'rating' => $validatedData['rate']]);
        
        return redirect()->route('getAnime', [$validatedData["anime_id"]]);
    }
}
