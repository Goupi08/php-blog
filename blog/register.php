<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Account erstellen</title>
    <style>
    </style>
  </head>
  <body>
    <?php
    require_once 'header.php';

    //$sql = "SELECT * FROM admin" ;

        
        require_once('connect.php'); // Hier sind die PDO-Benutzerdaten gespeichert

    
    // Verbindung zur Datenbank via PDO aufbauen
    try {

        $sql = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        // set the PDO error mode to exception
        $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /* echo "Connected successfully"; */ }
    catch(PDOException $e)
        {
        echo "Connection to Database failed! " . $e->getMessage();
        }




    if(isset($_POST["submit"])){
      require("connect.php");
      $conn = $sql->prepare("SELECT * FROM admin WHERE username = 'username'"); //Username überprüfen
      $conn->bindParam(":user", $_POST["username"]);
      $conn->execute();
      $count = $conn->rowCount();
      if($count == 0){
        //Username ist frei
        if($_POST["pw"] == $_POST["pw2"]){
          //User anlegen
          $conn = $sql->prepare("INSERT INTO admin (username, password, email) VALUES (:user, :pw, :email)");
          $conn->bindParam(":user", $_POST["username"]);
          $conn->bindParam(":email", $_POST["email"]);
          $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
          $conn->bindParam(":pw", $hash);
          $conn->execute();
          echo "Dein Account wurde angelegt";
        } else {
          echo "<div class='w3-panel w3-pale-red w3-display-container'> Die Passwörter stimmen nicht überein</div>" ;
        }
      } else {
        echo "<div class='w3-panel w3-pale-red w3-display-container'>Der Username ist bereits vergeben</div>";
      }

    }
     ?>
    <h2 class="w3-container w3-teal">Account erstellen</h2>
    <form action="register.php" method="post" class="w3-container w3-padding">
      <input type="text" name="username" placeholder="Username" required class="w3-input w3-border"><br>
      <input type="text" name="email" placeholder="Email" required class="w3-input w3-border"><br>
      <input type="password" name="pw" placeholder="Passwort" required class="w3-input w3-border"><br>
      <input type="password" name="pw2" placeholder="Passwort wiederholen" required class="w3-input w3-border"><br>
      <button type="submit" name="submit" class="w3-btn w3-teal">Erstellen</button>
    </form>
    <br>
    <a href="login.php">Hast du bereits einen Account?</a>
    <?php
        Include("footer.php");
    ?>

  </body>
</html>
