<?php include_once 'header.php'; ?>
<head>
    <title>POC - SchejV2</title>
    <link href="/src/style/disconnect.css" rel="stylesheet" type="text/css">
</head>
<main>

    <?php if (isset($data['isDisconnected'])) { ?>
        <div class="message-container">
            <h2>Déconnexion</h2>
            <p>Vous avez été déconnecté avec succès. Vous allez être redirigé vers la page d'accueil dans 3
                secondes...</p>
        </div>

        <script>
            // Redirection après 3 secondes
            setTimeout(function () {
                window.location.href = "/"; // URL de redirection
            }, 3000); // 3000 millisecondes = 3 secondes
        </script>
    <?php } ?>


    <div class="logout-container">
        <h2>Déconnexion</h2>
        <p>Êtes-vous sûr de vouloir vous déconnecter ?</p>

        <!-- Formulaire de confirmation de déconnexion -->
        <form action="/disconnect" method="POST">
            <input type="submit" value="Se déconnecter">
        </form>
    </div>
</main>

<?php include_once 'footer.php'; ?>
