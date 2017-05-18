<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
<link rel='stylesheet prefetch' href='/assets/font-awesome-4.7.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="/logincss/css/style.css">
<link rel="stylesheet" href="/assets/css/toast.css" />
<style type="text/css">
  .block-loading{
    position:absolute;
    width:100%;
    height:100%;
    top:0;
    left:0;
    background:#fff url(/images/loader.gif) no-repeat center;
    opacity:0.7;
  }
  
</style>
</head>

<body>
  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title" >
  
</div>

  <!-- Form Module-->
  <div class="module form-module">
    <div class="toggle"><i class="fa fa-times fa-pencil"></i>
    </div>
    <div class="form">
      <h2>Iniciar sesión</h2>
      <form id="frm_login" method="POST" action="/controllers/authentication.php">
        <div id="load"></div>
        <input type="text" placeholder="Nombre de Usuario" name="user" required="" autofocus="true" />
        <input type="password" placeholder="Contraseña" id="pass" name="pass" required="" />
        <input type="hidden" name="login" value="">
        <button type="submit">Entrar</button>

      </form>
    </div>
  </div>


  <script src="/js/jquery-1.12.4.js"></script>
    <script src="/logincss/js/index.js"></script>
    <script src="/logincss/ini.js"></script>
    
</body>
</html>
<script src="../assets/scripts/toast.js"></script>



