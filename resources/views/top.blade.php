<x-layout>
    <h1 class="top-h1">TOP DES ANIMES NOTÉ</h1>
    <ul role="list" class="anime-list-top">
      @foreach($animes as $anime)
        <li class="flow">
          <div class="flow">
                <img alt="" src="/covers/{{ $anime->cover }}" />
                <div class="description">
                    <h2>{{ $anime->title }}</h2>
                    <h3>{{ $anime->moyenne }} <hr> 10</h3>
                    <a class="cta" href="/anime/{{ $anime->fk_anime_id }}">Voir</a>
                </div>
                <h2>#{{$i ++}}</h2>
          </div>
        </li>
      @endforeach
    </ul>
  </x-layout>