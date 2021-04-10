<x-layout>
    <x-slot name="title">
      modification critique de {{ $review[0]->title }}
    </x-slot>
   
    {{-- protection anti-kim... juste au cas ou... --}}
    @if (Auth::user() && ($alreadyCommented === 1))

        <h1>Modifiez votre Critique de {{ $review[0]->title }} </h1>
  
        <form action="/edit_review" method="POST">
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
      
            <label for="review_comment">Dites-nous ce que vous avez pensé de {{ $review[0]->title }} ?</label>
            <textarea name="comment" id="review_comment" cols="100" rows="7" required>{{$review[0]->comment}}</textarea>
      
            <input type="hidden" name="anime_id" value="{{ $review[0]->id }}">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            
            <button>Modifier la critique</button>
        </form>
    @else
        <h1>NOPE!</h1>
    @endif
    
  
  
  </x-layout>