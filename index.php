<?php

require_once("config.php");

//$sql = new Sql();

//$usuarios = $sql->select("select * from tb_usuarios");

//echo json_encode($usuarios);

// carrega um usuário
//$root = new Usuario();
//$root->loadById(3);
// echo $root;

// carrega vários usuários

//$lista = Usuario::getList();
// echo json_encode($lista);


// carrega uma lista de usuários buscando pelo login
//$search = Usuario::search("jo"); 

//echo json_encode($search);

// carrega um usuário usando o login e a senha
//$usuario = new Usuario();
//$usuario->login("root","#!asas");

//$aluno = new Usuario("aluno", "@lun0");

//$aluno->insert();

//echo $aluno;

// Criando um novo usuário

$usuario = new Usuario();
$usuario->loadById(5);
$usuario->update("professor","212333");
echo $usuario;