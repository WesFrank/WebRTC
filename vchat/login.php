<?php

    include 'core/init.php';

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
            
        if (isset($_POST)) {
        
            $email = trim(stripcslashes(htmlentities($_POST['email'])));
            $password = $_POST['password'];

            if (!empty($email) && !empty($password)) {
                
                // validate login credentials

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    
                    $userObj->redirect('index.php?error=invalidemailformat');

                } else {
                    // Check if user email exists in database
                    if ($user = $userObj->emailExists($email)) {

                        // var_dump($user);

                        // Verify Password
                        if ($user->password == $password) {
                            
                            // log in

                            session_regenerate_id();

                            $_SESSION['userID'] = $user->userID;
                            $userObj->redirect('home.php?success=loggedinsuccessfully');

                        } else {

                            $userObj->redirect('index.php?error=passwordincorrect');

                        }                            

                    } else {
                        
                        $userObj->redirect('index.php?error=emaildoesnotexist');

                    }

                }

            } else {
                
                // Do nothing as html input tags are already assigned the required attribute
                $userObj->redirect('index.php?error=allfieldsrequired');

            }

        }

    }

?>