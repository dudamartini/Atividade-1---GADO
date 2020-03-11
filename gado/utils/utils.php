<?php
function preencherFormulario($formulario, $dados){
  foreach ($dados as $chave => $valor)
    $formulario = str_replace('{'.$chave.'}',$valor,$formulario);
  return $formulario;
}

function criarConexao(){
  try{
    require_once('config/config.ini.php');
    $conexao = new PDO(MYSQL_DSN,DB_USER,DB_PASSWORD);
    return $conexao;
  }catch(PDOException $e){
    print('Erro ao conectar com o banco de dados. Favor verificar parâmetros.');
    die();
  }catch(Exception $e){
      print('Erro genérico. Entre em contato com o adm do site!');
      die();
  }
}
function preparaComando($sql){
  try{
    $conexao = criarConexao();
    return $conexao->prepare($sql);
  }catch(Exception $e){
    print('Erro ao preparar comando.');
    die();
  }
}

function executaComando($comando){
  try {
    $comando->execute();
    return $comando;
  } catch (Exception $e) {
    print('Erro ao executar comando.'.$e->getMessage());
    die();
  }
}
function addFotoBanco(){
  $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $imagem = uploadIMG();
       // $stmt = $pdo->prepare('INSERT INTO plantas VALUES(NULL,:id,:img,:especie,:preco)');
        //$stmt->bindParam(':img', $img, PDO::PARAM_STR);
        //$stmt->bindParam(':id', $id, PDO::PARAM_STR);
        //$stmt->bindParam(':especie', $especie, PDO::PARAM_STR);
       // $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        //$stmt->execute();
        $sql = 'INSERT INTO veterinario (imagem) VALUES("'.$imagem.'")';
        echo $sql;
        $pdo->query($sql);
}

function uploadIMG(){
//$img é o nome do arquivo, e $destino seria onde vc quer salvar, pelo oq eu entendi
    var_dump($_FILES);
   $upload = new Upload;
   $destino = $upload->uploadImagem ("img","uploads/");
   return $destino;

 }
//function nav(){
  ?>
    <!-- <nav>
      <div class="row">
        <div class="col s12 l12 m12 ">
          <ul>
            <li class="nav"><a href="veterinario.html" class="nav" class="nav">Veterinario</a></li>
            <li class="nav"><a href="listaVeterinario.php" class="nav" class="nav">Listagem</a></li>
          </ul>
        </div>
      </div>
    </nav> -->
  <?php
//}
?>