<!DOCTYPE html>
<?php

  include_once "conf/default.inc.php";
  require_once "conf/Conexao.php";

  require_once "utils/utils.php";

  $id = isset($_GET['id']) ? $_GET['id'] : "";
  $pdo = Conexao::getInstance();
  $sql = $pdo->query("SELECT * FROM veterinario WHERE id = $id;");
  while ($linha = $sql->fetch(PDO::FETCH_ASSOC)) {
    $nome = $linha['nome'];
    $crmv = $linha['crmv'];
    $telefone = $linha['telefone'];
    $info = $linha['info'];
    $imagem = $linha['imagem'];
  }

?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Perfil do Veterinário</title>
    <!-- Compiled and minified CSS -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <script
   			  src="https://code.jquery.com/jquery-3.4.1.min.js"
   			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
   			  crossorigin="anonymous"></script>
   <!-- Compiled and minified JavaScript -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   <link rel="stylesheet" href="css/estilo.css">

   <link rel="shortcut icon" href="img/robert.jpg">

   <script>
       $(".button-collapse").sideNav();
    </script>

    <style>
      .nav-wrapper  {
          background-color: #a5d6a7  !important;
          font-size: 14px;
        }

      .dropdown-button  {
          background-color: #388e3c  !important;
          font-size: 13px;
        } 
</style>
  </head>
  <body class='container'>

    <div>
      <!-- Dropdown Structure -->
      <ul id="dropdown1" class="dropdown-content">
        <li><a href="https://www.jquery-az.com/6-examples-materialize-modals-live-demos-code/">Modal</a></li>
        <li><a href="https://www.jquery-az.com/9-styles-of-materialize-buttons-to-use-in-your-web-projects/">Buttons</a></li>
        <li class="divider"></li>
        <li><a href="https://www.jquery-az.com/7-examples-materialize-tables-along-custom-styles/">Table</a></li>
      </ul>
       
      <nav>
        <div class="nav-wrapper">
          <a class="brand-logo">GADO</a>
          <ul class="right hide-on-med-and-down">
              <li class="active"><a href="veterinario.php" class="nav">Veterinário</a></li>
              <li class="active"><a href="listaVeterinario.php" class="nav"">Listagem</a></li>
          </ul>
        </div>
      </nav>
      </div>


    <div class="row">
      <div class="col s12 l12 m12">
        <h1>Perfil do Veterinário</h1>
      </div>
    </div>


    <div class="row">
      <div class="col s12 l12 m12 ">
        <center><img src="<?php echo $imagem?>" style="width: 100px;"></center>
      </div>
    </div>
    <div class="row">
      <div class="col s12 l12 m12 ">

        <form action="veterinario.php" method="POST">
          <fieldset>
            <div class="row form-group">
              <div class="col s12 l12 m12">
                <label style="font-size: 20px;"><?php echo $nome?></label>
              </div>
              <div class="col s12 l12 m12">
                <label style="font-size: 20px;"><?php echo $crmv?></label>
              </div>
              <div class="col s12 l12 m12">
                <label style="font-size: 20px;"><?php echo $telefone?></label>
              </div>
              <div class="col s12 l12 m12">
                <label style="font-size: 20px;"><?php echo $info?></label>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </body>
</html>
