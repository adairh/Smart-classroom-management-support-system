<!-- this is the markup. you can change the details (your own name, your own avatar etc.) but don’t change the basic structure! -->
<?php
// Initialize the session  
session_start();
require_once "config.php";
if ($_SESSION["type"] !== "teacher"){
	$no = $_SESSION["no"];
	$type = $_SESSION["type"];
	$hinhanh = $hovaten = $namsinh = $gioitinh = $diachi = $vipham = "";
			$sql = "SELECT * FROM $type WHERE no = $no";
			
			$result = $link->query($sql);

				if ($result->num_rows > 0) {
					// output dữ liệu trên trang
					while($row = $result->fetch_assoc()) {	
					  
					  $hinhanh = $row['Hinhanh'];
					  $hovaten = $row['HovaTen'];
					  $namsinh = $row['Namsinh'];
					  $gioitinh = $row['Gioitinh'];
					  $diachi = $row['Diachi'];
					  $vipham = "(Empty)";
					  if ($row['Vipham'] !== NULL){
						  $vipham = $row['Vipham'];
					  }
					  
					  
						 
				   }
				}else{
					echo "No records matching your query were found.";
				}
			
				
			
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}

?>
<header>
<aside class="profile-card">

    <header>
	<?php
	
	?>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
		<?php $image = substr($hinhanh,1); ?>
        <a class="img" href="">
            <?php echo '<img src="'. $image .'" />';?>
        </a>
        
        <!-- the username -->
        <?php echo '<h1>'. $hovaten .'</h1>';?>
        
        <!-- and role or location -->
        <?php echo ' <h2>'. $namsinh .'</h2>';?>
    
    </header>
	<div class="type-1">
	
		<div>
			<table>
				<tr>
					<th><a href="reset-password.php" class="btn btn-1">
					  <span class="txt">Password</span>
					  <span class="round"><i class="fa fa-chevron-right"></i></span>
					</a></th>
					<th><a href="logout.php" class="btn btn-1">
					  <span class="txt">Sign Out</span>
					  <span class="round"><i class="fa fa-chevron-right"></i></span>
					</a></th>
				</tr>
			<table>
		</div>
	
	</div>

    <div class="information">
	


		<div class="dropdown">
			<table>
				<tr>
					<td>
						<button onclick="myFunction()" class="dropbtn">Địa chỉ</button>
						<div id="myDropdown" class="dropdown-content">
						  <?php  echo $diachi; ?>
						</div>
					</td>
					<td>
					  <button onclick="myFunction2()" class="dropbtn">Vi phạm</button>
					  <div id="myDropdown2" class="dropdown-content">
						<?php  echo $vipham; ?>
					  </div>
					</td>
				</tr>
				<tr>
					<td>
						<button onclick="myFunction()" class="dropbtn">Nhận xét</button>
						<div id="myDropdown" class="dropdown-content">
						  <?php  echo $diachi; ?>
						</div>
					</td>
					<td>
					  <button onclick="myFunction2()" class="dropbtn">Báo bài</button>
					  <div id="myDropdown2" class="dropdown-content">
						<?php  echo $vipham; ?>
					  </div>
					</td>
				</tr>
					
				
			</table>
						
		</div>

		


	</div>
    <!-- bit of a bio; who are you? -->
	
<!--
			<table>
				<tbody>
					<tr class="table-head">
						Địa chỉ</th>
						<th>Giới tính</th>
					</tr>
					<tr class="table-body">
						<td><?php /* echo $diachi; */ ?></td>
						<td><?php /* echo $gioitinh; */ ?></td>
					</tr>
				</tbody>
				<tfoot>
					<tr class="table-head">
						<th colspan="5" style ="text-align: center;font-size:20px;">Vi phạm</th>
					</tr>
					<tr class="table-body">
						<td colspan="5"><?php if($vipham === null){echo "Empty"; } else {echo $vipham;} ?></td>
					</tr>
				</tfoot>
			</table>
		</div>
