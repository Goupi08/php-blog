<?php


//Config auslesen
require_once('connect.php');
require_once('header.php');



$heute = date ("d.m.Y",time());
//echo '<img src="logo.png">';

echo '<h1 class="w3-container w3-teal">Chat live am ' .$heute. '</h1>';


echo '
    <from action="index.php" method="post">
        <table border="0">
            <tr>';

//Falls ein Nickname eingegeben wurde, diesen als default in Textbox setzen
if (!empty($_POST['nick'])){
    $akt_nick = $_POST['nick'];
}
else{
    $akt_nick='';
};

echo'

    <form>
            <th class="w3-container w3-teal">Nickname:</th><td><input type="text" name="nick" value="'.$akt_nick.'"class="w3-input w3-border" id="textbox1"></td></tr>
                <tr>
             <th class="w3-container w3-teal">Nachricht:</th><td><input type="text" name="eintrag" value="" class="w3-input w3-border" id="textbox">&nbsp;<input type="submit" name="submit" class="w3-btn w3-teal w3-round" value="submit" id="button">&nbsp;</td>
                </tr>
             </table>
    </form>';


if (isset($_POST['submit'])){

    if(empty($_POST['nick'])or empty($_POST['eintrag'])){
        echo '<script>alert("Nickname UND Message eingeben")>/script>';
    }   else{
            //variablen definieren und mit "POST" Daten füllen (Mit htmlspecialchars filter)
            $nick = addslashes(htmlspecialchars($_POST['nick']));
            $eintrag = addslashes(htmlspecialchars($_POST['eintrag']));
            $uhrzeit = date("H:i",time());
            $datum = date("d.m.Y",time());

            //Nick + Eintrag + datum+uhrzeit in die Datenbank schreiben 
            mysqli_query($conn,"INSERT INTO 'chat_daten'  
                            (nick, eintrag, uhrzeit, datum) VALUES 
                            ('$nick', '$eintrag', '$uhrzeit', '$datum')"); 


        }
}
$datum = date("d.m.Y",time());

//alle einträge von heute ausgeben
echo '<div id="chat_fenster" class="w3-panel w3-pale-green w3-bottombar w3-border-green w3-border">';

        $abfrage = mysqli_query($conn,"SELECT * FROM 'chat_daten' WHERE datum LIKE'$datum'");
        while($row = mysqli_fetch_array($abfrage,MYSQLI_ASSOC)){
            echo '<div id ="nick_und_message"><span style="color:red">'.$row['nick'].':</span<span style ="color:black">'.$row['eintrag'].'</span></div>
            <div id = "uhrzeit"><span style ="color:green">'.$row['uhrzeit'].'</span></div><br>';
        }
echo'</div>';


//liste
echo '<div id="teilnehmer_fenster" class="w3-table-all">';
        echo '<h2>heute im Chat</h2>';
        //Nur Teilnehmer von heute auslesen
        $abfrage = mysqli_query($conn,"SELECT DISTINCT nick FROM 'chat_daten' WHERE datum LIKE'$datum'");
        while($row =mysqli_fetch_array($abfrage,MYSQLI_ASSOC)){
            echo $row['nick'].'<br>';
        }
echo'</div>';
?>

<script>
window.onload = function()
{
//Chatfenster nach oben wegscrollen, damit immer die neuesten Einträge sichtbar sind
document.getElementById('chat_fenster').scrollTop = 9999999;
}
</script>

<style type="text/css"> 
    
    #textbox{ 
        width:600px; 
        border:1px solid blue; 
    } 
     
    #textbox1{ 
        width:80px; 
        border:1px solid blue; 
    }
    
    #button{ 

        border:1px solid #FF1493; 
        cursor:pointer; 
    } 
     
    #button:hover{ 
        border:1px solid blue; 
    } 
    
    #nick_und_message{
        width:80%;
        float:left;
    }
    #uhrzeit {
        width:20%;
        float:right;
        text-align: right;
    }
    #chat_fenster{
        border:2px solid blue;
        width:750px; 
        height:350px; 
        padding:3px; 
        overflow: auto;
        float:left;
    }
    
    #teilnehmer_fenster{
        float:right;
        width:200px;
    }
</style>