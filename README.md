# osTicket
# Project osTicket for evox

opt 1. Barre de tâche

  L'objectif ici était de ramener en une ligne les menu deroulant.
  Le fichier et code ajouté:
  ```bash
  1. Mettre le parent_id à 0 dans la table ost_queue

    Table: ost_queue  in db

  2. modification de fichier pour annuler l'affichage du sous menu

    upload/include/staff/templates/queue-navigation-tmpl-open.php. (update code)

  3. Pour masquer le menu search

    commenter le code dans le fichier suivant -> ( staff/templates/queue-savedsearches-nav.tmpl.php )

  4. Afficher les valeur dans le menu :
   - modification du fichier upload/include/staff/templates/queue-navigation-tmpl-open.php.
   - modification du fichier upload/scp/js/scp.js. line 524 :
        commenter la ligne 527 et la ligne. 541
```

opt 2. Gestion des couleurs
   L'objectif ici etait d'ajouter une couleur au statut du ticket.
   FIchier, code et bd
   
   ```bash
    modification du fichier staff/templates/queue-tickets.tmpl.php  Ligne 245—->273

    Base de donnée:
    table -> ost_ticket_status
    colones:
    name -> nom de la couleure:
    state -> open
    mode  -> 1
    properties -> {"allowreopen":true,"reopenstatus":null,"35":""}
    
    La couleure sera à sont tours gerer dans le code de la ligne 245—->273 dans le fichier staff/templates/queue-tickets.tmpl.php ```
    

