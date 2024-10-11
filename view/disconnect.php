<?php include 'header.php'; ?>

<main>
    <style>
        /* Style général du conteneur de déconnexion */
        .logout-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logout-container h2 {
            color: #dc3545; /* Rouge principal */
            margin-bottom: 20px;
        }

        .logout-container p {
            color: #343a40;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        /* Style du bouton de déconnexion */
        .logout-container form input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #d30c1f; /* Rouge principal pour le bouton */
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
        }

        .logout-container form input[type="submit"]:hover {
            background-color: #9d0d1c; /* Rouge plus foncé au hover */
        }
    </style>

    <?php if (isset($data['isDisconnected'])) { ?>
    <div class="message-container">
        <h2>Déconnexion</h2>
        <p>Vous avez été déconnecté avec succès. Vous allez être redirigé vers la page de connexion dans 3 secondes...</p>
    </div>

    <script>
        // Redirection après 3 secondes
        setTimeout(function() {
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

<?php include 'footer.php'; ?>
