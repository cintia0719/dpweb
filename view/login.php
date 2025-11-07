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
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: radial-gradient(circle at center, #5c007a, #9c27b0);
    }

    .login-box {
      position: relative;
      width: 360px;
      padding: 40px 30px 50px;
      border-radius: 20px;
      background: linear-gradient(145deg, #6a0080, #8e24aa);
      box-shadow: 0 0 25px rgba(255, 255, 255, 0.1),
                  0 0 35px rgba(150, 0, 200, 0.4);
      text-align: center;
      overflow: hidden;
    }

    .login-box::before {
      content: '';
      position: absolute;
      inset: 0;
      background: radial-gradient(circle at top, rgba(255,255,255,0.15), transparent 70%);
      pointer-events: none;
    }

    .login-box .icon {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: rgba(255,255,255,0.2);
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto 20px;
    }

    .login-box .icon i {
      font-size: 40px;
      color: #fff;
    }

    .login-box form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .input-box {
      position: relative;
    }

    .input-box input {
      width: 100%;
      padding: 12px 40px 12px 40px;
      border: none;
      border-bottom: 2px solid rgba(255,255,255,0.4);
      background: transparent;
      outline: none;
      color: #fff;
      font-size: 15px;
      transition: 0.3s;
    }

    .input-box input:focus {
      border-bottom-color: #fff;
    }

    .input-box i {
      position: absolute;
      left: 10px;
      top: 12px;
      color: #fff;
      font-size: 18px;
    }

    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      color: #eee;
      margin-top: -5px;
    }

    .options label {
      display: flex;
      align-items: center;
      gap: 5px;
      cursor: pointer;
    }

    .options a {
      color: #fff;
      text-decoration: none;
    }

    .options a:hover {
      text-decoration: underline;
    }

    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 30px;
      background: linear-gradient(90deg, #b266ff, #ff66cc);
      color: #fff;
      font-weight: 600;
      letter-spacing: 1px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn:hover {
      transform: scale(1.05);
      box-shadow: 0 0 20px rgba(255,255,255,0.3);
    }

    .register-btn {
      margin-top: 10px;
      background: rgba(255,255,255,0.2);
    }

    .register-btn:hover {
      background: rgba(255,255,255,0.3);
    }
  </style>

  <script>
    const base_url = '<?= BASE_URL; ?>';
  </script>
</head>
<body>
  <div class="login-box">
    <div class="icon">
      <i class="fa fa-user"></i>
    </div>
    <form id="frm_login">
      <div class="input-box">
        <i class="fa fa-envelope"></i>
        <input type="text" id="username" name="username" placeholder="Email ID" required>
      </div>
      <div class="input-box">
        <i class="fa fa-lock"></i>
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>
      <div class="options">
        <label><input type="checkbox"> Remember me</label>
        <a href="#">Forgot Password?</a>
      </div>
      <button class="btn" type="button" onclick="iniciar_sesion();">LOGIN</button>
      <button class="btn register-btn" type="button" onclick="window.location.href=base_url+'register'">REGISTER</button>
    </form>
  </div>

  <script src="https://kit.fontawesome.com/a2d04b9c2f.js" crossorigin="anonymous"></script>
  <script src="<?= BASE_URL; ?>view/function/user.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
