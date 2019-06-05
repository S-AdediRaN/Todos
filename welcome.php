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
}else{
    exit;
}
    
	header("location: welcome.php");

}
$result = mysqli_query($mysqli,"SELECT username,id FROM todolist WHERE username = '$username'");
if (!$result) {
    echo 'Could not run query: ' . mysqli_error($mysqli);
    exit;
}
$row = mysqli_fetch_row($result);
$name = $row[0];


$results = mysqli_query($mysqli,"SELECT todoitem FROM todolist WHERE username = '$username'");
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
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

     <link rel="stylesheet" href="dist/material-datetime-picker.css">
</head>
<body>
   
<div class="wrapper">
			
	
          <div class="main-container">	
			<div class="container" id="first-container">
					<header>
						<div class="main-header">
                            <h4> <i class="fas fa-user-circle"></i> Welcome <?php echo $username; ?></h4>
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
										<h3>My ToDo List</h3>
                                        <div class = "inputs">
										<input type="text" name = "todoEntry" id = "todoEntry" placeholder=" Enter your Todo list here......">
                                        <input type="submit"  name = "addactivity" value = "Add Task"/ class ="adds button"  ><a class = "cancel"> Cancel</a>
                                        </div>
                                        <p class="action action_add_item"><span class="icon icon_add"><svg width="13" height="13" viewBox="0 0 13 13" xmlns="http://www.w3.org/2000/svg" data-svgs-path="sm1/plus.svg"><path d="M6 6V.5a.5.5 0 0 1 1 0V6h5.5a.5.5 0 1 1 0 1H7v5.5a.5.5 0 1 1-1 0V7H.5a.5.5 0 0 1 0-1H6z" fill="currentColor" fill-rule="evenodd"></path></svg></span>Add Task</p>
                                    </form>
                                
							</div>
                            
                        
                            
                            
                            
<?php
$qry = mysqli_query($mysqli,"SELECT * FROM todolist WHERE username = '$username'");
        while($row = mysqli_fetch_array($qry)){
                echo "<ul class = \"list$row[0]\">";
                echo "<li class = \" button1 edit\" contentEditable='false' id = \"name_$row[0]\">"."<i class=\"far fa-circle\">"."</i>&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;$row[2]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class=\"far fa-trash-alt\" onclick =\"deleteAjax($row[0])\"></i> <i class=\"far fa-calendar c-btn c-datepicker-btn\"></i>"."</li>"."<br>";
                echo "</ul>";
            }
		
		
?>

<!--
<div class = "calender">
    <h2> Calender</h2>  <i class="fas fa-plus"></i>
    <form>
    <input type = "date">
        
    </form>
</div>
-->
                                    
                        </div>
					</header>

  <pre id="output"></pre>
			</div><!--container-->
			  
		</div><!--main-container-->

		</div><!--wrapper-->	
			
			
	        <footer>
				<div class="footer">
					<p class="copyright">&copy; Oluwasina Adediran Codespace</p>
				</div>
			</footer>
		
			
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
          <script src="https://unpkg.com/babel-polyfill@6.2.0/dist/polyfill.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/rome/2.1.22/rome.standalone.js"></script>
          <script src="dist/material-datetime-picker.js" charset="utf-8"></script>
		<script>
  $(document).ready(function(){
    var itemStrick= 0;
      $('li').each(function(i) {
          $(this).click(function(){
            checkNum = i;
            if(itemStrick == 0){
                   $(this).css("text-decoration", "line-through");
                    $(this).css("color", "gray");
                    $(this).find('.fa-circle').addClass('fas fa-check-circle').removeClass('far fa-circle');
                
                
                   itemStrick = 1;
                   sessionStorage.setItem(checkNum,itemStrick);

            }else{
                    $(this).css("text-decoration", "none");
                    $(this).css("color", "white");
                    $(this).find('.fa-check-circle').removeClass('fas fa-check-circle').addClass('far fa-circle');
                    itemStrick = 0;
                    sessionStorage.setItem(checkNum,itemStrick);

           }
       });
      });
      $('li').each(function(i) {
         if(sessionStorage.getItem(i)==1){
            $(this).css("text-decoration", "line-through");
            $(this).css("color", "gray");
            $(this).find('.fa-circle').addClass('fas fa-check-circle').removeClass('far fa-circle');
             
          }
      });
      
    const $menuButton = $('.cancel');
    const $navDropdown = $('.inputs');
    $menuButton.on('click',()=>{
      $navDropdown.hide("slow");
      $('.action_add_item').show("slow");
    });
    
    const $addtask = $('.action_add_item');
    const $dropdown = $('.inputs');
    $addtask.on('click',()=>{
      $dropdown.show("slow");
      $addtask.hide("slow");
    });

      
        $('.edit').dblclick(function(){
        let contenteditable="true";
        $(this).addClass('editMode');
    
    });

    // Save data
    $(".edit").focusout(function(){
        $(this).removeClass("editMode");
 
        var id = this.id;
        var split_id = id.split("_");
        var field_name = split_id[0];
        var edit_id = split_id[1];

        var value = $(this).text();
     
        $.ajax({
            url: 'update.php',
            type: 'post',
            data: { field:field_name, value:value, id:edit_id },
            success:function(response){
                console.log('Save successfully');               
            }
        });
                
    });
      
  });

    var picker = new MaterialDatetimePicker({})
      .on('submit', function(d) {
        output.innerText = d;
      });

    var el = document.querySelector('.c-datepicker-btn');
    el.addEventListener('click', function() {
      picker.open();
    }, false);
            
            
            
            
  
  </script>
  <script type = "text/javascript">
      function deleteAjax(id){
              $.ajax({
                  type: 'post',
                  url:'delete_data.php',
                  data: {delete_id:id},
                  success:function(data){
                  $(".list"+id).hide("slow");
                  }
                  
              });
              
             
      }
    
  </script>
</body>
</html>