<?php
include 'mainClasses.php';
?>
<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="index.css">
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Old Standard TT">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="javascript.js"> </script>
<meta name="viewport" content="width:device-width, initial-scale=1.0">
<title> <?php echo"Wendwossen Anjelo"; ?></title>
</head>
<body>
	
	
	 <div id="whole"> <!--#whole starts-->
		<div id="container"><!--#container starts-->
            <div id="tabs">
            <p class="icon">jobLiked.com</p>
            <div class="login"><!--#login starts-->
			 
			<ul class="flags">
			<li><a href="sv/index.php"><img alt="Swedish" src="Swedish.png" ></img></a></li>
			<li><a href="da/index.php"><img alt="Swedish" src="Danish.png" ></img></a></li><li><a href="no/index.php"><img alt="English" src="Norwagian.png" ></img></a></li> 
			<li><a href="fi/index.php"><img alt="English" src="Finish.png" ></img></a></li><li><a href="index.php"><img alt="English" src="English.png" ></img></a></li>
			</ul>
			<span class="loginTxt">
			 login as&nbsp<a href="login.php?user=jobseeker">Jobseeker</a>&nbsp/&nbsp
			<a href="login.php?user=company">Company</a>
			</span>
			</div><!--#login Ends--> 
            </div><!--#tabs Ends-->
			<div id="toprightContainer">
             <ul>
             <li class="topright"><a href="">Home</a></li>
             <li class="topright"><a href="">About us</a></li>
             <li class="topright register"><a href="">Register</a>
              <ul class="submenuRegister">
               <li><a href="register.php?user=jobseeker">Job Seeker</a></li>
               <li><a href="register.php?user=company">Company</a></li>
               </ul>
             
             
             </li>
             <li class="topright vacant"><a href="">Vacant jobs</a>
             <ul class="submenuVacant">
               <li ><a href="search.php?method=search">Search Jobs</a></li>
               <li><a href="search.php?method=all">All jobs</a></li>
              </ul>
             
             </li>
             </ul>
            </div>
            
		       
	
  
<?php 
//checks if the variables are set
if(isset($_GET['company']) AND isset($_GET['jobTitle']) AND isset($_GET['contactPerson']) AND isset($_GET['Id'])): 
 //instantiate the indexviewClass class

 $userId = new indexviewClass();
//check if the intended job application exists
   $query= $userId->indexviewQuery($_GET['company'],$_GET['jobTitle'],$_GET['contactPerson'],$_GET['Id']);
   $numb= $query->fetchAll();
   $user_count= count($numb);
 //if it exists  
 if($user_count > 0):
   ?> 
                
<div id="clear"></div>		     
<div id="buttonsContainer"><!--#buttonsContainer starts-->
<a  onclick="home()" href="javascript:void(0)">
<div class="home">
<p>My Profile</p>
</div>
</a>
<a id="cv" onClick="cv()" href="javascript:void(0)">
<div class="cv">
<p>CV</p>
</div>
</a>
<a id="personalLetter" onclick="personalLetter()" href="javascript:void(0)">
<div class="personalLetter">
<p>Personal Letter</p>
</div>
</a>
</div><!--#buttonsContainer Ends-->



		<div id="home"><!--#home starts-->
		      
        <?php  echo '<div class="introTitle"> Welcome! </div>';
			  echo '<div class="introClass"> 
		Hello '.$_GET['contactPerson'].', welcome to my online job application page. My name is Wendwossen Anjelo, 
		currently working in Lionbridge technologies as Internet Search Administrator based in Stockholm Sweden.</br></br>
		I am applying for <strong>'.$_GET['jobTitle'].'</strong> job opening for <strong>'.$_GET['company'].'</strong>. 
		So on this page, you can find my application documents which can support my application.Thank you!

			           </div>';	?>
	     
        </div><!--#home Ends--> 
        
        
 
      
<div id="cvContainer"><!--#cvContainer starts--> 


<?php 
//create a new object for viewing the informations
$cvView = new indexviewClass();
$result  = $cvView->indexviewQuery($_GET['company'],$_GET['jobTitle'],$_GET['contactPerson'],$_GET['Id']);
foreach($result->fetchAll(PDO::FETCH_ASSOC) as $row):

?>
<table>
<tr>
   <td><p></p></td><td></td>
</tr>
<tr>
<td><p><img width="150px" height="auto" src="wendwossen Anjelo1.jpg"></img></p></td><td> <div>Wendwossen Anjelo</div>
               <div>kungsklippan 20</div>
               <div>112 25</div>
              <div>wendeworku@gmail.com</div>
              <div>+46738956203</div>
        </td>
</tr>

<tr>
  <td><p>PROFILE:</p></td><td></td>
</tr>
   <td><td><textarea class="txtAreaGoal" readonly><?php echo $row['goal']?></textarea>
       </td>
</tr>          
<tr>
   <td><p>EXPERIENCE:</p></td><td></td>
