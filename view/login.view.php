<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Imagen en Laravel</title>
    <style>
        body {
            background-color: #C2C9EF;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .square {
            width: 500px;
            height: 500px;
            background-color: #E0E5FA;
            position: relative;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        }

        .logo {
            width: 70px;
            height: 100px;
            display: block;
            margin: 0 auto; 
            margin-top: 20px; 
        }

        form {
            margin-top: 40px; /* Ajuste del espacio entre la imagen y el formulario */
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #001459;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 20px;
            background-color: #6C86B5;
            color: #000;
            font-family: inherit;
        }

        button[type="submit"] {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 20px;
            background-color: #27446E;
            color: #FFF;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #001459;
        }
    </style>
</head>
<body>

<section>
    <div class="square">  
        <img src="dist\images\Logo.png" alt="Logo de la empresa" class="logo">
        <form class="max-w-sm mx-auto fs-5" method="POST" action="login">
            <label for="base-input">Cargo</label>
            <input type="text" name="txtCargo" id="base-input" required>
            
            <label for="password">Contraseña</label>
            <input type="password" name="txtPassword" id="password" required>

            <div class="text-center mt-10">
                <button type="submit">INGRESAR</button>
            </div>
        </form>
    </div>    
</section>

</body>
</html>
