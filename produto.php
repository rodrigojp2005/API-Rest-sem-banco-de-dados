<?php

header("Content-Type: application/json");
include_once("../classes/class-produto.php");
switch($_SERVER['REQUEST_METHOD']){
      case 'POST':
    $_POST= json_decode(file_get_contents('php://input'),true);
    $produto = new Produto($_POST['produto'],$_POST['valor'],$_POST['data_compra'],$_POST['tipo']);
    $produto->guardaProduto();
    $resultado["mensagem"]="Guardar produto, informacao:".json_encode($_POST);
    echo json_encode($resultado);
    break;
    case 'GET':
        if(isset($_GET['id'])){
            Produto::obtemUmProduto($_GET['id']);
            
           // echo json_encode($resultado);
        }else{
            Produto::obtemProdutos();
           
        }
        break;
        case 'PUT':
           // Produto::atualizaProduto($_GET["id"]);

            $_PUT=json_decode(file_get_contents('php://input'),true);
            $produto= new Produto($_PUT['produto'],$_PUT['valor'],$_PUT['data_compra'],$_PUT['tipo']);
            $produto->atualizaProduto($_GET['id']);

            $resultado['mensagem']="Atualizar um produto com o ID ".$_GET['id'].",informacao a ataulizar:".json_encode($_PUT);
            echo json_encode($resultado);
            break;

        case 'DELETE':
            Produto::deletaProduto($_GET["id"]);
            $resultado["mensagem"]="Excluir produto com id:".$_GET['id'];
            echo json_encode($resultado);
            break;
}
?>