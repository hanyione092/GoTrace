<?php 
error_reporting(E_ALL & ~E_NOTICE);

 ?>

<style type="text/css">
body {
    color: #566787;
    background: #f5f5f5;
    font-family: "Open Sans", sans-serif;
}
h1{
	color:##182f93;
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
#Splash {
	 position: fixed; /* Sit on top of the page content */
height: 100%;
  width: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
    -moz-animation: cssAnimation 0s ease-in 5s forwards;
    /* Firefox */
    -webkit-animation: cssAnimation 0s ease-in 5s forwards;
    /* Safari and Chrome */
    -o-animation: cssAnimation 0s ease-in 5s forwards;
    /* Opera */
    animation: cssAnimation 0s ease-in 5s forwards;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
      
  background: background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(19,134,40,1) 0%, rgba(137,205,76,1) 100%); 
  z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
  cursor: pointer; /* Add a pointer on hover */
}
@keyframes cssAnimation {
    to {
        width:0;
        height:0;
        overflow:hidden;
    }
}
@-webkit-keyframes cssAnimation {
    to {
        width:0;
        height:0;
        visibility:hidden;
    }
}


.splashimg{
 	 display: block;
 	 margin: auto;
 	 	margin-top:20%;

 	 	width:85%;

}
@media (min-width: 375px) {
  .splashimg {
  	 	 	margin-top:40%;
 	width:80%;

		    }
}
@media (min-width: 576px) {
  .splashimg {
  	 	 	margin-top:20%;

 	width:65%;
 		padding:12%;

		    }
}

@media (min-width: 768px) {
 .splashimg {
 	 	 	margin-top:0%;

 	width:45%;
	padding:12%;


  }

  @media (min-width: 812px) {
 .splashimg {
 	 	 	margin-top:0%;

 	width:35%;
	padding:8%;

    }
  }

* {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            font-family: 'Josefin Sans', sans-serif;
        }

        .navbar {
            font-size: 18px;
background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(19,134,40,1) 0%, rgba(137,205,76,1) 100%);            padding-bottom: 10px;
        }

        .logo {
        	 display: block;
 	 margin: auto;
            display: inline-block;
            margin-top: 5px;
            margin-left: 15px;
        }

@media (min-width: 375px) {

        .navbar {max-height:20px;}

}
        @media screen and (min-width: 768px) {

            .logo {
            	        	 display: block;
                margin-top: 0;
            }
                    .navbar {max-height:100px;}


        }


</style>

<?php session_start();
if(!$_SESSION['splash'])
{
    $_SESSION['splash'] = true;

    echo "<div id='Splash'>
        <img src='Drop1.png' class='splashimg' />
    </div>";
  }
 

?>
<nav class="navbar" style="background: background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(19,134,40,1) 0%, rgba(137,205,76,1) 100%); ">
<a href="#" class="logo"><img src="WiTR-rectangle-2.png" style="height:64px" /></a>       
</nav>
