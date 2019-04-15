Projet sous Symfony 4.2.4

Procédure de récupération du projet : 

    Cloner https://github.com/Sancti0n/mangabdd.git
    MangaBDD->install
    Créer la base de donnée : bin\console doctrine:database:create
    Récupérer la base de donnée : bin\console doctrine:migrations:migrate
    Télécharger les fixtures : bin\console doctrine:fixtures:load

C'est un système basique de gestion de livres :
    $builder
        ->add('title')
        ->add('format')
        ->add('isbn10')
        ->add('isbn13')
        ->add('ntitle')
        ->add('description')
        ->add('rightholderPublisher')
        ->add('publisher')
        ->add('author')
        ->add('artist')
        ->add('language')
        ->add('legalDeposit')
    ;

Interface membres, administrateurs, super administrateurs.
Un système de news/articles pour les administrateurs et super administrateurs.