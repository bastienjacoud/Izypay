#README
Réalisé par Bastien Jacoud

Ce projet contient à la fois la réponse à l'exerice principal et la réponse à la question bonus. 
L'interface e été réalisée grâce à l'utilisation du framework Laravel 5.5. 
La réalisation de cet exercice correspond aux normes du modèle MVC. Les vues sont stockées dans le répertoire
"resources/views", le modèle dans le répertoire "App/Models" et les controlleurs dans le répertoire
"app/Http/Controllers". 

Sur le site web, la première page correspond à la page d'accueil, puis il existe deux onglets permettant d'afficher 
la réponse à l'exercice principal et celle de l'exercice bonus. 

##L'exercice principal
Lors du clic sur l'onglet "Affichage", correspondant à l'exercice principal, le site redirige l'utilisateur
sur un formulaire permettant de sélectionner le fichier de données de l'exercice principal. 
Il est possible d'ajouter un nouveau fichier en sélectionnant "choisir un fichier". Ce dernier sera alors sauvegardé 
en local et affiché directement lors de la prochaine utilisation du formulaire. 
Il est également possible de ne sélectionner que les transactions pour lesquelles le statut vaut 1, simplement en 
cochant la checkbox adéquat.  

Ce formulaire renvoie l'utilisateur sur une autre vue, affichant la réponse à l'exercice principal, en fonction 
du fichier sélectionné. 

Par défaut, le seul fichier correspondant à l'exercice principal enregistré en local sera le fichier contenant l'objet json que vous nous avez
transmis.

##La question bonus
Lors du clic sur l'onglet "Bonus", correspondant à l'exerice bonus, le site redirige sur le même type de formulaire que 
celui de la question principale. L'utilisateur peut également chosir le fichier de données qu'il veut tester. Le formulaire 
nous redirige alors vers la page affichant les résultats de la question bonus, ou nous indique que l'on doit sélectionner 
un fichier. 

Une fois le formulaire soumis, l'utilisateur à accès à la réponse à la question bonus et peut, s'il le souhaite, 
télécharger un fichier contenant cette réponse. 

Par défaut, le seul fichier correspondant à la question bonus enregistré en local sera le fichier contenant l'objet json que vous nous avez transmis.