<?php
    if(!isset($_SESSION)){ session_start();}
	$_SESSION["campus"]=$_GET["campus"];
	include_once 'config.php';

    /*include_once 'config.php';
    if(!isset($_SESSION)){ session_start();}*/

    $locdesc='';
	//get the id code of the location
	if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
		$loc= $_GET['id']; //location

		$sql2 = mysqli_query($link,"SELECT locdesc FROM tbl_location WHERE locid='$loc'");
		$row2=mysqli_fetch_array($sql2);
		if(is_array($row2)){
			$locdesc=$row2['locdesc'];
		}

	}

	include_once("splash-nav.php"); 

?>

<?php
   $fn=$regid='';
   $show=0;
	if($_SERVER["REQUEST_METHOD"]=="POST"){	
	    if (isset($_POST['btnno'])){
	         $show=0;
	    }
	    
		if (isset($_POST['btnsearch'])) {
			//manila time
			date_default_timezone_set('Asia/Manila');
		    $today = strtotime(date("y-m-d h:i:sa"));
		    $hdate= date("Y-m-d", $today);
		  
			$sql = mysqli_query($link,"SELECT * FROM tbl_healthsurvey WHERE regid=UCASE('$_POST[regid]') and hdate ='$hdate'");
			if(!$sql){
			   die('Error '.mysqli_error($link));
			} 

			$row=mysqli_fetch_array($sql);
	   			if(is_array($row)){
	   				$regid=$row['regid'];      //regid
	   					$sql1 = mysqli_query($link,"SELECT * FROM tbl_reg WHERE regid=UCASE('$_POST[regid]')");
	   					$row1=mysqli_fetch_array($sql1);
				   			if(is_array($row1)){
				   				$fn=$row1['fullname'];
				   				$show=1;
				   			}else{
				   					
	   						}
				}else{
					$regid='';
	   				$fn='';
	   				$show=0;
	   				echo"<div class=\"alert alert-danger\" id=\"d\" style=\"display:block\">Contact tracing only available!, once the Health Survey Form accomplished! </div>
							  <script>
							  		window.setTimeout(\"closeD();\", 10000);
							  		function closeD(){
										document.getElementById(\"d\").style.display=\"none\";
									}
							  </script>
					    ";	
				}
		}

		if (isset($_POST['log'])) {
		    $ctr=0;
				date_default_timezone_set('Asia/Manila');
			    $today = strtotime(date("y-m-d h:i:sa"));
			    $hdate= date("Y-m-d", $today);
			    $gettime= date("H:i:s", $today);
			  	
                
			  $sql = mysqli_query($link,"SELECT * FROM tbl_contracing WHERE regid=UCASE('$_POST[regid]') and hdate ='$hdate' and location='$loc' and timeout='00:00:00'");
			  $row=mysqli_fetch_array($sql);	
			  if(is_array($row)){

			  	$sql4 = "UPDATE tbl_contracing SET timeout= '$gettime' WHERE regid=UCASE('$_POST[regid]') and hdate ='$hdate' and location='$loc' and timeout='00:00:00' ";

								if(mysqli_query($link, $sql4)){
									echo"	<div class=\"alert alert-success\" id=\"s\" style=\"display:block\">
										     Log-out successful! 
										</div>

									<script>
											window.setTimeout(\"closeS();\", 10000);
											function closeS(){
											document.getElementById(\"s\").style.display=\"none\";
										}
									</script>
									";
								}
			  }else{
                $timeout='00:00:00';
              
			  	$sql3 = "INSERT INTO tbl_contracing (regid,	hdate,	timein, timeout, location)
								VALUES (UCASE('$_POST[regid]'),'$hdate','$gettime','$timeout','$loc')";

							if(mysqli_query($link, $sql3)){
								echo"	<div class=\"alert alert-success\" id=\"s\" style=\"display:block\">
									     Log-in successful!
									</div>

								<script>
										window.setTimeout(\"closeS();\", 10000);
										function closeS(){
										document.getElementById(\"s\").style.display=\"none\";
									}
								</script>
								";
							}
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

</head>

<div class="container-xl">
	<div class="row">
		<div class="col-md-8 mx-auto">
			<div class="contact-form">
				<b><h1><?php echo $locdesc;?></h1></b>
				<form action="" method="POST">
					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label  for="regid"> ID Number </label>
								<input type="text" name="regid" id="regid" value="<?php echo $regid;?>" class="form-control" placeholder="Employee ID/Student ID/Visitor or Worker ID" required />
							</div>
						</div>
					</div>            
					
					<div class="row">
						
						<div class="col-sm-12">
							<div class="form-group">	
								<input type="submit" name="btnsearch" id="btnsearch" class="btn btn-primary" value="Search" style='width: 100%;'><!--style="visibility:hidden;"-->
							</div>
						</div>
						
						</div>
					</div>
					<div class="row">
					<div class="col-sm-1"> </div>
					<div class="col-sm-6">
							<div class="form-group">
								<p> <?php if($show==1)echo'Are you '; else{echo' ';}?>

								<b for="fullname"><?php if($show==1) echo $fn.'? ';else{echo' ';}?></b><br><br></p>
							</div>
						</div>
					
					
						<div class="col-sm-5" <?php if($show==1){echo' style="visibility:show"; ';}else {echo' style="visibility:hidden"; ';}?> >
							<div class="form-group">	
								<input type="submit" name="log" id="log" class="btn btn-info" value="Yes" <?php if($show==1){}else{echo'disabled';} ?>>

								<input type="submit" name="btnno" onclick="location.replace('contrace.php?campus='<?php echo $_GET['campus']; ?>'&id='<?php echo $_GET['id']; ?>)" class="btn btn-danger" value="No">

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