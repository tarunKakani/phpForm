<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login Form PHP</h2>
    
    <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>"> 
        Username:<br>
        <input type="text" name="user"><br>

        Password:<br>
        <input type="password" name="pass"><br>

        <button type="submit" name="login">Login</button>
    </form>

    <?php
        $db_server = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "Students";

        try{
            $conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);
            echo "Connection Successful <br>";
        }
        catch(mysqli_sql_exception $e){
            echo "Connection Failed: " . $e->getMessage() . "<br>";
        }

        // This is better
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $username = filter_input(INPUT_POST, "user",FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "pass",FILTER_SANITIZE_SPECIAL_CHARS);

            if (empty($username)){
                echo "Please enter a username!";
            }

            elseif(empty($password)){
                echo "Please enter a password";
            }

            else{
                $hash = password_hash($password,PASSWORD_DEFAULT);
                $sql = "INSERT INTO users (username,password) VALUES ('$username','$hash')";

                try{
                    mysqli_query($conn,$sql);
                    echo "Database updated";
                }
                catch(mysqli_sql_exception $e){
                    echo "Database not updated: " . $e->getMessage() . "<br>";
                }
            }
        }

        // Old
        // if (isset($_POST["login"])){
        //     if (isset($_POST["user"])){
        //         $username = $_POST["user"];
        //         echo $username;
        //     }
        // }
    ?>
</body>
</html>