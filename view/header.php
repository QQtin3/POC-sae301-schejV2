<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sport Track</title>
    <style>
        /* Style général */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Style du header */
        header {
            background-color: #218838;
            padding: 10px 0;
            box-shadow: 0 4px 2px -2px gray;
        }

        /* Style de la barre de navigation */
        nav {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #1c712e; /* Vert plus sombre pour le hover */
        }
    </style>
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <li><a href="/create">Créer un planning</a></li>
            <li><a href="/list">Voir vos plannings</a></li>
            <?php if (isset($_SESSION['user'])) { ?>
                <li><a href="/disconnect">Déconnexion</a></li>
            <?php }; ?>
            <?php if (!isset($_SESSION['user'])) { ?>
            <li><a href="/connect">Connexion</a></li>
            <li><a href="/register">Création de compte</a></li>
            <?php }; ?>
        </ul>
    </nav>
</header>
