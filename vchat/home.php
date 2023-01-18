<?php

    include 'core/init.php';

    if (!$userObj->isLoggedIn()) {

        $userObj->redirect('index.php');

    }

    $user = $userObj->userData();

    // echo $_SESSION['userID'];
    // echo BASE_URL;
    // var_dump($user);
    // echo $user->userID;
    // echo "<br>";
    // echo $user->name;
    // echo "<br>";
    // echo $user->email;
    // echo "<br>";
    // echo $user->password;
    // echo "<br>";
    // echo $user->profileImage;
    // echo "<br>";
    // echo $user->sessionID;
    // echo "<br>";
    // echo $user->connectionID;

?>

<html>

    <body>
        
        <div style="position: absolute; left: 0; right: 0; top: 0; bottom: 0; margin: auto; border: 2px solid black; border-radius: 5px; width: 80%; height: 80%;">

            <div style="padding: 20px;">

                <div style="position: absolute; left: 5%; top: 5%;"><?php echo $user->username; ?></div>

                <br>
                <br>

                <image src='<?php echo BASE_URL . $user->profileImage; ?>' style="width: 100px; height: 100px; position: absolute; right: 5%; top: 5%;">

                <div style="position: absolute; bottom: 5%; left: -1%; width: 10%;">

                    <ul style="list-style: none; width: 100%">

                        <?php

                            $userObj->getUser();

                        ?>

                    </ul>

                </div>

                <a href="logout.php" style="position: absolute; right: 5%; bottom: 5%;"> Sign Out </a>

            </div>

        </div>

    </body>

</html>