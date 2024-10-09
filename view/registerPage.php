<?php include 'header.php'; ?>

<main>
    <style>
        /* Style général du formulaire */
        .signup-container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #f8f9fa;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .signup-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1c712e; /* Vert foncé */
        }

        /* Style des champs de formulaire */
        .signup-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #343a40;
        }

        .signup-container input[type="text"],
        .signup-container input[type="password"],
        .signup-container input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }

        .signup-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #1c712e; /* Vert foncé pour le bouton */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
        }

        .signup-container input[type="submit"]:hover {
            background-color: #218838; /* Vert plus clair au hover */
        }

        /* Style pour les erreurs ou messages */
        .signup-container p.error {
            color: red;
            text-align: center;
            font-size: 0.9rem;
        }

        .signup-container p.success {
            color: green;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>

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
