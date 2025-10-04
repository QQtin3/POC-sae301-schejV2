<?php include_once 'header.php'; ?>
<head>
    <title>POC - SchejV2</title>
    <link href="/src/style/loginPage.css" rel="stylesheet" type="text/css">
</head>
<main>
    <div class="login-container">
        <h2>Connexion</h2>

        <!-- Affichage du message d'erreur si présent -->
        <?php if (isset($data['message'])): ?>
            <p class="error"><?= htmlspecialchars($data['message']); ?></p>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form action="/connect" method="POST">
            <!-- Champ Username -->
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required placeholder="Votre nom d'utilisateur">

            <!-- Champ Mot de passe -->
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required placeholder="Votre mot de passe">

            <!-- Bouton de soumission -->
            <input type="submit" value="Se connecter">
        </form>
    </div>
</main>

<?php include_once 'footer.php'; ?>
