<x-layout>
    <x-slot name="title">
      Page d'érreur
    </x-slot>
  
    @if (Auth::user() && ($alreadyCommented === 1))
      <h1>Vous ne pouvez pas écrire de nouvelles critiques si vous l'avez déjà fait.</h1>
      <h3>Vous pouvez modifer modifier une ancienne critique. </h3>

      <div class="actions" style='margin:1em'>

        <form style='display:inline' action="/anime/{{ $id }}/edit_review" method="POST">
          @csrf
          <button style='margin:1em' class="cta">Modifier une critique</button>
        </form> 

        <a class="cta" style='margin:1em' href="/">Retourner a l'accueil</a>

      </div>        
    @else
        <h1>DOMMAGE... essaye encore (^_^)</h1>
    @endif



   
  </x-layout>