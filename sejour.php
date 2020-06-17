<html>
<head>
 <title>Voyage Maroc</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" type="text/css" href="sjr.css">
 <link href="https://fonts.googleapis.com/css2?family=Marck+Script&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
 </head>
 <body>
 <header class="site-header clearfix">
 <nav>
  <div class="logo">
   <h1>Pack & Go</h1>
  </div>
  <div class="menu"> 
  <ul>
    <li><a href="index.html"><i class="fas fa-home" style="font-size:18px;padding-right:8px;"></i> Accueil</a></li>
    <li ><a href="voyageMaroc.php"class="vm"><i class="fas fa-route" style="font-size:18px;padding-right:8px;"></i> Voyage Maroc</a></li>
    <li><a href="inter.html"><i class="fas fa-globe-africa" style="font-size:18px;padding-right:8px;"></i> Voyage International</a></li>
    <li><a href="contact.php"><i class="far fa-envelope"style="font-size:18px;padding-right:8px;"></i> contact Us</a></li>
   </ul>
  </div>
 </nav>
 <section>
 <div class="leftside"> 
   <img src="undraw_destinations_fpv7.SVG">
  </div>
  <div class="rightside"> 
    
  <div id="sjr">
    <p>le séjour d'un client bien précise</p>
    <form  method="post">
    <input type="text" name="nom" placeholder="Nom de client" /><br>
    <input type="submit" id="imput" name="search4" value="Chercher"><br> 
<?php
// Connexion, sélection de la base de données
$dbconn = pg_connect("host=localhost dbname=agence user=project password=12345")
    or die('Connexion impossible : ' . pg_last_error());
if(isset($_POST['search4']))
{
    $nom = $_POST['nom'];
// Exécution de la requête SQL
$query ="SELECT Client.Nom ,Client.Prenom ,Sejour.Debut ,Sejour.NombrePlace,Station.NomStation,Station.Region,Station.Tarif
FROM Station,Sejour,client where nom = '$nom' and Station.IdSejour=Sejour.IdSejour and Sejour.IdSejour=Client.IdSejour  ";
$result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());

// Affichage des résultats en HTML
?>
    </div>
        <div class="table">
            <p>Résultat de votre recherche :</p>
        <?php
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Libère le résultat
pg_free_result($result);

// Ferme la connexion
pg_close($dbconn);
}
?>
</form>
</div>
  
 </section>
</header>
 
 
 </body>
</html>