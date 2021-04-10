<x-layout>
  <x-slot name="title">
    {{ $anime->title }}
  </x-slot>

  <article class="anime">
    <header class="anime--header">
      <div>
        <img alt="" src="/covers/{{ $anime->cover }}" />
      </div>
      <h1>{{ $anime->title }}</h1>
      <h3>{{ $moyenne }}/10</h3>
    </header>
    <p>{{ $anime->description }}</p>
    <div>
      <div class="actions">
        <div>
          @if (Auth::user() && ($alreadyCommented === 0))
            <a class="cta" href="/anime/{{ $anime->id }}/new_review">Écrire une critique</a>
          @elseif (Auth::user() && ($alreadyCommented !== 0)) 
            <a class="cta" href="/add_review_error/{{ $anime->id }}">Écrire une critique</a>
          @else
            <a class="cta" href="/login">Écrire une critique</a>
          @endif
        </div>
        @if (Auth::user() && ($alreadyInWatchlist === 0))
            <form action="/anime/{{ $anime->id }}/add_to_watch_list" method="POST">
              @csrf
              <button class="cta">Ajouter à ma watchlist</button>
            </form>
        @elseif (Auth::user() && ($alreadyInWatchlist !== 0))
            <form action="/anime/{{ $anime->id }}/remove_from_watch_list" method="POST">
              @csrf
              <button class="cta">Retirer de ma watchlist</button>
            </form>
        @else
            <a class="cta" href="/login">Ajouter à ma watchlist</a>
        @endif
        
      </div>
    </div>

    <h3>Il y a {{ $reviewsCount }} commentaires</h3>
      @foreach ($reviews as $item)
          <div class="review-container-top">
            <h2 class="review">{{$item->username}}</h2>
            <span>{{$item->updated_at}}</span>
          </div>
          <div class="review-container" >  
              <h3>{{$item->rating}}/10</h3>
              <p>{{$item->comment}}</p>
          </div>
      @endforeach

  </article>
</x-layout>
