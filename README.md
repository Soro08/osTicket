
# La documentation du projet
Il était question de récupérer le projet depuis le github de osticket et ajouter 3 fonctionnalité cité ci-dessous.
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
   * /upload/include/staff/templates/tickets-actions.tmpl.php
   * /upload/scp/aaapostcolors.php (nouveau fichier)
* Tâche 3
   	* staff/templates/thread-entry.tmpl.php
   	* staff/tempaltes/thread-entries.tmpl.php
   	* staff/templates/thread-entries-preview.tmpl.php

### La base de donnée ( le prefix chez moi c’est ‘ost_’ )
* Tâche 1
  	* ost_queue
* Tâche 2
	* ost_ticket
	* ost_colors (nouvelle table)
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
	
	- Supprimer ou commentez le contenu du fichier /upload/include/staff/templates/queue-savedsearches-nav.tmpl.php

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
	Fichier modifié: 
		- /upload/include/staff/templates/queue-tickets.tmpl.php

		- /upload/include/staff/templates/tickets-actions.tmpl.php

   		- /upload/scp/aaapostcolors.php (nouveau fichier)
	
	* Créer un nouveau fichier aaapostcolors.php dans le dossier /upload/scp/ 

		Vous trouverez [ici](https://github.com/Soro08/osTicket/blob/master/upload/scp/aaapostcolors.php) le contenu du fichier 
	
	* Créer ensuite une nouvelle table (ost_colors : remplacer ost_ par votre prefix. Si votre prefix est evox_ alors on aura evox_colors) .
	
		Avec les colones suivantes:
		- id  : int primary key  -> la clé primaire
		- color : varchar(200)   ->  le nom de la couleur (ex: Rouge)
		- code : varchar(200)    -> le code de la couleur (ex: #FF0000)
		
		![table color](https://raw.githubusercontent.com/Soro08/osTicket/master/img/tablecolor.png) 
	* Ajouter la colone `colors_id` à la table `ost_ticket` 

		Caracteristique de la colone type : Int(11), Une clé etranger de ost_colors
		
		![table ticket colorid](https://raw.githubusercontent.com/Soro08/osTicket/master/img/ticketcolorid.png) 

	* changer les fichiers suivant dans votre lab

		- /upload/include/staff/templates/queue-tickets.tmpl.php

		- /upload/include/staff/templates/tickets-actions.tmpl.php
	
	* Modifier la ligne 270 du fichier /upload/include/staff/templates/queue-tickets.tmpl.php.
		```
		$stmt = $conn->prepare("SELECT * FROM ost_ticket, ost_colors WHERE ost_ticket.colors_id = ost_colors.id AND ticket_id = ?");
		
		Dans la requête de la ligne 268 changer ost_ par votre prefix.
		Ex: si votre préfixe est evox_ alors le résultat sera :
		
		$stmt = $conn->prepare("SELECT * FROM evox_ticket, evox_colors WHERE evox_ticket.colors_id = evox_colors.id AND ticket_id = ?");```

	* Modifier la ligne 29 du fichier /upload/include/staff/templates/tickets-actions.tmpl.php

		`$stmt = $conn->prepare("SELECT * FROM ost_colors");`

		changer simplement ost_ par votre prefix
	
	* Modifier la ligne 36 du fichier /upload/scp/aaapostcolors.php

		`$sql = "UPDATE ost_ticket SET colors_id=? WHERE ticket_id=?";`

		changer ost_ par votre prefix
		
	
	* Remplir ensuite la table des couleur ( ost_colors -> ne pas oublier le prefix ) avec vos couleur
	
		- color  ->  le nom de la couleur (ex: Rouge)
		- code   -> le code de la couleur (ex: #FF0000)

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
		
	* Resultat
	
	![result color](https://raw.githubusercontent.com/Soro08/osTicket/master/img/colorresult.png) 
	
		
	
* Tâche 3
	
	Ici il était question d'ajouter un collapse au liste de message et afficher le dernier.

	Fichier modifié :
	
	staff/templates/thread-entry.tmpl.php
	staff/tempaltes/thread-entries.tmpl.php
	staff/templates/thread-entries-preview.tmpl.php
	
	Remplacer ces trois fichier dans votre lab.












=============================================.  MISE A JOURS   .===========================================================


1. Correction bug menu 

    dans la base de donnée, la table `ost_queue`, modifier la colone `config` pour les lignes:  `Answered` et `Overdue` 
    
    - Ligne `Open`(Le 2 ème): `{"criteria":[["isanswered","nset",null],["status__state","includes",{"open":"Open"}]],"conditions":[]}` 
    

    - Ligne `Answerd` : `{"criteria":[["isanswered","set",null],["status__state","includes",{"open":"Open"}],["isoverdue","nset",null]],"conditions":[]}` 
    
    
    - Ligne `Overdue` : `{"criteria":[["isoverdue","set",null],["status__state","includes",{"open":"Open"}]],"conditions":[]}

   

3. Ajout de Coleur dans la page détail


* Ajout de couleur dans la page detail du ticket

	L'objectif içi était de donner la possibilité de modifier la cours du ticket dans la page detail du ticket.
	
	Fichier modifié :

	- staff/ticket-view.inc.php	
	
	Modifier ce fichier dans votre lab et éffectuer la modification suivante:
	ligne 363
	$stmt = $conn->prepare("SELECT * FROM ost_ticket, ost_colors WHERE ost_ticket.colors_id = ost_colors.id AND ticket_id = ?");
remplacer ost_ par votre prefix
