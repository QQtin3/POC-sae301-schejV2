<?php include 'header.php'; ?>

<main>
    <style>
        /* Style général du formulaire */
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #28a745; /* Vert principal */
        }

        /* Style des champs de formulaire */
        .login-container label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #343a40;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
        }

        .login-container input[type="submit"]:hover {
            background-color: #218838; /* Vert plus foncé pour le hover */
        }

        /* Style pour les erreurs ou messages */
        .login-container p.error {
            color: red;
            text-align: center;
            font-size: 0.9rem;
        }
    </style>

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

<?php include 'footer.php'; ?>
