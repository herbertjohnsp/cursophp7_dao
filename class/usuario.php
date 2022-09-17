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

    public function loadById($id) {
	 
        $sql = new Sql();
            
        //Instrução SQL levando em conta o Id recebido pelo parâmetro loadById()
        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
        ":ID"=>$id
        ));
            
        //Se o resultado a consulta for maior que zero...
   
        if(count($results) > 0) {
         $this->setData($results[0]);	  
        }	 
       }

    public static function getList(){
        $sql = new Sql();
        return $sql->select("select * from tb_usuarios order by deslogin;");
    }

    public static function search($login){
        $sql = new Sql();
        return $sql->select("select * from tb_usuarios where deslogin like :search order by deslogin;", array(
            ':SEARCH'=>"%".$login."%"
        ));
    }

    public function login ($login, $password){
        $sql = new Sql();

        $results = $sql->select("select * from tb_usuarios where deslogin = :LOGIN and dessenha = :PASSWORD", array(
            ":login"=>$login,
            ":password"=>$password
        ));
        
       
        if (count($results) > 0) {
            //$row = $results[0];
            $this->setData($results[0]);

        } else {
            throw new Exception( "Login ou usuário/senha incorretos!");
        }
    }

    public function setData($data){
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtacadastro(new DateTime($data['dtcadastro']));
    }

    public function insert()
    {
        $sql = new sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));

        if (count($results) > 0){
            $this->setData($results[0]);
        }
    }

    public function update($login, $password){
        $this->setDeslogin($login);
        $this->setDessenha($password);
        $sql = new sql();
        $sql->query("update tb_usuarios set deslogin=:LOGIN, dessenha=:password where idusuario=:ID",array(
            ':login'=>$this->getDeslogin(),
            ':password'=>$this->getDessenha(),
            ':id'=>$this->getIdusuario()
        ));
    }

    public function delete(){
        $sql = new Sql();
        $sql->query("delete from tb_usuarios where idusuario=:ID", array(
            ':id'=>$this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtacadastro(new DateTime());
    }

    public function __construct($login ="", $password=""){
        $this->setDeslogin($login);
        $this->setDessenha($password);
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

