<?php

class Produto{
    private $produto;
    private $valor;
    private $data_compra;
    private $tipo;

    public function __construct($produto,$valor,$data_compra,$tipo){
        $this->produto=$produto;
        $this->valor=$valor;
        $this->data_compra=$data_compra;
        $this->tipo=$tipo;
    }

    public function guardaProduto(){
        $conteudoArquivo=file_get_contents("../data/produtos.json");
        $produtos=json_decode($conteudoArquivo,true);
        $produtos[]= array(
            "produto"=>$this->produto,
            "valor"=>$this->valor,
            "data_compra"=>$this->data_compra,
            "tipo"=>$this->tipo
        );
        $arquivo=fopen("../data/produtos.json","w");
        fwrite($arquivo,json_encode($produtos));
        fclose($arquivo);
    }

    public static function obtemProdutos(){
        $conteudoArquivo=file_get_contents("../data/produtos.json");
        echo $conteudoArquivo;
    }

    public static function obtemUmProduto($indice){
        $conteudoArquivo=file_get_contents("../data/produtos.json");
        $produtos= json_decode($conteudoArquivo,true);
        echo json_encode($produtos[$indice]);

        //echo $conteudoArquivo;
    }
    
    public function atualizaProduto($indice){
        $conteudoArquivo=file_get_contents("../data/produtos.json");
        $produtos= json_decode($conteudoArquivo,true);
        $produto= $produtos[$indice];
        $produto= array (
            'produto'=>$this->produto,
            'valor'=>$this->valor,
            'data_compra'=>$this->data_compra,
            'tipo'=>$this->tipo
        );
        $produtos[$indice] = $produto;
        $arquivo=fopen('../data/produtos.json','w');
        fwrite($arquivo, json_encode($produtos));
        fclose($arquivo);
    }
    
    public static function deletaProduto($indice){
        $conteudoArquivo=file_get_contents("../data/produtos.json");
        $produtos= json_decode($conteudoArquivo,true);
        array_splice($produtos,$indice,1);

        $arquivo=fopen('../data/produtos.json','w');
        fwrite($arquivo, json_encode($produtos));
        fclose($arquivo);
    }
}

?> 