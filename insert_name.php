<?php
    $dbfile = "mydatabase.db";

    try{
        $db = new PDO("sqlite:". $dbfile);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = trim($_POST['username']);
            
            if (!empty($username)){

                $stmt = $db->prepare("SELECT COUNT(*) FROM Users WHERE username = :username");
                $stmt->bindParam(":username", $username, PDO::PARAM_STR);
                $stmt->execute();
                $count = $stmt->fetchColumn();

                if ($count == 0){
                    $stmt = $db->prepare("INSERT INTO USERS (username) VALUES (:username)");
                    $stmt->bindParam(":username", $username, PDO::PARAM_STR);

                    if ($stmt->execute()){
                        header("Location: feed_page.html");
                        die();
                    }
                    else echo "ERROR: Failed while adding a new user";
                }
                else {
                    header("Location: feed_page.html");
                    die();
                }
            }
            else echo "ERROR: Username cannot be empty";
        }
    } catch (PDOException $e) {
        echo "ERROR: Connection failed: " . $e->getMessage();
    }