-->
</aside>
<?php 
} else if ($_SESSION["type"] === "teacher"){
	$no = $_SESSION["no"];
	$type = "teacher";
	$monday = "";
	$user = $_SESSION["username"];
	$hinhanh = $hovaten = $namsinh = $gioitinh = $diachi = $vipham = "";
			$sql = "SELECT * FROM $type WHERE id = $no";
			
			$result = $link->query($sql);

				if ($result->num_rows > 0) {
					// output dữ liệu trên trang
					while($row = $result->fetch_assoc()) {	
					  
					  $hinhanh = $row['img'];
					  $hovaten = $row['fullname'];
					  $namsinh = $row['birthday'];
					  $gioitinh = $row['gentle'];
					  $diachi = $row['address'];
						  $mail = $row['mail'];
						  $stringParts = explode("/", substr($mail,2));
					  $email = $stringParts[2]."@".$stringParts[1];
					  $phone = $row['phone'];
					  $sub = $row['Subject'];
					  $monday = $sub;
						 
				   }
				   
				
					
				}else{
					echo "No records matching your query were found.";
				}
				$classes = "SELECT * FROM class_teacher WHERE $monday = '$user'";

				$result2 = $link->query($classes);
				$class = "";
				if ($result2->num_rows > 0) {
						while($row2 = $result2->fetch_assoc()) {	
							$class = $class."/".$row2['class'];
						}
					
					}else{
					echo "No records matching your query were found.";
				}
				
			
				
			
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
?>
					
<header>
<aside class="profile-card">

    <header>
	<?php
	
	?>
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/popup.css">
    <link type="text/javascript" href="js/popup.js">
	
	<link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
	<script src="fullcalendar/lib/jquery.min.js"></script>
	<script src="fullcalendar/lib/moment.min.js"></script>
	<script src="fullcalendar/fullcalendar.min.js"></script>
	
		<?php $image = substr($hinhanh,1); ?>
        <a class="img" href="">
            <?php echo '<img src="'. $image .'" />';?>
        </a>
        
        <!-- the username -->
        <?php echo '<h1>'. $hovaten .'</h1>';?>
        
        <!-- and role or location -->
        <?php echo ' <h2>'. $namsinh .'</h2>';?>
    
	<div class="type-1">
	
		<div>
			<table>
				<tr>
					<th><a href="reset-password.php" class="btn btn-1">
					  <span class="txt">Password</span>
					  <span class="round"><i class="fa fa-chevron-right"></i></span>
					</a></th>
					<th><a href="logout.php" class="btn btn-1">
					  <span class="txt">Sign Out</span>
					  <span class="round"><i class="fa fa-chevron-right"></i></span>
					</a></th>
				</tr>
			<table>
		</div>
	
	</div>
    </header>

    <div class="information">
		<div class="dropdown">
			<table>
				<tr>
					<td>
						<button onclick="myFunction()" class="dropbtn">Địa chỉ</button>
						<div id="myDropdown" class="dropdown-content">
						  <?php  echo $diachi; ?>
						</div>
					</td>
					<td>
					  <button onclick="myFunction2()" class="dropbtn">Số điện thoại</button>
					  <div id="myDropdown2" class="dropdown-content">
						<?php  echo $phone; ?>
					  </div>
					</td>
				</tr>
					
				<tr>
					<td>
					  <button onclick="myFunction3()" class="dropbtn">Email</button>
					  <div id="myDropdown3" class="dropdown-content">
						<?php  echo $email; ?>
					  </div>
					</td>
					<td>
					  <button onclick="myFunction4()" class="dropbtn">Môn dạy</button>
					  <div id="myDropdown4" class="dropdown-content">
						<?php  echo $sub; ?>
					  </div>
					</td>
				</tr>
				
				
				<tr>
						<button  onclick="document.body.classList.add('active')" class="dropbtn open-modal" data-modal="#modal1">Lớp dạy</button> 
						<!--	<div class="dropdown-content" onclick="document.body.classList.add('active')">
								<span >Lớp dạy</span>
								<div class="button-backgrounds">
									<div class="button-circle button-circle1"></div>
									<div class="button-circle button-circle2"></div>
									<div class="button-circle button-circle3"></div>
									<div class="button-circle button-circle4"></div>
								</div>
						</div>! -->
						
				</tr>
			</table>
													
		</div>
	</div>
</aside>



					
						<div class="wrapper">
							<div class="popup">
								<div class="popup-inside">
									<div class="backgrounds">
										<div class="background"></div>
										<div class="background background2"></div>
										<div class="background background3"></div>
										<div class="background background4"></div>
										<div class="background background5"></div>
										<div class="background background6"></div>
									</div>
								</div>
								
								<div class="content">
									<div class="content-wrapper">
										<div class="options">
										
						<?php 
						
						$tags = explode('/' , substr($class,1));
						foreach($tags as $i =>$key) {
							$num = 5+$i;
							$func = "myFunction" . $num . "()";
							$dr = "myDropdown" . $num ;
						
						
							echo '<button onclick="'. $func .'" class="dropbtn btnn">'. $key .'</button>';
							echo '	<div id="'.$dr .'" class="dropdown-content interact">';
							$result = $link->query("SELECT * FROM $key");

									
													
													
						?>
							
							
								
							  
							<section class="container">
							<button id="flip" class="flip">Flip Card</button>
							  <div id="card">
								
								<figure class="back">								
									<body>
											<div class="response"></div>
											<div id='calendar'></div>
									</body>
									<?php
										if (isset($_POST['upload'])){
											if(!empty($_POST['input_field'])){
												if ($_SERVER["REQUEST_METHOD"] == "POST") {
													
													$content = $_POST['input_field'];
													$dando = $monday+"_dando";
													$sqll = "UPDATE class_teacher SET $dando = '$content' WHERE class = '$key'";
													if(mysqli_query($link, $sqll)){
														echo "Thêm bản ghi thành công.";
													} else{
														echo "ERROR: Không thể thực thi $sql. " . mysqli_error($link);
													}
												}
											}
										}
									?>
								</figure>
								
								<figure class="front">Đánh giá học sinh
									<form method="POST">
									<div class="sidenav">
									  <select class="dropdown-btn">[Chọn học sinh] 
										<i class="fa fa-caret-down"></i>
										  <div class="dropdown-container">
										  
											<?php $user = "Empty"; foreach ($result as $row):
												 echo '<option class="dropdown-btn-child" value="' . $row['username'] . '">' . $row['HovaTen'] . '</option>';
												
												endforeach ?>
										  </div>
									  </select>
									</div>
									<div class="row">
									  <span>
										<input name="content" class="swing" id="artist" type="text" placeholder="Nội dung" />
									  </span>
									</div>
									<? //print_r( $_POST ); ?>
									<div class="container-contact1-form-btn">
										<button type="submit" name="sub" class="contact1-form-btn">
											<span>
												Send
												<i class="fa fa-long-arrow-right" aria-hidden="true"></i>
											</span>
										</button>
									</div>
									</form>
									<?php
										/*if (isset($_POST['sub'])){
											if(!empty($_POST['content'])){
												if ($_SERVER["REQUEST_METHOD"] == "POST") {
													$content = $_POST['content'];
													$user = $row['username'];
													$sqll = "UPDATE $key SET Vipham = '$content' WHERE username = '$user'";
													if(mysqli_query($link, $sqll)){
														echo "Thêm bản ghi thành công.";
													} else{
														echo "ERROR: Không thể thực thi $sql. " . mysqli_error($link);
													}
												}
											}
										}*/
									?>
								</figure>
							  </div>
							</section>
										<div>
												<span class="round close"><i class="fa fa-times" style="font-size: 20px;"></i></span>
										</div>		
							
							
							<?php
							echo '  </div>';
							
							}
						
							mysqli_close($link);
							?>				<div id="closeDiv">
												<a class="close" onclick="document.body.classList.remove('active')">Close</a>
											</div>
										</div>
									</div>
								</div>
									
							</div>
						</div>

<?php } ?>
<script>
function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
function myFunction2() {
        document.getElementById("myDropdown2").classList.toggle("show");
    }
