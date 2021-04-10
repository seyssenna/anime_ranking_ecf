<x-layout>
  <x-slot name="title">
    Nouvelle critique de [nom de l'anime]
  </x-slot>

 {{-- page accessible uniquement par les utilisateurs connecté --}}
 {{-- et qui n'ont pas encore commenté cet anime               --}}

 @if (Auth::user() && ($alreadyCommented === 0))
 
    <h1>Nouvelle Critique de {{ $anime->title }} </h1>

    <form action="/add_review" method="POST">
      @csrf

        <label for="rates_select">Notez cet anime sur 10</label>
        <select name="rate" id="rates_select" required>
            <option value="0">0 /10</option>
            <option value="1">1 /10</option>
            <option value="2">2 /10</option>
            <option value="3">3 /10</option>
            <option value="4">4 /10</option>
            <option value="5">5 /10</option>
            <option value="6">6 /10</option>
            <option value="7">7 /10</option>
            <option value="8">8 /10</option>
            <option value="9">9 /10</option>
            <option value="10">10 /10</option>  
        </select>

        <label for="review_comment">Dites-nous ce que vous avez pensé de {{ $anime->title }} ?</label>
        <textarea name="comment" id="review_comment" cols="100" rows="7" required></textarea>

        <input type="hidden" name="anime_id" value="{{ $anime->id }}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        
        <button>Ajouter la critique</button>
    </form>
 @else
     <h1>Bien tenté mais non! petit malin...</h1>
 @endif
     
 
  



</x-layout>
