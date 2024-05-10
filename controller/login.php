<!-- Iniciando con la fase de pruebas... -->
<?php 
    session_start();
    require_once 'config.php';
    
    if (isset($_SESSION['user'])) {
        switch ($_SESSION['user']) {
            case 'Supervisor':
                controller('supervisor');
                exit;
            case 'Administrador':
                controller('admin');
                exit;
            default:
                controller('default');
                exit;
        }
    }
    
    if (isset($_POST['txtCargo'], $_POST['txtPassword'])) {
        // Conexión a la base de datos y verificación de usuario
        $con = new mysqli(s,u,p,bd); // Utiliza las constantes definidas en config.php
        $query = "SELECT COUNT(*) FROM users WHERE cargo = ? AND password = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('ss', $_POST['txtCargo'], $_POST['txtPassword']);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        if ($result === 1) {
            if ($_POST['txtCargo'] === "Supervisor") {
                $_SESSION['user'] = "Supervisor";
                controller('supervisor');
                exit;
            } else if ($_POST['txtCargo'] === "Administrador") {
                $_SESSION['user_type'] = "Administrador";
                controller('admin');
                exit;
            }
        } else {
            controller('login');
            exit;
        }
        $con->close();
    } else {
        view('login');
    }    
?>