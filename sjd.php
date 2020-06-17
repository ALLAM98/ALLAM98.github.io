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
    
  <div id="sjd">
    <p>Les séjours ayant eu lieu sur les stations</p>
<?php
// Connexion, sélection de la base de données
$dbconn = pg_connect("host=localhost dbname=agence user=project password=12345")
    or die('Connexion impossible : ' . pg_last_error());
?>
<form  method="POST">
    <label for="nom">Choisir une station :</label>
    <select name="nom" nom="nom">
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
    <input type="submit" name="submit" id="imput" value="Valider" />
    <p> </p>
</form>
<?php
 
    if(isset($_POST['nom'])){
        $nomstation = $_POST['nom'];
        $requete = "SELECT nomstation,region,debut,nombreplace,nom FROM client,station,sejour where nomstation = '$nomstation'  and (sejour.idsejour = station.idsejour and client.idsejour = sejour.idsejour)";
        $resultat = pg_query($dbconn,$requete);
    
        //echo '<tr><th>', implode('</th><th>', array_keys($row)), '</th></tr>';
        ?>
        </div>
        <div class="ttable">
            <p>Résultat de votre recherche :</p>
        <?php
        echo "<table>\n";
        echo "\t\t<th>nom de station</th>\n";
        echo "\t\t<th>region</th>\n";
        echo "\t\t<th>debut</th>\n";
        echo "\t\t<th>nombre de place </th>\n";
        echo "\t\t<th>clients</th>\n";
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