# ECF mathieu millet

## anime ranking

j'ai pu faire tout ce qui etait demandé. 
j'ai commencé par reorganiser le code fourni et departager tout ca dans des controllers et des models.
j'ai ensuite passer un peu de temps sur la creation des autres tables et bien evidement, les ```foreign key``` m'ont posé quelques problemes, 
jusqu'a ce que je decide de jetter un oeil aux fameuses migrations evoqué dans le brief en lisant la doc... 
10 minutes plus tard j'avais mes tables toutes belles et bien faites. 
je met un pouce en l'air a la doc de laravel! tres bien faite je trouve (exemple moyen parfois).
j'ai esuite debuté le travail.

j'ai logiquement travailler sur les users stories dans l'ordre en fonction de leurs importances.
ce n'etait pas precisé donc j'ai fait le choix de rendre obligatoire l'ajout d'une note en meme temps que l'ajout d'une review.
j'ai donc travailler sur ces deux users stories en meme temps.
j'ai ensuite travailler les autres users stories etc...
je n'ai pas reelement eu de difficulté en general(je n'ai pas dit que c'etait facile non plus). 
les moments de blocage etait vite reglé en lisant un peu la doc.

sauf pour la requete pour recuperer les animes en fonction de leurs moyennes pour la page top. 
j'y ai passé pas mal de temps sans reussir a faire la requete (j'avais surement plus les yeux en face des trous)
frustré, je decide de demander de l'aide. Thierry, sachant que je ne copierais pas betement, me montre son code que j'ai pas vraiment compris, 
mais ma foi, ca marche.
pas satisfait du tout de pas avoir trouvé moi meme, je decide de continuer me recherches. 
pour me remetre les idées a zero, je dessine sur un bout de papier la table que je souhaite recuperer. de la, j'arrive a une requete potable en SQL pure.
et de fil en eguille, a une requete en eloquent, a peu de chose pres, la meme que Thierry. mais au moins la, je la comprend a 100%.
le ```DB::raw()``` m'a donné beaucoup de mal, j'avoue que si je ne l'avais pas vu sur le code de Thierry j'aurais pu passer encore pas mal d'heures a trouver.
il m'as juste fallu lire la doc et un peu de stackOverflow pour le comprendre.
j'ai laissé les deux requetes SQL et Eloquent avec quelques commentaires dans le ```topController.php```

- il etait demander d'envoyer sur le formulaire de login quand un utilisateur pas connecté clique sur "watchlist", 
  j'ai a la place decider de ne pas le rendre visible (traitement dans la vue). 
  je me rend compte a l'heure ou je redige ce document (le 11 au soir) que j'aurais en fait juste du suivre ce qui etait demander.

- si un utilisateur connecté clique sur "ajouter une critique" sur un anime ou il a deja ajouté une critique, je le redirige sur une page d'erreur
  qui lui permet de modifier ca precedente critique s'il le souhaite.
  
- quand un utilisateur connecté clique sur le bouton "ajouter a ma watchlist" cela l'ajoute correctement 
  et le bouton se transforme en "retirer de ma watchlist" (traitement dans la vue).   


je suis allé au plus simple pour ce projet. zero Js et tres tres peu de css...
au niveau des bonus je n'ai pu faire que la modification d'une critiques et la full utilisation d'eloquent.
j'ai trouver ce projet assez lourd, j'ai du coup pas été motivé pour les autres bonus.

je tiens a preciser que j'ai tres bien compris le MVC et chaque ligne de code que j'ai ajouter, rien n'a ete mysterieux ou du moins, ne l'est plus.
j'ai aussi bien aimé l'utilisation de laravel.

