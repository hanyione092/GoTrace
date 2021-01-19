<?php
	if(!isset($_SESSION)){ session_start();}
	$_SESSION["campus"]=$_GET["campus"];
	include_once 'config.php';
	include_once("splash-nav.php"); 
?>

<?php
	if($_SERVER["REQUEST_METHOD"]=="POST"){	

	  //check if exist
	  $sql = mysqli_query($link,"SELECT * FROM tbl_reg WHERE regid='$_POST[regid]'");
	   if(!$sql){
	  		die('Error '.mysqli_error($link));
	   }

	   $row=mysqli_fetch_array($sql);
	   if(is_array($row)){
	   		echo"<div class=\"alert alert-danger\" id=\"d\" style=\"display:block\"> ID Number already exist! </div>
				  <script>
				  		window.setTimeout(\"closeD();\", 10000);
				  		function closeD(){
							document.getElementById(\"d\").style.display=\"none\";
						}
				  </script>
		  ";

	   }else{
	   		//update counter visitor/worker
	   	  if(($_POST['usertype']=='2')||($_POST['usertype']=='4')){
	   	  	$row = mysqli_fetch_assoc(mysqli_query($link, "SELECT regctr FROM tbl_regctr WHERE usertype='$_POST[usertype]'"));
			$regctr = $row['regctr'] +1;

	  		$sql = "UPDATE tbl_regctr SET regctr='$regctr' WHERE usertype='$_POST[usertype]'";
	  		mysqli_query($link, $sql);
	   	  }
            
			//Insert to the registration table
	   		$sql = "INSERT INTO tbl_reg (usertype, regid, fullname, age, sex, address, contactno,email, office)
		  			VALUES ('$_POST[usertype]','$_POST[regid]',UCASE('$_POST[fullname]'), '$_POST[age]','$_POST[sex]',UCASE('$_POST[address]'),'$_POST[contactno]','$_POST[email]',UCASE('$_POST[office]'))";

	  		if(mysqli_query($link, $sql)){
	  			    $_SESSION['splash'] = false;
	  			    //header("location: thankyou.php");
	  			    echo"<script> 
                        window.location='thankyou.php';
                      </script>";
	  			    
                    exit();

				/*echo"	<div class=\"alert alert-success\" id=\"s\" style=\"display:block\">
					     All responses submitted successfully!
					</div>

			  <script>
			  		window.setTimeout(\"closeS();\", 10000);
			  		function closeS(){
						document.getElementById(\"s\").style.display=\"none\";
					}
			  </script>
			  ";*/
			} 

	   }
   }
?>


<?php 
include_once("header.php"); 

?>

<style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: "Open Sans", sans-serif;
}
.contact-form {
    padding: 50px;
    margin: 30px 0;
}
.contact-form h1 {
    text-transform: uppercase;
    margin: 0 0 15px;
}
.contact-form .form-control, .contact-form .btn  {
    min-height: 38px;
    border-radius: 2px;
}
.contact-form .btn-primary {
    min-width: 150px;
    background: #299be4;
    border: none;
}
.contact-form .btn-primary:hover {
    background: #1c8cd7; 
}
.contact-form label {
    opacity: 0.9;
}
.contact-form textarea {
    resize: vertical;
}
.hint-text {
    font-size: 15px;
    padding-bottom: 15px;
    opacity: 0.8;
}
.bs-example {
    margin: 20px;
}

</style>


<div class="container-xl">
	<div class="row">
		<div class="col-md-8 mx-auto">
			<div class="contact-form">
				<h1>Registration</h1>
				<form action="" method="POST">
					<div class="row">
						<div class="col-sm-6">

							<div class="form-group">
								<label for="usertype">User type <small style="color:red">*</small></label>
								<select name="usertype" id="usertype" class="form-control"  onchange="myFunction()" required/> 
									<!--<option ></option>
									<option value="1">Faculty/Staff</option>
									<option value="2">Worker</option>
									<option value="3">Student</option>
									<option value="4">Visitor</option>-->


									<?php
				                        $sqli = "SELECT userdesc FROM tbl_usertype";
				                        $result = mysqli_query($link, $sqli);

				                        while ($row = mysqli_fetch_array($result)) {
				                          if(strcmp($usertype, $row['userdesc'])==0){
				                            continue;
				                          }
				                          
				                          $usertype= $row['userdesc'];

				                         $sql = "SELECT * FROM tbl_usertype where userdesc='$usertype'";
				                                $res = mysqli_query($link, $sql);
				                                while ($row = mysqli_fetch_array($res)) {
				                                  echo '<option value="'.$row['userid']. '">'.$row['userdesc'].'</option>';
				                                }

				                        }
				                     
				                      ?>  

								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label  for="regid">ID Number <small style="color:red">*</small></label>

								<script>
									function myFunction() {
									  var x = document.getElementById("usertype").value;
									  if (x==5){
									  	<?php 
										  	$sql = "SELECT userctr FROM tbl_usertype where userid='5'";
				                     		$row = mysqli_fetch_array(mysqli_query($link, $sql));
			                     		?>
			                     		document.getElementById("regid").readOnly = true;
			                			document.getElementById("regid").value="WORKER" + <?php echo $row['userctr'] +1; ?>
			                			<?php $pattern=""; ?>
									  }else if (x==4){
									  	<?php 
										  	$sql = "SELECT userctr FROM tbl_usertype where userid='4'";
				                     		$row = mysqli_fetch_array(mysqli_query($link, $sql));
			                     		?>
			                			document.getElementById("regid").readOnly = true;
			                			document.getElementById("regid").value="VISITOR" + <?php echo $row['userctr'] +1; ?>
									  	<?php $pattern=""; ?>
									  }else{
									  	document.getElementById("regid").readOnly = false;
									  	document.getElementById("regid").value='';
									  	<?php $pattern="pattern='[0-9]{4}[-].{3,}'"; ?>
									  }


									}
							     </script>

								<input type="text" name="regid" id="regid" style="background-color:white;" class="form-control" 
								<?php
									echo $pattern;
								?>
								required/> 
							</div>
						</div>
					</div>            
					
					<div class="form-group">	
						<label for="fullname">Fullname <small style="color:red">*</small></label>
						<input type="text" name="fullname" class="form-control" placeholder="Firstname M.I Lastname" required/> 
					</div> 

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="age">Age <small style="color:red">*</small></label>
								<input type="number" name="age" min=1 class="form-control" required/> 
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
						        <label for="sex">Sex <small style="color:red">*</small></label>
						        <select name="sex"  class="form-control" required >
						        	<option ></option>
						        	<option value="M">Male</option>
						        	<option value="F">Female</option>
						        </select>
							</div>
						</div>
					</div>  

					<div class="form-group">
						<label for="address">Address <small style="color:red">*</small></label>
						<textarea class="form-control" name="address" rows="5" placeholder="House Number/ Street/ Brgy/ Town/ Municipality "style="resize: none;" required></textarea>	
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="contactno">Contact Number<small style="color:red">*</small></label>
								<!--<input type="tel" name="contactno"  class="form-control" pattern="[\+\6\3][0-9]{10}" minlength="13" maxlength="13" required/> -->
								<input type="tel" name="contactno"  class="form-control" pattern="[0-9]{11}" minlength="11" maxlength="11" placeholder="e.g. 09000000000" required/> 
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
						        <label for="email">Email Address <small style="color:red">*</small></label>
								<input type="email" name="email"  class="form-control" required/> 
							</div>
						</div>
					</div>  
					
					<!--New code-->
					<div class="form-group">
						<label for="office">Work Station/Office <small style="color:red">*</small></label>
						<input type="text" name="office"  class="form-control" required/> 	
					</div>
					
					
				<div class="row">
					<div class="col-sm-12">
												<div class="form-group">

					 <input type="submit" name="submit" class="btn btn-primary" value="Register" style="width:100%;">
					 </div>
					 					 </div>

					 </div>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>