<?php
//ALTER TABLE `categoria` ADD `codigo` INT UNSIGNED NOT NULL AFTER `id`;
include $_SERVER['DOCUMENT_ROOT'] .'\config\constante.php';
require_once   $dirProjeto .'\config\db_connection.php';

class CategoriaDb {

    private $db;

    public function __construct(){
        $this->db = new MySQL();
    }
   
    public function salvar($dados){
        $id = $dados['id'];
        unset($dados['id']);

       
        if ($id === "") {
            $valor = "'" . implode("','", $dados). "'";
            $sql = "INSERT INTO categoria (descricao,codigo) VALUES ($valor)";
        } else {
            $set = '';
            foreach ($dados as $chave => $valor) {
                    $set .= "$chave = '$valor',";
            }
            $set = substr($set, 0, -1);
            $sql = "UPDATE categoria SET $set WHERE id = $id";
        }

        $this->db->_query($sql);
        
        
    }

    public function buscaTodasCategorias(){
        return  $this->db->_query("SELECT * FROM categoria ORDER by descricao asc");
    }

    public function buscaCategoria($id){
        return  $this->db->_query("SELECT * FROM categoria where id = $id");
    }

    public function delete($id){
        $this->db->_query("DELETE FROM categoria WHERE categoria.id = $id");
        $this->db->_close();
    }



}