
<?php
session_start();

?>
<!DOCTYPE html>
    <html>
        <head>
            <title> Formulaire de demande </title>
            <meta charset = "utf-8">
            <link rel = "stylesheet" href = "Demande.css">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Elms+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        </head>
        <body class = "elms-sans-text">
            <h1> Vous souhaitez soumettre une nouvelle demande ! </h1> <br>
            <div class = "formulaire">
                <div class = "contenu">
                    <h2> Remplisser le formulaire suivant : </h2>
                    <form action = "Demande.php" method = "post">
                        <div class = "survey">
                            <label for = "nom_article"> Nom de l'article  : </label> <br>
                            <input type = "text" id = "nom_article" name = "nom_article" required = "required"> <br>
                            <label for = "date_debut"> Date début  : </label> <br>
                            <input type = "date" id = "date_debut" name = "date_debut" required = "required"> <br>
                            <label for = "date_retour"> Date retour : </label> <br>
                            <input type = "date" id = "date_retour" name = "date_retour" required = "required"> <br>
                            <label for = "raison_emprunt"> Raison derrière l'emprunt : </label> <br> 
                            <textarea id = "raison_emprunt" name = "raison_emprunt" required = "required"></textarea> <br>
                        </div>
                        <input type = "submit" name = "submit" value = "Valider"> <br>
                    </form>
                </div>
            </div>
            <footer>
                <p> Revenir à la page <a href = "Home.html"> d'acceuil</a> </p>
            </footer>
        </body>
</html>
<?php 
include("Connexion_DB.php");
if (isset($_POST["submit"])) {
    $_Article = filter_input(INPUT_POST, "nom_article", FILTER_SANITIZE_SPECIAL_CHARS);  
    $_date_debut = $_POST["date_debut"]; 
    $_date_retour = $_POST["date_retour"]; 
    $_Raison = filter_input(INPUT_POST, "raison_emprunt", FILTER_SANITIZE_SPECIAL_CHARS); 
    $sql = "INSERT INTO emprunt (Date_debut, Date_fin_prevue, Raison_Emprunt) VALUES ('$_date_debut', '$_date_retour', '$_Raison')";  
    if(mysqli_query($conn, $sql)) {
        $id_emprunt = mysqli_insert_id($conn); /*retourne l'id de l'emprunt qui vient d'être créé à la ligne précédente*/
    }
    else {
        echo "Modification de la base de donnée impossible"; 
    } 
    $_chercheur = "SELECT ID_Modele from modele WHERE Reference = '$_Article'"; 
    $id_Modele = mysqli_query($conn,$_chercheur); 
    
}
?>