function myFunction3() {
        document.getElementById("myDropdown3").classList.toggle("show");
    }
function myFunction4() {
        document.getElementById("myDropdown4").classList.toggle("show");
    }
function myFunction5() {
        document.getElementById("myDropdown5").classList.toggle("show");
    }
function myFunction6() {
        document.getElementById("myDropdown6").classList.toggle("show");
    }
    
function myFunction7() {
        document.getElementById("myDropdown7").classList.toggle("show");
    }
    
function myFunction8() {
        document.getElementById("myDropdown8").classList.toggle("show");
    }
    
function myFunction9() {
        document.getElementById("myDropdown9").classList.toggle("show");
    }
    
function myFunction10() {
        document.getElementById("myDropdown10").classList.toggle("show");
    }
    
function myFunction11() {
        document.getElementById("myDropdown11").classList.toggle("show");
    }
    
function myFunction12() {
        document.getElementById("myDropdown12").classList.toggle("show");
    }
    
function myFunction13() {
        document.getElementById("myDropdown13").classList.toggle("show");
    }
    
function closeDiv(){
		if (openDropdown.classList.contains('active')) {
        openDropdown.classList.remove('active');
      }
	}
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
window.onclick = function(event) {
  if (event.target.matches('.close')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

var card = document.getElementById('card');

document.getElementById('flip').addEventListener('click', function() {
    card.classList.toggle('flipped');
}, false);
$(".modal").each( function(){
	$(this).wrap('<div class="overlay"></div>')
});

$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "fetch-event.php",
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt('Event Title:');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                $.ajax({
                    url: 'add-event.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                    type: "POST",
                    success: function (data) {
                        displayMessage("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                true
                        );
            }
            calendar.fullCalendar('unselect');
        },
        
        editable: true,
        eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "delete-event.php",
                    data: "&id=" + event.id,
                    success: function (response) {
                        if(parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            displayMessage("Deleted Successfully");
                        }
                    }
                });
            }
        }

    });
});

function displayMessage(message) {
	    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}

</script>
<!-- that’s all folks! -->
<style>
body {
    margin-top: 50px;
    text-align: center;
    font-size: 12px;
    font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
}

#calendar {
    width: 700px;
    margin: 0 auto;
}



