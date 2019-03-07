<?php
    ini_set("display_errors","1");
    include './db.php';
    class Question extends connectDb{
        private $question;
       	private $option1;
	private $option2;
	private $option3;
	private $option4;
	private $answer;
        public function __construct($question,$option1,$option2,$option3,$option4,$answer){
            $this->question = $question;
            $this->option1 = $option1;
	    $this->option2 = $option2;
		$this->option3 = $option3;
		$this->option4 = $option4;
		$this->answer = $answer;
        }
	public function getQuizId($title){
		 $instance = ConnectDb::getInstance();
            $conn = $instance->getConnection();
		$sql= "SELECT quizid from quiz where quizname= '$title'";
		
		$var =$conn->exec($sql);
		return $var;
		$conn->closeCursor();
	    }	
	public function insertQuiz($id,$question,$option1,$option2,$option3,$option4,$answer,$type){
		 $instance = ConnectDb::getInstance();
            $conn = $instance->getConnection();
		$conn->setAttribute (PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
		$sth1 = "INSERT INTO question (`quizid`,`question`,`option1`,`option2`,`option3`,`option4`,`answer`,`type`) VALUES ('$id','$question','$option1','$option2','$option3','$option4','$answer','$type')";
		    $temp = $conn->exec($sth1);
			if($temp){ $conn->closeCursor(); header("location: quiz.html");}
}
	}
	
        
      
     class single extends Question {
        public function __construct($question,$option1,$option2,$option3,$option4,$answer){
            new Question($question,$option1,$option2,$option3,$option4,$answer);
        }
    }
    class multiple extends Question {
        public function __construct($question,$option1,$option2,$option3,$option4,$answer){
            new Question($question,$option1,$option2,$option3,$option4,$answer);
        }
    }
    class QuestionFactory {
        public function getQuestion($type,$question,$option1,$option2,$option3,$option4,$answer){
            if($type == "single"){
                return new single($question,$option1,$option2,$option3,$option4,$answer);
		
              
    }
            elseif ($type == "multiple"){
                return new multiple($question,$option1,$option2,$option3,$option4,$answer);
             
}
                    
        }
    }
	if(isset($_POST['sub'])){
		$title = $_POST['name'];
		$question = $_POST['question'];
		$type = $_POST['type'];
		$answer = $_POST['correct'];
		$option1 = $_POST['option1'];
		$option2 = $_POST['option2'];
		$option3 = $_POST['option3'];
		$option4 = $_POST['option4'];
		$obj = new QuestionFactory();
    
		    $var = $obj->getQuestion($type,$question,$option1,$option2,$option3,$option4,$answer);
		    $ans = $var->getQuizId($title);
		    $var->insertQuiz($ans,$question,$option1,$option2,$option3,$option4,$answer,$type);
}

  
    




?>