</tr>
<tr>
<td><p>Mar. 2013 to Current</p></td><td>Internet Search Administrator, LionBridge Technologies</td>
</tr>
<tr>
<td></td><td>
            <div>Responsibility:</div>
            <div>-Microsoft search engine optimization test.</div>
            <div>-Windows store test.</div>
        </td>
</tr>
<tr>
<td><p>Oct. 2005 to Aug. 2008</p></td><td>Electrical Engineer, Ethiopian Electrical Power Coorporation</td>
</tr>
<tr>
<td></td><td>
             <div>Responsibility:</div>
            <div>-Design electrical network.</div>
            <div>-Team leader in rural electrification projects.</div>
        </td>
</tr>
<tr>
<td><p>Jan. 2007 to Jun. 2007</p></td><td>Network Consultant, Gcompute Computer and Related Services</td>
</tr>
<tr>
<td></td><td>
             <div>Responsibility:</div>
            <div>-Computer Network Consultancy.</div>
            <div>-Computer Network design, troubleshoot and installation. </div>
        </td>
</tr>       
<td><p>Independent Project</p></td><td style="valign: bottom">
            <textarea class="txtAreaGoal"  readonly><?php echo "I've developed a couple of websites including the website that you are looking at the moment and a classified Ads website which is launched in August 2013.For the development, i mainly use PHP,Javascript,Jquery and CSS. ";?></textarea> 
            
              </td>
</tr>
<tr>
    <td><p>EDUCATION:</p></td>
</tr>
<tr>
<td><p>Sept. 2008 to Dec. 2009</p></td><td>Internet Systems (MSc), Blekinge Institute of Technology,  Sweden</td>
</tr>
<tr>
<td></td><td>
             <div>Thesis:&nbsp; Performance comparison of EIGRP/ISIS & OSPF/ISIS</div>
        </td>
</tr>
<tr>
<td><p>Sept. 2000 to Jul. 2005</p></td><td>Electrical Engineering (BSc), Jimma University,  Ethiopia</td>
</tr>
<tr>
<td></td><td>Thesis:&nbsp; Text to Speech Conversion in Java</p>
        </td>
</tr>
<tr>
<td><p>LANGUAGE:</p></td><td></td>
</tr>
<tr>
<td></td><td><div>Amharic: &nbsp; Mother tongue</p></div>
             <div>English:&nbsp; Full professional proficeny in spoken and written</p></div>
             <div>Swedish:&nbsp; very good in spoken and written</p></div>
        </td>
</tr>
<tr>
<td><p>TECHNICAL SKILLS:</p></td><td></td>
</tr>
<tr>
<!-- access diffrent infos from diff tables -->
<td></td><td>Computer Skills:&nbsp; <?php echo $row['computer_skill'];?></td>
</tr>
<tr>
<td></td><td>Programming Language:&nbsp; <?php echo $row['programming_language'];?></td>
</tr>
<tr>
<td></td><td>Computer Softwares:&nbsp; <?php echo $row['computer_softwares'];?></td>
</tr>
<tr>
<td></td><td>Scientific Applications:&nbsp; <?php echo $row['scientific_app'];?></td>
</tr>
<tr>
<td></td><td>Other Skills:&nbsp; <?php echo $row['other_skills'];?></td>
</tr>
             

        
<tr>
<td><p>INTEREST:</p></td><td></td>
</tr>
<tr>
<td></td><td>
             Physical exercise, reading books, watching movies, dancing salsa and swimming.
            

        </td>
</tr>
</table>
</div><!-- #cvContainer Ends -->
<div id="personalLetterContainer"><!-- #personalLetterContainer starts -->
<div id="letter">
<p>PERSONAL LETTER:</p>
</div>
 <textarea style="float:left;height:200px"readonly><?php echo $row['letter'];?></textarea>
 </div><!-- #personalLetterContainer Ends -->
<?php endforeach;?>
<?php 
//if the job doesn't exist
elseif($user_count <= 0):
    unset($_GET['jobTitle']);
    unset($_GET['company']);
endif;  //end the existance check statment
endif;  //end the variable set check statment
//redirect to the home page
if(!isset($_GET['company']) OR !isset($_GET['jobTitle']) OR !isset($_GET['contactPerson']) OR !isset($_GET['Id'])): 
?>
<div id="homePage">
<div class="introTitle"> Welcome! </div>
<div class="introClass"> 
	On this website, you can register your job application informations and retrive the information whenever needed. 
	A link will be sent to your email by the completion of the job registeration, You can make an online application for the job
	by sending the link to the contact person or it can also be send by us.</br></br>
	The aim of this website is to facilitate the traditional job application method which can help both the companies and the job seekers.
		
</div>
</div>
<?php endif;?>
				
</div>

<div id="clear"></div>

<div id="footer"><div class="copyright">&copy;2014 copyright jobLiked.com Allright reserved</div></div>
</div><!-- #container Ends -->
</div><!-- #whole Ends -->

</body>
</html>





