<?php

    include 'core/init.php';

    if ($userObj->isLoggedIn()) {

        $userObj->redirect('index.php');

    }

    // echo "Encrypted Password: " . $userObj->hash('12113sAs12Ww*#');   

?>

<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        <title> WebRTC </title>

    </head>

    <body>

        <div style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; width: 25%; height: 25%; border: 2px solid black; border-radius: 5px;">

            <form method="POST" action="./login.php" style="padding: 20px;">

                <input style='width: 80%;' type="email" name="email" placeholder="Email">
                <br>
                <br>
                <input style='width: 80%;' type="password" name="password" placeholder="Password">
                <br>
                <br>
                <button style='width: 40%;' type="submit" name="submit"> Sign In </button>

                <?php

                    if (isset($_GET['error'])) {

                        $error = $_GET['error'];

                        if ($error == 'invalidemailformat') {
                            
                            echo "<div style='color: red;'>";

                            echo "<br>";
    
                            echo "Invalid email format";
    
                            echo "</div>";

                        }

                        if ($error == 'passwordincorrect') {
                            
                            echo "<div style='color: red;'>";

                            echo "<br>";
    
                            echo "Password incorrect";
    
                            echo "</div>";

                        }

                        if ($error == 'emaildoesnotexist') {
                            
                            echo "<div style='color: red;'>";

                            echo "<br>";
    
                            echo "Email does not exist";
    
                            echo "</div>";

                        }

                        if ($error == 'allfieldsrequired') {
                            
                            echo "<div style='color: red;'>";

                            echo "<br>";
    
                            echo "All fields required";
    
                            echo "</div>";

                        }

                    }

                ?>               

            </form> 

        </div>

    </body>

</html>