.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
}
.swing {
  display: inline-block;
  width: 215px;
  padding: 10px 0 10px 15px;
  font-family: "Open Sans", sans;
  font-weight: 400;
  color: #377D6A;
  background: #efefef;
  border: 0;
  border-radius: 3px;
  outline: 0;
  text-indent: 60px; // Arbitrary.
  transition: all .3s ease-in-out;
  
  &::-webkit-input-placeholder {
    color: #efefef;
    text-indent: 0;
    font-weight: 300;
  }

  + label {
    display: inline-block;
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px 15px;
    text-shadow: 0 1px 0 rgba(19,74,70,.4);
    background: #7AB893;
    border-top-left-radius: 3px;
    border-bottom-left-radius: 3px;
    transform-origin: 2px 2px;
    transform: rotate(0);
    // There should be a better way
    animation: swing-back .4s 1 ease-in-out;
  }
}
@keyframes swing {
  0% {
    transform: rotate(0);
  }
  20% {
    transform: rotate(116deg);
  }
  40% {
    transform: rotate(60deg);
  }
  60% {
    transform: rotate(98deg);
  }
  80% {
    transform: rotate(76deg);
  }
  100% {
    transform: rotate(82deg);
  }
}
@keyframes swing-back {
  0% {
    transform: rotate(82deg);
  }
  100% {
    transform: rotate(0);
  }
}
.swing:focus,
.swing:active {
  color: #377D6A;
  text-indent: 0;
  background: #fff;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  
  &::-webkit-input-placeholder {
    color: #aaa;
  }
  + label {
    animation: swing 1.4s 1 ease-in-out;
    transform: rotate(82deg);
  }
}
/* Fixed sidenav, full height */
.sidenav {
  max-height: 100%;
  max-width: 100%;
  display: block;
  top: 0;
  left: 0;
  padding-top: 20px;
  z-index: 200;
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
	padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}
.droppp{
	 display: none;
}
/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: #000000;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}



/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  z-index: 40;
  padding-left: 8px;
  background-color:#3ba4ff;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.container {
  width: 100%;
  height: 80%;
  position: relative;
  perspective: 800px;
}

#card {
  width: 100%;
  height: 100%;
  position: absolute;
  transform-style: preserve-3d;
  transition: transform 1s;
}

#card figure {
  margin: 0;
  display: block;
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
}

#card .front {
}

#card .back {
  transform: rotateY( 180deg);
}

#card.flipped {
  transform: rotateY( 180deg);
}
.interact {
  z-index: 10; 
  width: 80%;
  height: 80%;
  overflow: hidden;
  background: pink;
  box-shadow: 0 0 10px black;
  border-radius: 10px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 10px;
  text-align: center;
  display: none;
}
#close_div{
	position: absolute;
	right: 0; bottom: 0;
}

.close {
	-moz-box-shadow:inset 0px 0px 50px -3px #501bc2;
	-webkit-box-shadow:inset 0px 0px 50px -3px #501bc2;
	box-shadow:inset 0px 0px 50px -3px #501bc2;
	background-color:#3d4beb;
	-webkit-border-radius:14px;
	-moz-border-radius:14px;
	border-radius:14px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Courier New;
	font-size:12px;
	font-weight:bold;
	padding:13px 13px;
	text-decoration:none;
	text-shadow:-2px -1px 9px #3400de;
	position: absolute; 
                bottom: 0;
}
.close:hover {
	background-color:#3ba4ff;
}
.close:active {
	position: absolute; 
    bottom: 0;
}


.options {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
}
.btnn {
  color:inherit;
  font-family:inherit;
  font-size: inherit;
  background: white;
  padding: 0.3rem 3.4rem;
  border: 3px solid black;
  margin-right: 2.6rem;
  box-shadow: 0 0 0 black;
  transition: all 0.2s;
  border-radius: 25%;
}

.btnn:last-child {
  margin: 0;
}

.btnn:hover {
  box-shadow: 0.4rem 0.4rem 0 black;
  transform: translate(-0.4rem, -0.4rem);
}

.btnn:active {
  box-shadow: 0 0 0 black;
  transform: translate(0, 0);
}
@import url('https://fonts.googleapis.com/css?family=Raleway');

:root, button{
    font-family: 'Raleway', serif;
}

*{
    box-sizing: border-box;
}

