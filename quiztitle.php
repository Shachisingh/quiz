 

 <?php
ini_set("display_errors","1");
include './db.php';
	class quiztitle extends connectDb{
	public function __construct(){
	 $instance = ConnectDb::getInstance();
            $conn = $instance->getConnection();
	$title = $_POST['name'];
	$sql = "INSERT INTO quiz (`quizname`) VALUES ('$title')";
	$var = $conn->exec($sql);
	if($var) {
		header("Location: quiz.html");
        }
	}
   }
	$obj = new quiztitle();
   

?> 
