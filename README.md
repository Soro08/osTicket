
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

	voir image 

	Enfin vérifier le rendu.
	voir image

	EN cas de soucis veuillez activer les champs ici. http://127.0.0.1:8888/osTicket/upload/scp/settings.php?t=tickets#queues
	http://127.0.0.1:8888/ -> represente le domaine

	voir image
	

