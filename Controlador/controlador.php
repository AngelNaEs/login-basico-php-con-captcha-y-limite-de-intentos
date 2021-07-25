<?php

// Login con captcha
if (isset($_POST['login'])) {
    $response_recaptcha = $_POST['g-recaptcha-response'];
    if(isset($response_recaptcha)&& $response_recaptcha){
        $secret = "6LcOxgMbAAAAABG7WrAmDLbSl8XPa-0qs5l9HBrF";
        $ip = $_SERVER['REMOTE_ADDR'];
        $validation_server = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response_recaptcha&remoteip=$ip");
        if($validation_server = "true"){
            include('../modelo/coneccion.php');
            session_start();
                $username = $_POST['username'];
                $password = $_POST['password'];
                $username2 = $_POST['username'];
               
                $query = $connection->prepare("SELECT * FROM users WHERE USERNAME=:username");
                $query->bindParam("username", $username, PDO::PARAM_STR);
                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);

                $query2 = $connection->prepare("SELECT * FROM blocks WHERE USERNAME=:username2");
                $query2->bindParam("username2", $username2, PDO::PARAM_STR);
                $query2->execute();
                $result2 = $query2->fetch(PDO::FETCH_ASSOC);

                if (!$result2){
                    
                    if (!$result) {
                        echo '<p class="error">Username password combination is wrong!</p>';
                        echo '<h3><a href=../index.php>Inicio</a></h3>';
                    } else {
                        if (password_verify($password, $result['password'])) {
                            $_SESSION['user_id'] = $result['password'];
                            header('Location: /loginangel/index.php');
                            echo '<p class="success">Congratulations, you are logged in!</p>';
                        } else {
                            echo '<p class="error">Nombre de usuario y contraseña son incorrectos</p>';
                            echo '<h3><a href=../index.php>Inicio</a></h3>';
                            
                            if(isset($_COOKIE["$username"])){
                                $cout = $_COOKIE["$username"];
                                $cout++;
                                setcookie($username,$cout,time()+60);
                                if($cout >= 3){
                            // Agregar ususario a la blacklist, con IP y la Fecha con la hora
                            //IP
                            $ip1 = $_SERVER['REMOTE_ADDR'];
                            // Fecha y Hora
                            $Object = new DateTime();  
                            $Object->setTimezone(new DateTimeZone('America/Mexico_City'));
                            $fecha2 = $Object->format("d-m-Y h:i:s a");  
                            // Query para insertar los datos
                            $query3 = $connection->prepare("INSERT INTO blocks(USERNAME,IP,FECHA) VALUES (:username,:ip1,:fecha2)");
                            $query3->bindParam("username", $username, PDO::PARAM_STR);
                            $query3->bindParam("ip1", $ip1, PDO::PARAM_STR);
                            $query3->bindParam("fecha2", $fecha2, PDO::PARAM_STR);
                            $result3 = $query3->execute();
                            
                            if($query3){
                                echo "Error al registrarse, tu nombre de usuario se agrego a la blacklist consulta con el administrador";
                            
                            }else{
                                echo "incorrecto";
                            }
                                }
                            }else{
                                setcookie($username,1,time()+60);
                            }

                                }
                            }

                }else{
                    echo 'Cuenta bloqueada <br/>';
                    echo 'Consulte con el administrador <br/>';
                    echo '<h3><a href=../index.php>Inicio</a></h3>';
                }

            }
        }
}

// Registro con captcha
if (isset($_POST['register'])) {
    $response_recaptcha = $_POST['g-recaptcha-response'];
    if(isset($response_recaptcha)&& $response_recaptcha){
        $secret = "6LcOxgMbAAAAABG7WrAmDLbSl8XPa-0qs5l9HBrF";
        $ip = $_SERVER['REMOTE_ADDR'];
        $validation_server = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response_recaptcha&remoteip=$ip");
        if($validation_server = "true"){
            include('../modelo/coneccion.php');
            session_start();
            
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
         
            $query = $connection->prepare("SELECT * FROM users WHERE EMAIL=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
         
            if ($query->rowCount() > 0) {
                echo '<p class="error">La dirección de correo electrónico ya está registrada.!</p>';
            }
         
            if ($query->rowCount() == 0) {
                $query = $connection->prepare("INSERT INTO users(USERNAME,PASSWORD,EMAIL) VALUES (:username,:password_hash,:email)");
                $query->bindParam("username", $username, PDO::PARAM_STR);
                $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
                $query->bindParam("email", $email, PDO::PARAM_STR);
                $result = $query->execute();
         
                if ($result) {
                    echo '<p class="success">Tu registro fue exitoso!</p>';
                    echo '<h3><a href=../index.php>Inicio</a></h3>';
                } else {
                    echo '<p class="error">Algo salió mal!</p>';
                    echo '<h3><a href=../index.php>Inicio</a></h3>';
                }
            }
        }
    }
}

// Cerrar Sesion
if (isset($_POST['cerrarsesion'])){
    include('../modelo/coneccion.php');
    session_start();
    session_destroy();
    header('Location: /loginangel/index.php');
}

    ?>

