<?php
//a validation class for all forms
class validation {
	private $_error;
/*common validation for most forms*/
	public function password(){
        $_error = "enter the password";
		return $_error;
	}
	public function repassword(){
	
		$_error = "enter the password again";
		return $_error;
	}
	public function pass_error(){
	
		$_error = "The two passwords must be similar";
		return $_error;
	}
	public function email(){
		$_error = "enter the email";
		return $_error;
	}
	public function company(){
		$_error = "enter the name of the company";
		return $_error;
	}
/*validation for job application registration form*/	
	public function jobTitle(){
	
		$_error = "enter the Job Title";
		return $_error;
	}
	
	public function requirement(){
	
		$_error = "enter the requirment to the job";
		return $_error;
	}
	
	public function postedDate(){
		$_error = "enter the posted date";
		return $_error;
	}
	public function lastDate(){
		$_error = "enter the last date";
		return $_error;
	}
	public function contactPerson(){
	
		$_error = "enter the contact person's name";
		return $_error;
	}
	
	public function source(){
		$_error = "enter where you saw the post";
		return $_error;
	}
/*validation for user registration*/
	
	public function lastname(){
	    $_error = "enter your last name";
		return $_error;
	}
	public function name(){
		$_error = "enter your name";
		return $_error;
	}
/*Validation for registeration of vacant jobs*/

	public function category(){
		$_error = "Select Category";
		return $_error;
	}
	public function country(){
	
		$_error = "Select country";
		return $_error;
	}
	
	public function city(){
		$_error = "Select city";
		return $_error;
	}
	public function description(){
		$_error = "Write/paste the job description";
		return $_error;
	}
	public function summery(){
		$_error = "Write/paste summery of the job";
		return $_error;
	}
	public function link(){
		$_error = "Enter  the link to the job page";
		return $_error;
	}

}


?>