<?php 

 class Usuario{
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuario(){
        return $this->idusuario;
    }

    public function setIdusuario($value){
        $this->idusuario = $value;
    }

    public function getDeslogin(){
        return $this->idusuario;
    }

    public function setDeslogin($value){
        $this->deslogin = $value;
    }

    public function getDessenha(){
        return $this->idusuario;
    }

    public function setDessenha($value){
        $this->dessenha = $value;
    }

    public function getDtacadastro(){
        return $this->idusuario;
    }

    public function setDtacadastro($value){
        $this->dtcadastro = $value;
    }

    public function loadById($id){
        $sql = new Sql();

        $results = $sql->select("select * from tb_usuarios where idusuario = :ID", array(
            ":ID"=>$id
        ));
        
        if (count($results) > 0){
            $row = $results[0];
            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtacadastro(new DateTime($row['dtcadastro']));
        }
    }

    public function __toString()
    {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtacadastro()->format("d/m/Y H:i:s")
        ));
    }
 }

