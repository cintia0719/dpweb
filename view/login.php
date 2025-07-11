<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: sans-serif;
            background-color:rgb(197, 134, 176);
            background: url('https://i.pinimg.com/736x/a2/a1/4d/a2a14d360d9ccd19b2a73f2f8ced95cb.jpg') ;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
           
        
        }

        .login-container {
            background-color:rgb(163, 96, 133);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
    <script>
        const base_url = '<?= BASE_URL; ?>';
    </script>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <form id="frm_login">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="button"  onclick="iniciar_sesion();">Ingresar</button>
            <div id="errorMessage" class="error-message"></div>
        </form>
    </div>
    <script src="<?= BASE_URL; ?>view/function/user.js"></script>

</body>
</html> 

