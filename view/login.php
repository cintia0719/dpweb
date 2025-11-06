<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cintia</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: radial-gradient(circle at top left, #2e003e, #92366fff);
      overflow: hidden;
      position: relative;
    }

    /* Luces suaves femeninas */
    body::before,
    body::after {
      content: '';
      position: absolute;
      border-radius: 50%;
      filter: blur(160px);
      opacity: 0.45;
      z-index: 0;
    }

    body::before {
      width: 400px;
      height: 400px;
      top: -100px;
      left: -120px;
      background: #ff8ed6;
    }

    body::after {
      width: 350px;
      height: 350px;
      bottom: -150px;
      right: -100px;
      background: #b266ff;
    }

    /* Contenedor principal */
    .container {
      position: relative;
      width: 750px;
      height: 450px;
      border: 2px solid rgba(255, 160, 240, 0.4);
      border-radius: 20px;
      background: rgba(204, 131, 192, 0.6);
      box-shadow: 0 0 25px rgba(255, 130, 240, 0.3);
      backdrop-filter: blur(12px);
      overflow: hidden;
      z-index: 1;
      animation: fadeIn 1s ease-out forwards;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.95);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }

    /* Caja del formulario */
    .form-box {
      position: absolute;
      top: 0;
      left: 0;
      padding: 0 40px;
      width: 50%;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: rgba(50, 5, 75, 0.85);
      border-right: 1px solid rgba(255, 180, 255, 0.3);
      box-shadow: inset -3px 0 10px rgba(255, 180, 255, 0.1);
    }

    .form-box h2 {
      text-align: center;
      font-size: 1.9rem;
      color: #ddd2dbff;
      margin-bottom: 20px;
      letter-spacing: 1px;
      
    }

    /* Campos del formulario */
    .input-box {
      position: relative;
      width: 100%;
      height: 50px;
      margin-top: 25px;
    }

    .input-box input {
      width: 100%;
      height: 100%;
      background: transparent;
      border: none;
      outline: none;
      color: #ffeaff;
      font-size: 1rem;
      padding: 0 5px;
      border-bottom: 2px solid rgba(255, 140, 230, 0.5);
      transition: all 0.4s ease;
    }

    .input-box input:focus {
      border-bottom-color: #ff99e6;
      box-shadow: 0 4px 10px rgba(255, 130, 230, 0.25);
    }

    .input-box label {
      position: absolute;
      top: 50%;
      left: 0;
      color: #c9a9d9;
      transform: translateY(-50%);
      pointer-events: none;
      transition: 0.4s ease;
    }

    .input-box input:focus~label,
    .input-box input:valid~label {
      top: -5px;
      color: #ff8ed6;
      font-size: 0.85rem;
    }

    /* Botón */
    .btn {
      position: relative;
      width: 100%;
      height: 45px;
      margin-top: 30px;
      border: none;
      border-radius: 40px;
      background: linear-gradient(90deg, #ff99e6, #b266ff);
      color: #fff;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      letter-spacing: 1px;
      overflow: hidden;
    }

    .btn::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
      transition: 0.6s;
    }

    .btn:hover::before {
      left: 100%;
    }

    .btn:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px #ff8ed6;
    }

    /* Panel derecho */
    .info-content {
      position: absolute;
      top: 0;
      right: 0;
      height: 100%;
      width: 50%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-end;
      text-align: right;
      padding: 0 40px 60px 100px;
      color: #ffeaff;
      background: linear-gradient(135deg, rgba(60, 0, 35, 0.8), rgba(209, 139, 206, 0.9));
      box-shadow: inset 3px 0 15px rgba(138, 46, 103, 0.15);
    }

    .info-content h2 {
      color: #b6abb3ff;
      text-transform: uppercase;
      font-size: 1.9rem;
      line-height: 1.3;
     
    }

    .info-content p {
      margin-top: 15px;
      color: #e6b8ff;
      font-size: 0.95rem;
      line-height: 1.5;
    }

    .info-content img {
      width: 140px;
      margin-top: 30px;
      border-radius: 50%;
      filter: drop-shadow(0 0 12px #ff8ed6);
      transition: 0.3s ease;
    }

    .info-content img:hover {
      transform: rotate(8deg) scale(1.05);
    }

    /* Elemento decorativo */
    .contai {
      position: absolute;
      right: 0;
      top: -5px;
      height: 600px;
      width: 850px;
      background: linear-gradient(450deg, #aa33cc, #ff8ed6);
      transform: rotate(10deg) skewY(40deg);
      transform-origin: bottom right;
      opacity: 0.15;
      filter: blur(6px);
    }
  </style>

  <script>
    const base_url = '<?= BASE_URL;?>';
  </script>
</head>

<body>
  <div class="container">
    <div class="contai"></div>
    <div class="form-box Login">
      <h2>Acceso</h2>
      <form id="frm_login">
        <div class="input-box">
          <input type="text" id="username" name="username" required>
          <label for="">Usuario</label>
        </div>

        <div class="input-box">
          <input type="password" id="password" name="password" required>
          <label for="">Contraseña</label>
        </div>

        <div class="input-box">
          <button class="btn" type="button" onclick="iniciar_sesion();">Iniciar Sesión</button>
        </div>
      </form>
    </div>

    <div class="info-content">
      <h2>Bienvenida</h2>
      <p>Tu sistema de ventas</p>
      <img src="https://i.pinimg.com/736x/49/b6/8e/49b68e159d5a1db94fe9dcdd7f4011c7.jpg"
        alt="Logo">
    </div>
  </div>

  <script src="<?= BASE_URL; ?>view/function/user.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
