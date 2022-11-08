<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caesar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&family=Roboto+Mono&display=swap" rel="stylesheet">

    <style>
        .header-container{
            height: 630px;
            background-image: url(https://contabo.com/blog/wp-content/uploads/2022/02/Blog-Head_1200x630_SSH-Keys.jpg);
            background-color: gray;
            background-size: cover;
            

        }
        .header{
            color: green;
            height: 60px;
            font-size: 40px;
            font-family: 'Roboto Mono', monospace;

        }
        .card {
            height: calc(100vh - 690px);
            background-color: black;
            border-radius: 8px;
            margin-top: -23px;
            padding: 16px;
            display: flex;
            flex-direction: column;
        }
        form{
            display: flex;
            flex-direction: column;
            color: white;

            margin-bottom: 60px;
        }
        body{
            margin: 0px;
            background-color: black;
            font-family: 'Roboto Mono', monospace;

        }
        body *{
            font-family: 'Roboto Mono', monospace;
        }
        input{
            height: 40px;
            margin-bottom: 30px;
            border-radius: 8px;
            border: 1px;

        }
        button{
            height: 40px;
            background-color: #3d983d;
            color: whitesmoke;
            border-radius: 8px;
            border: unset;
            cursor: pointer;
        }
        button:hover{
            background-color: #3ce73c;
        }
        h2{
            color: #3ce73c;
        }
        toNum {
            color: white;
        }
    </style>
</head>
<body>
    
    <div class= "header"><a href="/shop/blog">Home</a></div>


    <div class="header-container"></div>

    <?php
        $spacialchars = [' ','ß','ä','ü','ö','.','!']
    ?>


    <div class= "card">
        <form>
            <h2>Text verschlüsseln</h2>
            <input name="encrypt" placeholder="Hier Text eingeben">
            <?php
                if (isset($_GET['encrypt'])) {
                    $text = strtolower($_GET['encrypt']);
                    $array = str_split($text);
                    echo '<b>Dein Wort</b>' ;
                    foreach($array as $char) {
                        if(in_array($char, $spacialchars)){
                            echo $char;
                        } else{

                            echo tochar(toNum($char) +9);
                        }
                    }

                 
                }
            ?>
            <button type= "submit">Verschlüsseln</button>
        </form>

        <form>
            <h2>Text entschlüsseln</h2>
            <input name="dencrypt" placeholder="Hier Text eingeben">
            <?php
                if (isset($_GET['dencrypt'])) {
                    $text = strtolower($_GET['dencrypt']);
                    $array = str_split($text);
                    echo '<b>Dein Wort</b>' ;
                    foreach($array as $char) {
                        if(in_array($char, $spacialchars)){
                            echo $char;
                        } else{
                        echo tochar(toNum($char) - 9);
                        }
                    }

                 
                }
            ?>
            <button type= "submit">Entschlüsseln</button>



        </form>
    </div>






</body>
</html>


<?php
function toNum($data) {
    $alphabet = array( 'a', 'b', 'c', 'd', 'e',
                       'f', 'g', 'h', 'i', 'j',
                       'k', 'l', 'm', 'n', 'o',
                       'p', 'q', 'r', 's', 't',
                       'u', 'v', 'w', 'x', 'y',
                       'z'
                       );
    $alpha_flip = array_flip($alphabet);
    $return_value = -1;
    $length = strlen($data);
    for ($i = 0; $i < $length; $i++) {
        $return_value +=
            ($alpha_flip[$data[$i]] + 1) * pow(26, ($length - $i - 1));
    }


    return $return_value;
}

function tochar($number) {

    if ($number < 0) {
        $number = $number + 26;
    }

    if($number > 25){
        $number = $number - 26;
    }


    $alphabet = array( 'a', 'b', 'c', 'd', 'e',
                       'f', 'g', 'h', 'i', 'j',
                       'k', 'l', 'm', 'n', 'o',
                       'p', 'q', 'r', 's', 't',
                       'u', 'v', 'w', 'x', 'y',
                       'z'
                       );
    
    return $alphabet[$number];
}



?>
