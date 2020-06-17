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
    <li><a href="index.html">Accueil</a></li>
    <li ><a href="#"class="vm">Voyage Maroc</a></li>
    <li><a href="inter.html">Voyage International</a></li>
    <li><a href="#">contact Us</a></li>
   </ul>
  </div>
 </nav>
 <section>
 <div class="leftside"> 
   <img src="undraw_destinations_fpv7.SVG">
  </div>
  <div class="rightside"> 
    
  <div id="act">
 <?php
// Connexion, sélection de la base de données
$dbconn = pg_connect("host=localhost dbname=agence user=project password=12345")
    or die('Connexion impossible : ' . pg_last_error());
?> 
<p>Les activités dans les stations</p>
<form method="post">
    <label for="search2">Choisir une station :</label><br>
    <select name="search2" nom="nom"> 
    <option value="">   </option>
    <?php
        $query = "SELECT nomstation from station";
        $query_run = pg_query($dbconn,$query);
            
        while($row = pg_fetch_array($query_run))
        {
            ?>
            <option value="<?php echo $row['nomstation'] ?>"><?php echo $row['nomstation'] ?></option>
            <?php
        }
    ?>
</select><br>
<p> </p>
<input type="submit" id="imput" name="submit" value="Valider" />
<p> </p>
<?php
 if(isset($_POST['search2'])){
    $nomstation = $_POST['search2'];
    $requete = "SELECT libelle,nomstation FROM station,propose where nomstation = '$nomstation' and propose.idstation = station.idstation";
    $resultat = pg_query($dbconn,$requete);

    //echo '<tr><th>', implode('</th><th>', array_keys($row)), '</th></tr>';
    
    ?>
    </div>
        <div class="table">
            <p>Résultat de votre recherche :</p>
        <?php
    echo "<table>\n";
    echo "\t\t<th>Les activites</th>\n";
    echo "\t\t<th>La station</th>\n";
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