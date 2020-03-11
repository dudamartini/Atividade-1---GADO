<?php
// Controle da Interface
require_once('utils/utils.php');

$acao = isset($_GET['acao']) ? $_GET['acao']: 0;

  if ($_SERVER['REQUEST_METHOD'] ==  'GET'){

    if ($acao == 'alterar') {
      $formulario = file_get_contents('veterinario.html');
      if (isset($_GET['id'])){
        $sql = 'SELECT * FROM veterinario WHERE id = :id';
        // prepara o comando para executar
        $comando = preparaComando($sql);
        $comando->bindParam(':id',$_GET['id']);
        // executar o $comando
        $veterinario = executaComando($comando)->fetch(); // pegando os dados do banco
        $formulario = preencherFormulario($formulario,$veterinario);
      }else{
        $formulario = str_replace('{nome}','',$formulario);
        $formulario = str_replace('{crmv}','',$formulario);
        $formulario = str_replace('{telefone}','',$formulario);
        $formulario = str_replace('{info}','',$formulario);
        $formulario = str_replace('{imagem}','',$formulario);
        $formulario = str_replace('{id}','',$formulario);
      }
      print($formulario);
    }
    elseif ($acao == 'excluir'){

          $id = $_GET['id'];

          // definir o comando que será executado no banco de dados
          $sql = 'DELETE FROM veterinario WHERE id = :id';
          // prepara o comando para executar
          $comando = preparaComando($sql);

          //vincular variáveis com os parâmetros do comando
          $comando->bindParam(':id',$id);
          // executar o $comando
          executaComando($comando);

          header("location:listaVeterinario.php");
        }
      }
  else if ($_SERVER['REQUEST_METHOD'] ==  'POST'){

      if (isset($_POST['nome'])){
        //tratamento de dados para inserção
        $nome = $_POST['nome'];
        $crmv = $_POST['crmv'];
        $telefone = $_POST['telefone'];
        $imagem = 'img/'.$_FILES['imagem']['name'];
        var_dump($_FILES);
        $info = $_POST['info'];
        $id = $_POST['id'];
        if ($id > 0){
          // definir o comando que será executado no banco de dados
          $sql = 'UPDATE veterinario
                     SET nome = :nome, crmv = :crmv, telefone = :telefone, imagem = :imagem, info = :info
                   WHERE id = :id';
          // prepara o comando para executar
          $comando = preparaComando($sql);

          //vincular variáveis com os parâmetros do comando
          $comando->bindParam(':nome',$nome);
          $comando->bindParam(':crmv',$crmv);
          $comando->bindParam(':telefone',$telefone);
          $comando->bindParam(':info',$info);
          $comando->bindParam(':imagem',$imagem);
          $comando->bindParam(':id',$id);
          // executar o $comando
          executaComando($comando);

          header("location:listaVeterinario.php");
          echo "TOP";
        }else{
          // salvar cadastro no banco
          // definir o comando que será executado no banco de dados

          $destino = 'img/'.$_FILES['imagem']['name'];
          move_uploaded_file($_FILES['imagem']['tmp_name'], $destino);

          $sql = 'INSERT INTO veterinario (nome, crmv, telefone, imagem, info)
                       VALUES (:nome,:crmv,:telefone, :imagem, :info)';

          $dados = array(':nome'=>$nome, ':crmv'=>$crmv, ':telefone'=>$telefone, ':imagem'=>$destino, 
            ':info'=>$info);
          // prepara o comando para executar
          $comando = preparaComando($sql);

          //vincular variáveis com os parâmetros do comando
          $comando->bindParam(':nome',$nome);
          $comando->bindParam(':crmv',$crmv);
          $comando->bindParam(':telefone',$telefone);
          $comando->bindParam(':info',$info);
          $comando->bindParam(':imagem',$imagem);
          // executar o $comando
          executaComando($comando);

         header("location:listaVeterinario.php");
        }
      }else{
        echo "Preencha todos os campos do formulário";
      }
    }
 ?>
