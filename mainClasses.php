<?php
//DB connect class using PDO to connect to the DB
class DBconnect{
	public $connect;
	public function connect(){
		 
		try{$connect = new PDO('mysql:host=localhost;dbname=oop','root','');}
		catch (PDOException $e){
			echo $e->getMessage();
		}
		return $connect;
		
	}
}
/*User registeration class*/
class user_register extends DBconnect{

	
	public $name,$lastname,$companyname,$type,$email,$password;


	public function insert(){
   
		$conn= $this->connect();
		$register = $conn->prepare("INSERT INTO `user`(`Name`, `lastname`, `companyname`, `email`, `password`, `type`) VALUES('$this->name','$this->lastname','$this->companyname','$this->email','$this->password','$this->type')");
		$register->execute();
	}

	public function name($name){
		$this->name	= $name	;
	}
	public function lastname($lastname){
		$this->lastname=$lastname;
	}
	public function companyname($companyname){
		$this->companyname	= $companyname;
	}
	public function email($email){
		$this->email=$email;
	}	
	public function password($password){
		$this->password=$password;
	}
	public function type($type){
		$this->type	= $type;
	}
	
}

//login class with the login query
class login extends DBconnect {
	public $password ,$email;
	//checks if the user exists, if so it sets its session name
	public function loginquery($user){
		    $connection= $this->connect();
			$query= $connection->prepare("SELECT `Id`,`type` FROM `user` WHERE  `password` like '$this->password' AND `email` like '$this->email' ") or die(mysql_error($connection));
		    $query->execute();
		$cont = $query->rowCount();
		if($cont >= 1){ 
			$row= $query->fetch(PDO::FETCH_ASSOC);
			$_SESSION['Id'] = $row['Id'];
			if($user == $row['type'])
			header("Location:job application.php?user=$user");
			else
				return "There is no".$user."who is registered with this id";
		}
		else 
			return "The email or password is wrong";
	}
	public function password($password){
		$this->password=$password;
	}
	public function email($email){
		$this->email=$email;
	}
}

