<?php include 'header.php'; ?>
<head>
    <title>POC - SchejV2</title>
    <link href="/src/style/registerPage.css" rel="stylesheet" type="text/css">
</head>
<main>
    <div class="signup-container">
        <h2>Créer un Compte</h2>

        <!-- Affichage des messages d'erreur ou de succès -->
        <?php if (isset($data['message'])): ?>
            <p class="error"><?= $data['message']; ?></p>
        <?php endif; ?>

        <?php if (isset($data['username'])): ?>
            <p class="success">Compte créé avec succès, bienvenue <?= htmlspecialchars($data['username']); ?> !</p>
        <?php endif; ?>

        <!-- Formulaire de création de compte -->
        <form action="/register" method="POST">
            <!-- Champ Nom d'utilisateur -->
            <label for="username">Nom d'utilisateur</label>
            <input type="text" id="username" name="username" required placeholder="Votre nom d'utilisateur">

            <!-- Champ Mot de passe -->
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required placeholder="Votre mot de passe">

            <!-- Champ Confirmation de mot de passe -->
            <label for="confirm_password">Confirmer le mot de passe</label>
            <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirmez votre mot de passe">

            <!-- Bouton de soumission -->
            <input type="submit" value="Créer un compte">
        </form>
    </div>
</main>

<?php include 'footer.php'; ?>
