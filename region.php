<html>
<head>
 <title>Voyage Maroc</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" type="text/css" href="region.css">
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
    
  <div id="rgn">
       <form  method="POST" id="myform">
       <p> Les stations situées dans les régions</p>
       <input type="text" name="region" placeholder="Region"><br>
       <input type="submit" name="search1" id="imput"  value="chercher"><br>
      
       <?php
// Connexion, sélection de la base de données
$dbconn = pg_connect("host=localhost dbname=agence user=project password=12345")
    or die('Connexion impossible : ' . pg_last_error());
if(isset($_POST['search1']))
{
$region = $_POST['region'];
// Exécution de la requête SQL
$query ="SELECT DISTINCT region ,NomStation , Capacite ,Tarif FROM Station WHERE Region = '$region' ";
$result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());

// Affichage des résultats en HTML
?>
</div>
<div class="table">
    <p>Résultat de votre recherche :</p>
<?php
echo "<table>\n";
echo "\t\t<th>region</th>\n";
echo "\t\t<th>la station</th>\n";
echo "\t\t<th>capacite</th>\n";
echo "\t\t<th>tarif</th>\n";
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