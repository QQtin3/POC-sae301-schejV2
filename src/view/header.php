<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/style/header.css" rel="stylesheet" type="text/css">
    <title></title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <li><a href="/search">Rechercher un événement</a></li>
            <?php if (isset($_SESSION['user'])) { ?> <!-- Ne pas afficher les boutons si le user n'est pas connecté -->
                <li><a href="/create">Créer un événement</a></li>
                <li><a href="/disconnect">Déconnexion</a></li>
            <?php } ?>
            <?php if (!isset($_SESSION['user'])) { ?>  <!-- Ne pas afficher les boutons si le user est connecté-->
                <li><a href="/connect">Connexion</a></li>
                <li><a href="/register">Création de compte</a></li>
            <?php } ?>
        </ul>
    </nav>
</header>
