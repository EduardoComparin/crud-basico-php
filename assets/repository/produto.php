<?php
require_once   $_SERVER['DOCUMENT_ROOT'] . '\config\constante.php';
require_once   $dirProjeto . '\config\db_connection.php';

class ProdutoDb{

    private $db;

    public function __construct(){
        $this->db = new MySQL();
    }


    public function salvar($dados){
        $id = $dados['id'];
        $categorias = $dados['categoria'];

        unset($dados['id']);

        if ($id === "") {
            unset($dados['categoria']);
            $valor = "'" . implode("','", $dados) . "','" . implode('|', $categorias) . "'";
            $sql = "INSERT INTO produto (sku,nome,preco,quantidade,descricao,categoria) VALUES ($valor)";
        } else {
            $set = '';
            foreach ($dados as $chave => $valor) {
                if ($chave !== "categoria") {
                    $set .= "$chave = '$valor',";
                } else {
                    $valor = implode('|', $valor);
                    $set .= "$chave = '$valor',";
                }
            }
            $set = substr($set, 0, -1);
            $sql = "UPDATE produto SET $set WHERE id = $id";
        }

        $this->db->_query($sql);
        
        
    }

    public function buscaTodosProdutos(){
        return  $this->db->_query("SELECT * FROM produto ORDER by id desc");
    }

    public function buscaProduto($id){
        return  $this->db->_query("SELECT * FROM produto where id = $id");
    }

    public function delete($id){
        $this->db->_query("DELETE FROM produto WHERE produto.id = $id");
        $this->db->_close(); 
    }
}