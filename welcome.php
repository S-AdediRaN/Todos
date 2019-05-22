<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";




$todoitem = $_SESSION['list'] = $_POST['todoEntry'];
$username = $_SESSION["username"];
$itemdone = NULL;
$itemindex = ($_SESSION['getnextindex']);

if($_POST['addactivity']){
//unset($_SESSION['getnextindex']);
    
$sql = "INSERT INTO todolist ( username , todoitem , itemdone , itemindex ) VALUES ( '$username' , ' $todoitem' , '$itemdone' , '$itemindex') ";

if($mysqli->query($sql)){
//    echo "Done";
}else{
    exit;
}
    
	header("location: welcome.php");

}

//
//$sql = "SELECT * FROM userprofile WHERE username ='$username'";
//$query = $mysqli->query($sql);
//$result ='';
//
//if($result){
//    $welcome = $result[0]["name"];
//}else{
//    exit;
//}
//
//
//
//$sql = "SELECT todoitem FROM todolist WHERE username = '$username' ";
//$query = $mysqli->query($sql);
//$result ='';
//
//if($result){
//    echo "I have your items";
//
//}
$result = mysqli_query($mysqli,"SELECT username FROM todolist WHERE username = '$username'");
if (!$result) {
    echo 'Could not run query: ' . mysqli_error($mysqli);
    exit;
}
$row = mysqli_fetch_row($result);
$name = $row[0];


$result = mysqli_query($mysqli,"SELECT todoitem FROM todolist WHERE username = '$username'");
if (!$result) {
    echo 'Could not run query: ' . mysqli_error($mysqli);
    exit;
}
$row = mysqli_fetch_row($result);


?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome To Your TodoApp</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
		<meta name="viewport" content="width=device-width , initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Josefin+Sans" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="css/styles.css">
<!--===============================================================================================-->
</head>
<body>
   
<div class="wrapper">
			
	
          <div class="main-container">	
			<div class="container" id="first-container">
					<header>
						<div class="main-header">
                            <h4> <i class="fas fa-user-circle"></i> Welcome <?php echo $name; ?></h4>
							<h1><i class="fas fa-tasks" style= "color: red;"></i>TimeKeeper</h1>
							<a href="logout.php"><p class="button"><i class="fas fa-power-off" style= "color: red;"></i>&nbsp; Sign Out of Your Account</p></a>
                            <a href="reset-password.php"><p class="button"><i class="fas fa-redo-alt" style= "color: red;"></i>&nbsp; Reset Your Password</p></a>
							
						</div>
					</header>
			</div><!--container-->
		

		
			<div class="container" id="second-container">
					<header>
						<div id="inner1">
							<div id = "inner2">
									     <!---- Form to catch user Input--->
									<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = "post">
										<input type="submit"  name = "addactivity" style="position: absolute; left: -9999px"/>
										<h3>My ToDo List</h3>
										<input type="text" name = "todoEntry" id = "todoEntry" placeholder=" Enter your Todo list here......">
									</form>
							</div>
<?php
		
     $_SESSION['getnextindex'] = COUNT($result);	
        
		foreach( $result as $listitem){
            foreach($listitem as $items){
                echo "<ul class = \"list\">";
                if($items != "")// SANITIZED HERE
                echo "<li class = \" button1\">"."<i class=\"far fa-circle\">"."</i>&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;$items&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"far fa-trash-alt\"></i>"."</li>"."<br>";
                echo "</ul>";
            }
		}
		
		
?>


                            
                            
                            
                            

						</div>
					</header>
			</div><!--container-->
			  
			  
		</div><!--main-container-->
				
		</div><!--wrapper-->	
			
			
	        <footer>
				<div class="footer">
					<p class="copyright">&copy; Oluwasina Adediran Codespace</p>
				</div>
			</footer>
			
			
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
		<script>
  $(document).ready(function(){
    var itemStrick= 0;
      $('li').each(function(i) {
          $(this).click(function(){
            checkNum = i;
            if(itemStrick == 0){
                   $(this).css("text-decoration", "line-through");
                    $(this).css("color", "red");
                
                   itemStrick = 1;
                   sessionStorage.setItem(checkNum,itemStrick);

            }else{
                    $(this).css("text-decoration", "none");
                    $(this).css("color", "white");
                    itemStrick = 0;
                    sessionStorage.setItem(checkNum,itemStrick);

           }
       });
      });
      $('li').each(function(i) {
         if(sessionStorage.getItem(i)==1){
            $(this).css("text-decoration", "line-through");
            $(this).css("color", "red");
          }
      });
      
  });
  
  </script>
</body>
</html>