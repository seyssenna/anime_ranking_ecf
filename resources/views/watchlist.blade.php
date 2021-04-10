<x-layout>
    
    <h1 class="top-h1">MA WATCH-LIST</h1>

    @if (Auth::user())
        <ul role="list" class="anime-list-top">
            @foreach($animes as $anime)
                <li class="flow">
                    <div class="flow">
                        <img alt="" src="/covers/{{ $anime->cover }}" />
                        <div class="description">
                            <h2>{{ $anime->title }}</h2>
                            <p>{{ $anime->description }} </p>
                            <a class="cta" href="/anime/{{ $anime->fk_anime_id }}">Voir</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <h3 style="text-align:center">Hehe! <br> vous devez vous connecter pour acceder a votre Watchlist</h3>
    @endif
        
    

  </x-layout>