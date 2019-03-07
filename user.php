<?php
    ini_set("display_errors","1");
    include './db.php';
    class SuperUser extends connectDb{
        private $username;
       private $password;
        public function __construct($user,$pass){
            $this->username = $user;
            $this->password = $pass;
	    
        }
	

	public function register($username, $password, $type){
	   $instance = ConnectDb::getInstance();
           $conn = $instance->getConnection();

	if(isset($_POST['sub'])){
	    $sql = "INSERT INTO  user (`name`,`password`,`type`) VALUES ('$username','$password','$type')";
	    $conn->exec($sql);
	}
	}
	public function login($username,$password,$type){
	    $instance = ConnectDb::getInstance();
            $conn = $instance->getConnection();
	    if(isset($_POST['loginsub'])){
	   	$sql = "SELECT password FROM user where name = '$this->username' ";
		$temp = $conn->query($sql);
		$temp1 = $temp->fetch();
		$answer = $temp1['password'];
	    	if($answer == $this->password):
			if($type == "admin"):	header("Location: quiztitle.html");
			elseif ($type == "user"): echo"wait";
			endif;
		else:
			echo "Login unsuccessful";
		endif;
	}
	}
        
      }    
     class admin extends SuperUser {
        public function __construct($admin,$pass){
            new SuperUser($admin,$pass);
        }
    }
    class user extends SuperUser {
        public function __construct($user,$pass){
            new SuperUser($user,$pass);
        }
    }
    class UserFactory {
        public function getUser($type,$u,$p){
            if($type == "user"){
                return new user($u,$p);
		
              
    }
            elseif ($type == "admin"){
                return new admin($u,$p);
             
}
                    
        }
    }
	if(isset($_POST['sub'])){
 $user = $_POST['name'];
    $type = $_POST['type'];
    $pass = $_POST['pass'];
$obj = new UserFactory();
    
    $var = $obj->getUser($type,$user,$pass);
    $var->register($user,$pass,$type);
}
if(isset($_POST['loginsub'])){
$user = $_POST['name'];
    $type = $_POST['type'];
    $pass = $_POST['pass'];
$obj = new UserFactory();
    
    $var = $obj->getUser($type,$user,$pass);
    $var->login($user,$pass,$type);
}
  
    




?>