.color{
    background: linear-gradient(to right, #e1e0ff, #d7fadd);
}

body{
    background: #191919;
    background: white;
    user-select: none;
    letter-spacing: 3px;
    color: #b9b9b9;
}

h1{
    padding-bottom: 40px;
    text-transform: uppercase;
    letter-spacing: 3px;
    font-size: 16px;
}

p{
    padding-bottom: 15px;
}

p:last-of-type{
    padding-bottom: 0;
}

.try-again{
    cursor: pointer;
    position: relative;
    font-size: 16px;
}

.try-again:after{
    content: '';
    position: absolute;
    left: 15px;
    right: 15px;
    height: 1px;
    top: 100%;
    background: #ebebeb;
    margin-top: 8px;
    transition: all 0.3s ease;
}

.try-again:hover:after{
    left: 40%;
    right: 40%;
}

.wrapper{
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.button{
    cursor: pointer;
    position: relative;
    z-index: 2;
    -webkit-appearance: none;
    background: none;
    outline: none;
    border: none;
    text-transform: uppercase;
    letter-spacing: 3px;
    border-radius: 2px;
    transition: all 0.5s ease;
    font-weight: 600;
    font-size: 14px;
    height: 60px;
    width: 110px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 0px;
    box-shadow: 0 0 0 white, 0 0 0 white;
}

.button-text{
    display: inline-block;
    position: relative;
    z-index: 2;
    background: linear-gradient(to right, #504bff, #4cfa63);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.button-circle{
    position: absolute;
    left: 0;
    top: 0;
    height: 6px;
    width: 6px;
    border-radius: 50%;
    box-shadow: 0 0 10px #504bff, 0 0 20px #504bff, 0 0 30px #504bff;
    transition: all 0.5s ease;
}

.button-circle2{
    top: auto;
    bottom: 0;
}

.button-circle3{
    left: auto;
    right: 0;
    box-shadow: 0 0 10px #4cfa63, 0 0 20px #4cfa63, 0 0 30px #4cfa63;
}

.button-circle4{
    left: auto;
    top: auto;
    bottom: 0;
    right: 0;
    box-shadow: 0 0 10px #4cfa63, 0 0 20px #4cfa63, 0 0 30px #4cfa63;
}

.button:hover{
    box-shadow: -15px 0 70px -15px #504bff, 15px 0 70px -15px #4cfa63;
}

.button:hover .button-circle1{
    transform: translate(-15px, -15px) scale(0);
}

.button:hover .button-circle2{
    transform: translate(-15px, 15px) scale(0);
}

.button:hover .button-circle3{
    transform: translate(15px, -15px) scale(0);
}

.button:hover .button-circle4{
    transform: translate(15px, 15px) scale(0);
}

.button:hover .button-circle{
    box-shadow: none;
}

.popup{
    opacity: 0;
    visibility: hidden;
    height: 100%;
    width: 80%;
	border-color: 2fff0f;
    flex-shrink: 0;
    border-radius: 3px;
    position: relative;
    z-index: 3;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease
}

.popup-inside{
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    overflow: hidden;
    border-radius: 50%;
    box-shadow: 0 0 0 black;
    transition:
            box-shadow 0.5s ease 0.7s,
            border-radius 0.35s ease 0.7s;
}

.backgrounds{
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 100%;
    overflow: hidden;
}

.background{
    --offset: 0;
    position: absolute;
    left: var(--offset);
    right: var(--offset);
    bottom: var(--offset);
    top: var(--offset);
    background: linear-gradient(to right, #504bff, #4cfa63);
    transform: scale(0);
    transition: all 0.5s ease 0s;
    border-radius: 50%;
}

.background2{
    --offset: 10%;
    position: absolute;
    left: var(--offset);
    right: var(--offset);
    bottom: var(--offset);
    top: var(--offset);
    background: linear-gradient(to right, #6665ff, #69fa7f);
    transform: scale(0);
    transition: all 0.5s ease 0.1s;
}

.background3{
    --offset: 20%;
    position: absolute;
    left: var(--offset);
    right: var(--offset);
    bottom: var(--offset);
    top: var(--offset);
    background: linear-gradient(to right, #8583ff, #85fa99);
    z-index: 2;
    transition: all 0.5s ease 0.2s;
}

.background4{
    --offset: 30%;
    position: absolute;
    left: var(--offset);
    right: var(--offset);
    bottom: var(--offset);
    top: var(--offset);
    background: linear-gradient(to right, #aaaaff, #a7fab7);
    z-index: 3;
    transition: all 0.5s ease 0.3s;
}

.background5{
    --offset: 40%;
    position: absolute;
    left: var(--offset);
    right: var(--offset);
    bottom: var(--offset);
    top: var(--offset);
    background: linear-gradient(to right, #c9c8ff, #c3fad1);
    z-index: 4;
    transition: all 0.5s ease 0.4s;
}

.background6{
    --offset: 40%;
    position: absolute;
    left: var(--offset);
    right: var(--offset);
    bottom: var(--offset);
    top: var(--offset);
    background: white;
    z-index: 5;
    transition: all 0.8s ease 0.4s;
}

.content{
    --offset: 0;
    position: absolute;
    left: var(--offset);
    right: var(--offset);
    bottom: var(--offset);
    top: var(--offset);
    display: flex;
	height: 100%;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.35s ease 0.75s;
    z-index: 10;
	margin-left: auto;
	margin-right: auto;
	max-width: 1000px;
	float: none;
}
.student {
	width: 100%;
	height: 100%;
}
.content-wrapper{
    text-align: center;
}

body.active .content{
    opacity: 1;
    transform: none;
}

body.active .popup{
    opacity: 1;
    visibility: visible;
}

body.active .popup-inside{
    border-radius: 0;
    box-shadow: -50px 0 200px -50px #504bff, 50px 0 200px -50px #4cfa63;
}

body.active .background{
    transform: scale(1);
}

body.active .background6{
    transform: scale(8);
}
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  width: 100%;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}
.dropfield {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
  width: 100%;
}

.dropfield:hover, .dropfield:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

li {
	list-style-type: none;
    border-style: solid;
    border-color: #92a8d1;
}
.dropdown-content {
  border-style: solid;
  border-color: #92a8d1;
  align: center;
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  padding: 0 20 0 20;
  font-size: 16;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
table {
	margin-left: auto;
  margin-right: auto;
}
		th,
		td {
		}
		
		th {
		  font-family: Lato-Bold;
		  font-size: 9px;
		  text-transform: uppercase;
		}

html {
    height: 100%;
}
body {
	background: #bcdee7 url("http://victory-design.ru/sandbox/codepen/profile_card/bg.png") no-repeat center center fixed;
    background-size: 120% auto;
    position: fixed;
	padding: 0px;
	margin: 0px;
	width: 100%;
	height: 100%;
	font: normal 14px/1.618em "Roboto", sans-serif;
	-webkit-font-smoothing: antialiased;
}
body:before {
    content: "";
    height: 0px;
    padding: 0px;
    border: 110em solid #313440;
	position: absolute;
	left: 50%;
	top: 100%;
    z-index: 2;
    display: block;
    -webkit-border-radius: 50%;
    border-radius: 50%;
	-webkit-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
    -webkit-animation: puff_portrait 0.5s 1.8s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, borderRadius 0.2s 2.3s linear forwards;
    animation: puff_portrait 0.5s 1.8s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, borderRadius 0.2s 2.3s linear forwards;
}
h1, h2 {
    font-weight: 400;
    margin: 0px 0px 5px 0px;
}
h1 {
    font-size: 24px;
}
h2 {
    font-size: 16px;
}
p {
    margin: 0px;
}
.profile-card {
	border-style: solid;
    border-color: #92a8d1;
	background: #FFB300;
	width: 56px;
	height: 56px;
	position: absolute;
	left: 50%;
	top: 50%;
    z-index: 2;
	overflow: hidden;
    opacity: 0;
    margin-top: 70px;
	-webkit-transform: translate(-50%, -50%);
	transform: translate(-50%, -50%);
	-webkit-border-radius: 50%;
	border-radius: 50%;
	-webkit-box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.16), 0px 3px 6px rgba(0, 0, 0, 0.23);
	box-shadow: 0px 3px 6px rgba(0 ,0, 0, 0.16), 0px 3px 6px rgba(0, 0, 0, 0.23);
    -webkit-animation: init 0.5s 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, moveDown 1s 0.8s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards, moveUp 1s 1.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards, materia_landscape 0.5s 2.7s cubic-bezier(0.86, 0, 0.07, 1) forwards;
    animation: init 0.5s 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, moveDown 1s 0.8s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards, moveUp 1s 1.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards, materia_landscape 0.5s 2.7s cubic-bezier(0.86, 0, 0.07, 1) forwards;
}
.profile-card header {
    width: 179px;
    height: 280px;
    padding: 40px 20px 30px 20px;
    display: inline-block;
    float: left;
    border-right: 2px dashed #EEEEEE;
	background: #FFFFFF;
    color: #000000;
    margin-top: 50px;
    opacity: 0;
    text-align: center;
    -webkit-animation: moveIn 1s 3.1s ease forwards;
    animation: moveIn 1s 3.1s ease forwards;
}
.profile-card header h1 {
    color: #FF5722;
}
.profile-card header a {
    display: inline-block;
    text-align: center;
    position: relative;
    margin: 25px 30px;
}

.profile-card header a > img {
    width: 120px;
    max-width: 100%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
    -webkit-transition: -webkit-box-shadow 0.3s ease;
    transition: box-shadow 0.3s ease;
    -webkit-box-shadow: 0px 0px 0px 8px rgba(0, 0, 0, 0.06);
    box-shadow: 0px 0px 0px 8px rgba(0, 0, 0, 0.06);
}
.profile-card header a:after {
	position: absolute;
    content: "";
	bottom: 3px;
	right: 3px;
	width: 20px;
	height: 20px;
    -webkit-transform: scale(0);
    transform: scale(0);
    -webkit-border-radius: 50%;
    border-radius: 50%;
    -webkit-animation: scaleIn 0.3s 3.5s ease forwards;
    animation: scaleIn 0.3s 3.5s ease forwards;
}
.profile-card header a:hover > img {
    -webkit-box-shadow: 0px 0px 0px 12px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 0px 12px rgba(0, 0, 0, 0.1);
}
$red: #EF233C
$blue: #2B2D42
$orange: #FF9F1C

*
	box-sizing: border-box




.profile-card .profile-bio {
    width: 175px;        
    height: 180px;
    display: inline-block;
    float: right;
    padding: 50px 20px 30px 20px;
	background: #FFFFFF;
    color: #333333;
    margin-top: 50px;
    text-align: center;
    opacity: 0;
    -webkit-animation: moveIn 1s 3.1s ease forwards;
    animation: moveIn 1s 3.1s ease forwards;
}
.profile-social-links {
    width: 218px;        
    display: inline-block;
    float: right;
    margin: 0px;
    padding: 15px 20px;
	background: #FFFFFF;
    margin-top: 50px;
    text-align: center;
    opacity: 0;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-animation: moveIn 1s 3.1s ease forwards;
    animation: moveIn 1s 3.1s ease forwards;
}
.profile-social-links li {
    list-style: none;
    margin: -5px 0px 0px 0px;
    padding: 0px;
    float: left;
    width: 33.3%;
    text-align: center;
}
.profile-social-links li a {
    display: inline-block;
    width: 24px;
    height: 24px;
    padding: 6px;
    position: relative;
    overflow: hidden!important;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.profile-social-links li a img {
    position: relative;
    z-index: 1;
}
.profile-social-links li a:before {
    display: block;
    content: "";
    background: rgba(0, 0, 0, 0.3);
    position: absolute;
    left: 0px;
    top: 0px;
    width: 36px;
    height: 36px;
    opacity: 1;
    -webkit-transition: transform 0.4s ease, opacity 1s ease-out;
    transition: transform 0.4s ease, opacity 1s ease-out;
    -webkit-transform: scale3d(0, 0, 1);
    transform: scale3d(0, 0, 1);
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.profile-social-links li a:hover:before {
    -webkit-animation: ripple 1s ease forwards;
    animation: ripple 1s ease forwards;
}
.profile-social-links li a img,
.profile-social-links li a svg {
    width: 24px;
}


@media screen and (min-aspect-ratio: 4/3) {
    body {
        background-size: 100% auto;
    }
    body:before {
        width: 0px;
    }
    @-webkit-keyframes puff {
        0% {
            top: 100%;
            width: 0px;
            padding-bottom: 0px;
        }
    	100% {
            top: 50%;
            width: 100%;
            padding-bottom: 100%;
        }	
    }
    @keyframes puff {
        0% {
            top: 100%;
            width: 0px;
            padding-bottom: 0px;
        }
    	100% {
            top: 50%;
            width: 100%;
            padding-bottom: 100%;
        }	
    }
}
@media screen and (min-height: 480px) {
	.profile-card {
		
		-webkit-animation: init 0.5s 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, moveDown 1s 0.8s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards, moveUp 1s 1.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards, materia_portrait 0.5s 2.7s cubic-bezier(0.86, 0, 0.07, 1) forwards;
		animation: init 0.5s 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, moveDown 1s 0.8s cubic-bezier(0.6, -0.28, 0.735, 0.045) forwards, moveUp 1s 1.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards, materia_portrait 0.5s 2.7s cubic-bezier(0.86, 0, 0.07, 1) forwards;
	}
	.profile-card header {
        width: auto;
        height: auto;
        padding: 30px 20px;
        display: block;
        float: none;
        border-right: none;
    }
    .profile-card .profile-bio {
        width: auto;
        height: auto;
        padding: 15px 20px 30px 20px;
        display: block;
        float: none; 
    }
    .profile-social-links {
        width: 100%;       
        display: block;
        float: none; 
    }
}
@media screen and (min-aspect-ratio: 4/3) {
    body {
        background-size: 100% auto;
    }
    body:before {
        width: 0px;
		-webkit-animation: puff_landscape 0.5s 1.8s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, borderRadius 0.2s 2.3s linear forwards;
		animation: puff_landscape 0.5s 1.8s cubic-bezier(0.55, 0.055, 0.675, 0.19) forwards, borderRadius 0.2s 2.3s linear forwards;
	}
}
@-webkit-keyframes init {
    0% {
    	width: 0px;
    	height: 0px;
    }
	100% {
        width: 56px;
        height: 56px;
        margin-top: 0px;
        opacity: 1;
    }	
}
@keyframes init {
    0% {
    	width: 0px;
    	height: 0px;
    }
	100% {
        width: 56px;
        height: 56px;
        margin-top: 0px;
        opacity: 1;
    }	
}
@-webkit-keyframes puff_portrait {
    0% {
        top: 100%;
        height: 0px;
        padding: 0px;
    }
	100% {
        top: 50%;
        height: 100%;
        padding: 0px 100%;
    }	
}
@keyframes puff_portrait {
    0% {
        top: 100%;
        height: 0px;
        padding: 0px;
    }
	100% {
        top: 50%;
        height: 100%;
        padding: 0px 100%;
    }	
}
@-webkit-keyframes puff_landscape {
	0% {
		top: 100%;
		width: 0px;
		padding-bottom: 0px;
	}
	100% {
		top: 50%;
		width: 100%;
		padding-bottom: 100%;
	}	
}
@keyframes puff_landscape {
	0% {
		top: 100%;
		width: 0px;
		padding-bottom: 0px;
	}
	100% {
		top: 50%;
		width: 100%;
		padding-bottom: 100%;
	}	
}
@-webkit-keyframes borderRadius {
    0% {
        -webkit-border-radius: 50%;
    }
	100% {
        -webkit-border-radius: 0px;
    }	
}
@keyframes borderRadius {
    0% {
        -webkit-border-radius: 50%;
    }
	100% {
        border-radius: 0px;
    }	
}
@-webkit-keyframes moveDown {
    0% {
   	    top: 50%;
    }
	50% {
	   top: 40%;
    }
    100% {
       top: 100%;
    }	
}
@keyframes moveDown {
    0% {
   	    top: 50%;
    }
	50% {
	   top: 40%;
    }
    100% {
       top: 100%;
    }	
}
@-webkit-keyframes moveUp {
    0% {
        background: #FFB300;
        top: 100%;
    }
	50% {
	   top: 40%;
    }
    100% {
       top: 50%;
       background: #E0E0E0;
    }	
}
@keyframes moveUp {
    0% {
        background: #FFB300;
        top: 100%;
    }
	50% {
	   top: 40%;
    }
    100% {
       top: 50%;
       background: #E0E0E0;
    }	
}
@-webkit-keyframes materia_landscape {
    0% {
        background: #E0E0E0;
    }
    50% {
        -webkit-border-radius: 50px;
    }
    100% {
        width: 340px;
        height: 280px;
        background: #FFFFFF;
        -webkit-border-radius: 50px;
    }
}
@keyframes materia_landscape {
    0% {
        background: #E0E0E0;
    }
    50% {
        border-radius: 50px;
    }
    100% {
        width: 30%;
        height: 100%;
        background: #FFFFFF;
        border-radius: 50px;
    }
}
@-webkit-keyframes materia_portrait {
	0% {
		background: #E0E0E0;
	}
	50% {
		-webkit-border-radius: 50px;
	}
	100% {
		width: 30%;
		height: 100%;
		background: #FFFFFF;
		-webkit-border-radius: 50px;
	}
}
@keyframes materia_portrait {
	0% {
		background: #E0E0E0;
	}
	50% {
		border-radius: 50px;
	}
	100% {
		width: 30%;
		height: 100%;
		background: #FFFFFF;
	border-radius: 50px;
	}
}
@-webkit-keyframes moveIn {
    0% {
        margin-top: 50px;
        opacity: 0;
    }
	100% { 
        opacity: 1;
        margin-top: -20px;
    }	
}
@keyframes moveIn {
    0% {
        margin-top: 50px;
        opacity: 0;
    }
	100% { 
        opacity: 1;
        margin-top: -20px;
    }	
}
@-webkit-keyframes scaleIn {
    0% {
        -webkit-transform: scale(0);
    }
	100% { 
        -webkit-transform: scale(1);
    }	
}
@keyframes scaleIn {
    0% {
        transform: scale(0);
    }
	100% { 
        transform: scale(1);
    }	
}
@-webkit-keyframes ripple {
    0% {
        transform: scale3d(0, 0, 0); 
    }
    50%, 100% {
        -webkit-transform: scale3d(1, 1, 1);
    }
    100% {
        opacity: 0;
    }
}
@keyframes ripple {
    0% {
        transform: scale3d(0, 0, 0); 
    }
    50%, 100% {
        transform: scale3d(1, 1, 1);
    }
    100% {
        opacity: 0;
    }
}


.btn-1 {
  background-color: #F27935;
}
.btn-1 .round {
  background-color: #f59965;
}

.type-1 a {
  text-decoration: none;
  -moz-border-radius: 30px;
  -webkit-border-radius: 30px;
  border-radius: 30px;
  padding: 12px 33px 12px 23px;
  color: #fff;
  text-transform: uppercase;
  font-family: sans-serif;
  font-weight: bold;
  position: relative;
  transition: all 0.3s;
  display: inline-block;
}
a .round {
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  border-radius: 50%;
  width: 25px;
  height: 28px;
  position: absolute;
  right: 3px;
  top: 3px;
  -moz-transition: all 0.3s ease-out;
  -o-transition: all 0.3s ease-out;
  -webkit-transition: all 0.3s ease-out;
  transition: all 0.3s ease-out;
  z-index: 2;
}
a .round i {
  position: absolute;
  top: 50%;
  margin-top: -6px;
  left: 50%;
  margin-left: -4px;
  -moz-transition: all 0.3s;
  -o-transition: all 0.3s;
  -webkit-transition: all 0.3s;
  transition: all 0.3s;
}


.type-1 a:hover {
	opacity: 0.4;
  padding-left: 23px;
  padding-right: 23px;
}
.type-1 a:hover .round {
	opacity: 0.4;
  width: calc(100% - 6px);
  -moz-border-radius: 30px;
  -webkit-border-radius: 30px;
  border-radius: 30px;
}
.type-1 a:hover .round i {
  left: 12%;
}

</style>