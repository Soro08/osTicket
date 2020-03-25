
# La documentation du projet
Il était question de récupérer le projet depuis le github de osticket et ajouter 3 fonctionnalité qui cité ci-dessous.
## Fonctionnalité
* Barre de tâche
* Gestion de couleurs 
* Gestion de l’historique
## Fichier et base de donnée

	Lors de la réalisation, nous avons modifié le contenu de certain fichier ainsi que quelque table de la base de donnée.
### Les fichier modifier
* Tâche 1
   * /upload/include/staff/templates/queue-navigation.tmpl.php
   * /upload/include/staff/templates/queue-savedsearches-nav.tmpl.php
   * /upload/scp/js/scp.js
* Tâche 2
   * /upload/include/staff/templates/queue-tickets.tmpl.php
* Tâche 3
   	* staff/templates/thread-entry.tmpl.php
   	* staff/tempaltes/thread-entries.tmpl.php
   	* staff/templates/thread-entries-preview.tmpl.php

### La base de donnée ( le prefix chez moi c’est ‘ost_’ )
* Tâche 1
  	* ost_queue
* Tâche 2
   	* ost_ticket_status
* Tâche 3
   	* aucune table


## La Réalisation
Pour faire simple il vous suffit de remplacer les fichiers cité plus haut dans votre lab. 
* Tâche 1 

	L'objectif ici était de ramener en une ligne les menu déroulant.
	Les fichiers suivant ont été modifié.
	
	* /upload/include/staff/templates/queue-navigation.tmpl.php
	* /upload/include/staff/templates/queue-savedsearches-nav.tmpl.php
	* /upload/scp/js/scp.js
	
	Il vous suffit de changer ces fichier dans votre lab.
	Ensuite vous devrez modifier la table `ost_queue `
	mettre `le parent_id à 0 pour ( open, Answered, Overdue, My Tickets, et Closed)`

	![alt text](https://github.com/Soro08/osTicket/blob/master/dbstatus.png?raw=true) 

	Enfin vérifier le rendu.
	![alt text](https://github.com/Soro08/osTicket/blob/master/Colorresult.png?raw=true) 

	EN cas de soucis veuillez activer les champs ici. http://127.0.0.1:8888/osTicket/upload/scp/settings.php?t=tickets#queues
	http://127.0.0.1:8888/ -> represente le domaine

	![alt text](https://github.com/Soro08/osTicket/blob/master/imgstatus.png?raw=true) 
	
* Tâche 2

	L'objectif ici était d'ajouter une couleur au statut du ticket.
	Fichier modifié: `/upload/include/staff/templates/queue-tickets.tmpl.php`

	* changer le fichier correspondant dans votre lab.
	
	* Modifier la ligne 268 du fichier.
	
		$stmt = $conn->prepare("SELECT * FROM ost_ticket, ost_ticket_status WHERE ost_ticket.status_id = ost_ticket_status.id AND ticket_id = ?");
		
		Dans la requête de la ligne 268 changer ost_ par votre prefix.
		Ex: si votre préfixe est evox_ alors le résultat sera :
		
		$stmt = $conn->prepare("SELECT * FROM evox_ticket, evox_ticket_status WHERE evox_ticket.status_id = evox_ticket_status.id AND ticket_id = ?");
		
	* Ajouter les couleurs dans la base de donée.
	
		table -> `ost_ticket_status`
		Ajouter la colonne `( colorcode  )` dans la table.
		
		![alt text](https://github.com/Soro08/osTicket/blob/master/colorcolone.png?raw=true) 
		
		L’ajout des couleures se fait comme suite :
		
		name -> nom de la couleure ex: vert
	    state -> open
	    mode  -> 1
	    flags -> 0
	    sort -> position de la couleur ( précédente + 1 )
	    colorcode -> code de la couleur ( voir la liste ci-dessous ) *
	    created -> date aujourd'hui
	    updated -> date aujourd'hui
	    properties -> {"allowreopen":true,"reopenstatus":null,"35":""}
	    
	    ![alt text](https://github.com/Soro08/osTicket/blob/master/imgcolor.png?raw=true) 
		
		La liste des code de couleur:
		
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
		
	
	* Tâche 3
	
	Ici il était question d'ajouter un collapse au liste de message et afficher le dernier.

	Fichier modifié :
	
	staff/templates/thread-entry.tmpl.php
	staff/tempaltes/thread-entries.tmpl.php
	staff/templates/thread-entries-preview.tmpl.php
	
	Remplacer ces trois fichier dans votre lab.







