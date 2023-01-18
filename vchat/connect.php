<?php

    include 'core/init.php';

    $userObj->updateSession();

    if (isset($_GET['username']) && !empty($_GET['username'])) {

        $profileData = $userObj->getUserByUsername($_GET['username']) ;

        $user = $userObj->userData();

        // var_dump($profileData);
            
        var_dump($userObj->getUserBySession($user->sessionID));

        if (!$profileData) {

            $userObj->redirect('home.php');

        } else if ($profileData->username === $user->username) {

            $userObj->redirect('home.php');

        }
        
    } else {

        $userObj->redirect('home.php');

    }

?>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>

        var conn = new WebSocket('ws://localhost:8080/?token=<?php echo $userObj->sessionID; ?>');

    </script>

</head>

<html>

    <body>
        
        <div style="position: absolute; left: 0; right: 0; top: 0; bottom: 0; margin: auto; border: 2px solid black; border-radius: 5px; width: 80%; height: 80%;">

            <div style="padding: 20px;">

                <div style="position: absolute; left: 5%; top: 5%;"><?php echo $user->username; ?></div>

                <br>
                <br>

                <image src='<?php echo BASE_URL . $user->profileImage; ?>' style="width: 100px; height: 100px; position: absolute; right: 5%; top: 5%;">

                <div style="position: absolute; left: 0; right: 0; top: 0; bottom: 0; margin: auto; border: 2px solid black; border-radius: 5px; width: 350px; height: 350px;">
                
                    <div style="position: absolute; left: 0; right: 0; top: 0; margin: auto; width: 50px; margin-top:20px;"><?php echo $profileData->username; ?></div>

                    <image style='width: 70%; height: 70%; position: absolute; left: 0; right: 0; top: 0; bottom: 0; margin: auto;' src="<?php echo BASE_URL . $profileData->profileImage ?>">

                    <br>

                    <button id='callBtn' data-user="<?php echo $profileData->userID; ?>" style='position: absolute; left: 0; right: 0; bottom: 0; margin: auto; width: 50px; margin-bottom:20px;' type='submit'> Call </button>

                </div>

                <div style="position: absolute; bottom: 5%; left: -1%; width: 10%;">

                    <ul style="list-style: none; width: 100%">

                        <?php

                            $userObj->getUser();

                        ?>

                    </ul>

                </div>

                <a href="logout.php" style="position: absolute; right: 5%; bottom: 5%;"> Sign Out </a>

            </div>

            <div id="video" style="display: none;">

                <div id="localVideo">
                    localVideo will appear here
                </div>
                
                <div id="remoteVideo">
                    remoteVideo will appear here
                </div>
                
                <button id="hangupBtn"> Hang Up </button>

            </div>

        </div>

        <script src="assets/js/main.js"></script>

        <!-- <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script> -->

    </body>

</html>