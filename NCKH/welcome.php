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
					  $vipham = $row['Vipham'];
					  
						 
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
	
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Welcome</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
		<style type="text/css">
			body{ font: 14px sans-serif; text-align: center; }
		</style>
	</head>
	<body>
		<div class="page-header">
			<h1>Hi, <b><?php echo $hovaten; ?></b>. Welcome to our site.</h1>
		</div>
		<p>
			<a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
			<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
		</p>
		<div class="information">
			<table>
				<tbody>
					<tr class="table-head">
						<th>Hình ảnh</th>
						<th>Họ và tên</th>
						<th>Năm sinh</th>
						<th>Địa chỉ</th>
						<th>Giới tính</th>
					</tr>
					<tr class="table-body">
						<td> <?php
								$image = dirname(__FILE__).$hinhanh;
								// Read image path, convert to base64 encoding
								$imageData = base64_encode(file_get_contents($image));

								// Format the image SRC:  data:{mime};base64,{data};
								$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

								// Echo out a sample image
								echo '<img src="' . $src . '" " width ="50" height="50">';
							?> 
						</td>
						<td><?php echo $hovaten; ?></td>
						<td><?php echo $namsinh; ?></td>
						<td><?php echo $diachi; ?></td>
						<td><?php echo $gioitinh; ?></td>
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
		<style>
		table {
		  border-collapse: collapse;
		  background-color: #393939;
		  margin-left:auto; margin-right:auto; 
		  position: relative;
		  padding-top: 60px;
		}
		th,
		td {
		  border: 1px solid #cecfd5;
		  padding: 10px 15px;
		}
		
		th {
		  font-family: Lato-Bold;
		  font-size: 15px;
		  color: #00ad5f;
		  line-height: 1.4;
		  text-transform: uppercase;
		  background-color: #393939;
		}

		td {
		  font-family: Lato-Regular;
		  font-size: 15px;
		  color: #808080;
		  line-height: 1.4;
		  background-color: #222222;
		}
		</style>
	</body>
</html>
<?php } else if ($_SESSION["type"] === "teacher"){
	
	$no = $_SESSION["no"];
	$type = "teacher";
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
					  $email = $row['mail'];
					  $phone = $row['phone'];
					  $sub = $row['Subject'];
					  
						 
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
	
<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Welcome</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
		<style type="text/css">
			body{ font: 14px sans-serif; text-align: center; }
		</style>
	</head>
	<body>
		<div class="page-header">
			<h1>Hi, <b><?php echo $hovaten; ?></b>. Welcome to our site.</h1>
		</div>
		<p>
			<a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
			<a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
		</p>
		<div class="information">
			<table>
				<tbody>
					<tr class="table-head">
						<th>Hình ảnh</th>
						<th>Họ và tên</th>
						<th>Năm sinh</th>
						<th>Địa chỉ</th>
						<th>Giới tính</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Môn dạy</th>
					</tr>
					<tr class="table-body">
						<td> <?php
								$image = dirname(__FILE__).$hinhanh;
								// Read image path, convert to base64 encoding
								$imageData = base64_encode(file_get_contents($image));

								// Format the image SRC:  data:{mime};base64,{data};
								$src = 'data: '.mime_content_type($image).';base64,'.$imageData;

								// Echo out a sample image
								echo '<img src="' . $src . '" " width ="50" height="50">';
							?> 
						</td>
						<td><?php echo $hovaten; ?></td>
						<td><?php echo $namsinh; ?></td>
						<td><?php echo $diachi; ?></td>
						<td><?php echo $gioitinh; ?></td>
						<td><?php echo $email; ?></td>
						<td><?php echo $phone; ?></td>
						<td><?php echo $sub; ?></td>
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
		<style>
		table {
		  border-collapse: collapse;
		  background-color: #393939;
		  margin-left:auto; margin-right:auto; 
		  position: relative;
		  padding-top: 60px;
		}
		th,
		td {
		  border: 1px solid #cecfd5;
		  padding: 10px 15px;
		}
		
		th {
		  font-family: Lato-Bold;
		  font-size: 15px;
		  color: #00ad5f;
		  line-height: 1.4;
		  text-transform: uppercase;
		  background-color: #393939;
		}

		td {
		  font-family: Lato-Regular;
		  font-size: 15px;
		  color: #808080;
		  line-height: 1.4;
		  background-color: #222222;
		}
		</style>
	</body>
</html>
<?php  } ?>