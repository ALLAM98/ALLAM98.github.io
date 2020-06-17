<html>
<head>
 <title>Voyage Maroc</title>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" type="text/css" href="client.css">
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
    
  <div id="tod">
 <p>Le total dépensé par chaque client en séjour</p>
<form method="post">
    <input type="text" name="nom" placeholder="Nom de client" /><br>
    <input type="submit"id="imput" name="search" value="Chercher"><br>
<?php
$dbconn = pg_connect("host=localhost dbname=agence user=project password=12345")
or die('Connexion impossible : ' . pg_last_error());

if(isset($_POST['search']))
{
    $nom = $_POST['nom'];
    $requete = "SELECT nom,prix,tarif,(propose.prix + station.tarif) as total FROM client,station,sejour,propose where nom = '$nom' and client.idsejour = station.idsejour and station.idstation = propose.idstation and station.idsejour = sejour.idsejour ";
    $resultat = pg_query($dbconn,$requete);

    ?>
        </div>
        <div class="table">
            <p>Résultat de votre recherche :</p>
        <?php
    
    echo "<table>\n";
    echo "\t\t<th>nom de client</th>\n";
    echo "\t\t<th>prix</th>\n";
    echo "\t\t<th>tarif</th>\n";
    echo "\t\t<th>total </th>\n";
    while ($line = pg_fetch_array($resultat, null, PGSQL_ASSOC)) {
        echo "\t<tr>\n";
        foreach ($line as $col_value) {
            echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
    }
    echo "</table>\n";
    
    // Libère le résultat
    pg_free_result($resultat);
    
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