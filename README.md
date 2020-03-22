# osTicket
# Project osTicket for evox

## opt 1. Barre de tâche

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

## opt 2. Gestion des couleurs
   L'objectif ici etait d'ajouter une couleur au statut du ticket.
   FIchier, code et bd
   ```bash
    modification du fichier staff/templates/queue-tickets.tmpl.php  Ligne 245—->293
    
    Pour ajouter une nouvelle couleur, proceder comme suite:
    
    1. Insertion dans la bd
    
	    Base de donnée:
	    
	    table -> ost_ticket_status
	    colones:
	    
	    name -> nom de la couleure ex: vert
	    state -> open
	    mode  -> 1
	    flags -> 0
	    colorcode -> code de la couleur ( voir la liste ci-dessous )
	    created -> dateaujourd'hui
	    updated -> dateaujourd'hui
	    properties -> {"allowreopen":true,"reopenstatus":null,"35":""}

	- Noir                  : #000000
	- Gris                  : #808080
	- Marron                : #800000
	- Vert                  : #008000
	- Orange                : #FF7F00
	- Rose                  : #FD6C9E
	- Rouge                 : #FF0000
	- Bleu claire           : #0000FF
	- Bleu foncé            : #000080
	- Jaune                 : #FFFF00
	- Violet                : #FF00FF
	- Supprimer la couleur  : #FFFFFF
	
    2. Changer le nom de la table ost_ticket
    	ligen 268:
	$stmt = $conn->prepare("SELECT * FROM ost_ticket, ost_ticket_status WHERE ost_ticket.status_id = ost_ticket_status.id AND ticket_id = ?"); // Remplacer ost_ par votre prefix ex: evox_ ce qui va donner evox_ticket et evox_ticket_status
       
    3. Trouver la ligne correspondat:
    
    	DEBUT:
	
	foreach ($tickets as $T) {
	    echo '<tr>';
	    if ($canManageTickets) { ?>

    
 	FIN
	    <td style="background-color: <?= $ibcolor ?>;"><input type="checkbox" class="ckb" name="tids[]"
		    value="<?php echo $ibtckid; ?>" /></td> <?php } ?>
		    
	inserer le code de la ligne 248 à 289 entre le debut et la fin
	
	

    ```
    
    
## opt 3. Gestion de l’historique

  Ici il était question d'ajouter un collapse au liste et afficher le dernié:
  
  ```bash
  
  modification du fichier staff/templates/thread-entry.tmpl.php
	
  # Class sorocollapsible
  # style="cursor: pointer;"

  modification du fichier staff/tempaltes/thread-entries.tmpl.php	
  staff/templates/thread-entries-preview.tmpl.php
  # code js. — thread-entries.tmpl.php

  

```
