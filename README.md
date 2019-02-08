# BlogPost
__OpenClassrooms project :__ Create your first blog in PHP  
__Website URL hosted online :__ [Blog Professionnel](https://blogprofessionnel.000webhostapp.com)  
![Blog Post](https://github.com/percevalseb1309/BlogPost/blob/master/public/img/blog_post.jpg)

## Database and email with GMail SMTP server

1. Copy the file `app/config/dev.ini.dist` into `app/config/dev.ini` for development use
or `config/prod.ini.dist` into `config/prod.ini` for production use
2. Enter your database's and GMail's credentials
3. import `db/blog_post.sql` into your MySQL database

## Dependencies

Twig is used as template and Swiftmailer to send emails

To install the defined dependencies for your project, just run the install command.

php composer.phar install or composer install

## Assignment (in french)

__Contexte__

Ça y est vous avez sauté le pas ! Le monde du développement web avec PHP est à portée de main et vous avez besoin de visibilité pour pouvoir convaincre vos futurs employeurs/clients en un seul regard. Vous êtes développeur PHP, il est donc temps de montrer vos talents au travers d’un blog à vos couleurs.

__Description du besoin__

Le projet est donc de développer votre blog professionnel. 

Voici la liste des pages qui devront être accessibles depuis votre site web :  
*	la page d'accueil
*	la page listant l’ensemble des blogs posts
*	la page affichant un blog post
*	la page permettant d’ajouter un blog post
*	la page permettant de modifier un blog post
*	les pages permettant de modifier/supprimer un blog post

Vous développerez une partie administration qui devra être accessible uniquement aux utilisateurs inscrits et validés.

Sur la page d’accueil il faudra présenter les informations suivantes :
*	Votre nom et prénom
*	Une photo et/ou un logo
*	Une phrase d’accroche qui vous ressemble (exemple : “Martin Durand, le développeur qu’il vous faut !”) ;
*	Un menu permettant de naviguer parmi l’ensemble des pages de votre site web ;
*	Un formulaire de contact (à la soumission de ce formulaire, un email avec toutes ces informations vous serons envoyé) 
*	Un lien vers votre CV au format pdf 
*	Et l’ensemble des liens vers les réseaux sociaux où l’on peut vous suivre (Github, LinkedIn, Twitter…)

Sur la page listant tous les blogs posts (du plus récent au plus ancien), il faut afficher les informations suivantes pour chaque blog post :
*	Le titre
*	La date de dernière modification
*	Le châpo
*	Et un lien vers le blog post

Sur la page présentant le détail d’un blog post, il faut afficher les informations suivantes :
*	Le titre
*	Le chapô
*	Le contenu
*	L’auteur
*	La date de dernière mise à jour
*	Le formulaire permettant d’ajouter un commentaire (soumis pour validation)
*	Les listes des commentaires validés et publiés

Sur la page permettant de modifier un blog post, l’utilisateur a la possibilité de modifier les champs titre, chapô, auteur et contenu.

__Contraintes__

Cette fois-ci nous n’utiliserons pas WordPress. Tout sera développé par vos soins. Les seuls lignes de code qui peuvent provenir d’ailleurs seront celles du thème Bootstrap que vous prendrez grand soin de choisir. La présentation, ça compte ! Il est également autorisé d’utiliser une ou plusieurs librairies externes à condition qu’elles soient intégrées grâce à Composer.

Attention, votre blog doit être navigable aisément sur un mobile (Téléphone mobile, phablette, tablette…). C’est indispensable.

Nous vous conseillons vivement d’utiliser un moteur de templating tel que Twig, mais ce n’est pas obligatoire.

__Important :__ Vous vous assurerez qu’il n’y a pas de failles de sécurité (XSS, CRSF, SQL injection, session hijacking, upload possible de script php…).

Votre projet doit être poussé et disponible sur Github. Je vous conseille de travailler avec des pull requests. Dans la mesure où la majorité des communications concernant les projets sur Github se font en anglais, il faut que vos commits soient en anglais.

Vous devrez créer l’ensemble des issues (tickets) correspondant aux tâches que vous aurez à effectuer pour mener à bien le projet.

Veillez à bien valider vos tickets pour vous assurer que ceux-ci couvrent bien toutes les demandes du projet. Donnez une estimation indicative en temps ou en points d’efforts (si la méthodologie agile vous est familière) et tentez de tenir cette estimation.

L’écriture de ces tickets vous permettront de vous accorder sur un vocabulaire commun et Il est fortement apprécié qu’ils soient écrits en anglais !