//class for register an applied jobs of a user 
class register extends DBconnect{
	public $jobtitle, $company, $requirement;
	public $contactperson, $posteddate,$source;
	public $applieddate, $compskill;
	public $proglang,$compsoft,$sciapp,$otherskill;
	public $goal,$persletter;
	public function registerquery(){
	 $id= $_SESSION['Id'];
	 $tempId= rand(1,1000000);
	 $connection= $this->connect();	
	 
	 //inserts the values in to the job table
	 $queryJobs= $connection->prepare("INSERT INTO `jobs` (`UId`,`jobTitle`, `company`, `requirement`, `postedDate`, `appliedDate`, `contactPerson`,`source`,`tempId`)
	 		VALUES('$id','$this->jobtitle','$this->company','$this->requirement','$this->posteddate','$this->applieddate','$this->contactperson','$this->source','$tempId')");
	 $queryJobs->execute();
	 
	 //retrive the inserted job id
	 $queryJobId=$connection->prepare("SELECT `Id_jobs` FROM `jobs` WHERE `jobTitle` LIKE '$this->jobtitle' AND 
	 		`company` LIKE '$this->company' AND `tempId` LIKE '$tempId'");
	 $queryJobId->execute();
	 $result=$queryJobId->fetch(PDO::FETCH_ASSOC);
	 $jobId=$result['Id_jobs'];
	 //insert the job information in the adjecent CV table
	 $queryCV= $connection->prepare("INSERT INTO `cv` (`UId`,`jobId`,`computer_skill`,`programming_language`,`computer_softwares`,`scientific_app`,`other_skills`,`goal`)
	 		VALUES('$id','$jobId','$this->compskill','$this->proglang','$this->compsoft','$this->sciapp','$this->otherskill','$this->goal')");
	 $queryCV->execute();
	 //insert the job information in the adjecent Personal letter table
	$queryPL= $connection->prepare("INSERT INTO `personalletter` (`UId`,`jobId`,`letter`)	VALUES('$id','$jobId','$this->persletter')");
	$queryPL->execute();
	 //send job application view link to the user
	 $to = "$this->email";
	 $subject="You registered a job and you can check it by clicking the following link";
	 $msg="http://wendeworku.com/$this->company/$this->jobTitle/$this->contactPerson/$jobId";
	 mail("$to","$subject","$msg");
		
	}
	public function jobTitle($jobtitle){
		$this->jobtitle=$jobtitle;
	}
	public function company($company){
		$this->company=$company;
	}
	public function requirement($requirement){
		$this->requirement=$requirement;
	}
	public function postedDate($posteddate){
		$this->posteddate=$posteddate;
	}
	public function appliedDate($applieddate){
		$this->applieddate=$applieddate;
	}
	public function contactPerson($contactperson){
		$this->contactperson=$contactperson;
	}
	public function source($source){
		$this->source=$source;
	}
	
	public function compskill($compskill){
		$this->compskill=$compskill;
	}
	public function proglang($proglang){
		$this->proglang=$proglang;
	}
	public function compsoft($compsoft){
		$this->compsoft=$compsoft;
	}
	public function sciapp($sciapp){
		$this->sciapp=$sciapp;
	}
	public function otherskill($otherskill){
		$this->otherskill=$otherskill;
	}
	public function goal($goal){
		$this->goal=$goal;
	}
	public function persletterfunc($persLetter){
		$this->persletter=$persLetter;
	}
}
//view vacant jobs 
class view extends DBconnect{
	public function viewquery($id){
		$connection= $this->connect();
		$query= $connection->prepare("SELECT * FROM `jobs` WHERE UId=$id");
		 $query->execute();
		 return $query;
		 	
	  	}
	public function vacantJob($category,$country,$city){
		$connection= $this->connect();
		$query= $connection->prepare("SELECT * FROM `vacantjobs` WHERE Category LIKE '$category' AND Country LIKE '$country' AND City LIKE '$city'");
		$query->execute();
		return $query;
		
	}
	
}

//job applications to be viewed by the company
class indexviewClass extends DBconnect {
	

	public function indexviewQuery($company,$jobtitle,$contactPerson,$id){
		$connection= $this->connect();
		$query= $connection->prepare("SELECT * FROM `jobs`  INNER JOIN `cv` ON jobs.Id_jobs = cv.jobId
                                                            INNER JOIN `personalletter` ON jobs.Id_jobs = personalletter.jobId 
				            WHERE  `company` like '$company' AND `jobTitle` like '$jobtitle' AND `contactPerson` like '$contactPerson' AND `Id_jobs` like '$id' ");
		$query->execute();
		return $query;
			
	}
	
}

//Delete the applied jobs
class delete extends DBconnect {
	
	public function removeAppliedJob($id){
		$connection= $this->connect();
		$query= $connection->prepare("DELETE FROM `jobs` WHERE `Id_jobs` LIKE '$id' ");
		$query->execute();
		return true;
		
	}
}

//Register a vacant job
class registerVacantJobs extends DBconnect {
	public function insertJobs($title,$category,$country,$city,$link,$summery,$description,$lastdate) {
		$connection= $this->connect();
		$query= $connection->prepare("INSERT INTO `vacantjobs`(`Category`, `Country`, `City`, `Title`, `intro`, `link`, `Description`, `lastDate`) 
				VALUES ('$category','$country','$city','$title','$summery','$link','$description','$lastdate')");
		$query->execute();
		header("Location: job application.php?user=company");
		
	}
	
}
class viewVacantJobs extends DBconnect {
	public function displayVacantJobs($id) {
		$connection= $this->connect();
		$query=$connection->prepare("SELECT * FROM `vacantjobs` WHERE `companyId` LIKE '$id'");
		$query->execute();
		return $query;
	}
	public function delete($id){
		$connection= $this->connect();
		$query=$connection->prepare("DELETE FROM `vacantjobs` WHERE `Id` LIKE '$id'");
		$query->execute();
		
	}
	public function increamentViews($id,$view){
		$connection= $this->connect();
		$query=$connection->prepare("UPDATE `vacantjobs` SET `View` = '$view' WHERE `Id` LIKE '$id'");
		$query->execute();
	
	}
	
}



?>