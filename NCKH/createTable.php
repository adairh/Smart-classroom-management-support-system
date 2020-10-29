<?php 
// sql to create table
require_once "config.php";
/*
$ar = array("Toan", "Ly", "Hoa", "Sinh", "Anh", "Van", "Su", "Dia", "GDCD", "QPAN", "TD", "Tin", "GVCN");
$str = "";
for ($i=0, $len=count($ar); $i<$len; $i++) {
    $str = $str . ",".$ar[$i]." VARCHAR(255) NOT NULL,".$ar[$i]."_dando VARCHAR(255)";
}
$sql = "CREATE TABLE class_teacher (
class VARCHAR(255) NOT NULL PRIMARY KEY"
.
$str
.
")";

if ($link->query($sql) === TRUE) {
  echo "Table MyGuests created successfully";
} else {
  echo "Error creating table: " . $link->error;
}*/


$ar = array("Toan", "Ly", "Hoa", "Sinh", "Anh", "Van", "Su", "Dia", "GDCD", "QPAN", "TD", "Tin");

$query = "SELECT fullname, Subject FROM teacher";
$result = mysqli_query($link, $query);


for ($i = 1;$i<=10;$i++){
$row = mysqli_fetch_assoc( $result);
$name = $row['fullname'];
$sub = $row['Subject'];
$class = "10a".$i;
$aaa = "";
$bbb = "";
for ($j=0, $len=count($ar); $j<$len; $j++) {
	if ($ar[$j] != $sub){
		$aaa = $aaa.",".$ar[$j];
		/*$sql2 = "SELECT fullname,Subject FROM teacher";
			$result2 = mysqli_query($link, $sql2);
			while ($row2 = mysqli_fetch_assoc( $result2)){
				if ($row2['Subject'] == $ar[$j]){
					$bbb=$bbb.",'".$row2['fullname']."'";
					break;
				}
			}*/
			$sql2 = "SELECT * FROM teacher ORDER BY RAND() LIMIT 1";	
				$result2 = mysqli_query($link, $sql2);
				$row2 = mysqli_fetch_assoc( $result2);
				//echo $sub." ".$row2['fullname']." ".$ar[$j];
				$bbb=$bbb.",'".$row2['fullname']."'";
				
			/*do{
				$sql2 = "SELECT * FROM teacher ORDER BY RAND() LIMIT 1";	
				$result2 = mysqli_query($link, $sql2);
				$row2 = mysqli_fetch_assoc( $result2);
				$bbb=$bbb.",'".$row2['fullname']."'";
			} while ($row2['Subject'] != $ar[$j]);
	
	}
}
echo "[[[[[[[[[[[[[[[".$aaa."---------".$bbb."]]]]]]]]]]]]]]]";	*/				
		$sql = "INSERT INTO class_teacher (class,GVCN,$sub".$aaa.") VALUES ('$class','$name','$name'".$bbb.");";
		
		if(mysqli_query($link, $sql)){echo "Thêm bản ghi thành công.";
				} else{
					echo "ERROR: Không thể thực thi $sql. " . mysqli_error($link);
				}
	
}
}
}


/*for ($i = 1;$i<=10;$i++){
	$class = "10a".$i;
	for ($j=0, $len=count($ar); $j<$len; $j++) {
		$sub = $ar[$j];
		$sql = "SELECT * FROM class_teacher";
		$result = mysqli_query($link, $sql);
		$row = mysqli_fetch_assoc( $result);
		$subb = $row['$sub'];
		if ($subb == null){
			$sql2 = "SELECT fullname,Subject FROM teacher";
			$result2 = mysqli_query($link, $sql2);
			while ($row2 = mysqli_fetch_assoc( $result2)){
				if ($row2['Subject'] == $sub){
					echo $row2['Subject']." ".$row2['fullname'];
					$subname = $row2['fullname'];
					$ss = "UPDATE class_teacher SET $sub = '$subname' WHERE class=$class";
					if(mysqli_query($link, $ss)){
						echo "Thêm bản ghi thành công.";
					} else{
						echo "ERROR: Không thể thực thi $sql. " . mysqli_error($link);
					}
				}
			}
			//$sql3 = "UPDATE class_teacher SET $sub = '$row2['fullname']' WHERE class = '$class');";
			//if(mysqli_query($link, $sql3)){echo "Thêm bản ghi thành công.";
			//	} else{
			//		echo "ERROR: Không thể thực thi $sql. " . mysqli_error($link);
			//}
		}
	}
}*/


/*while ($row = mysql_fetch_assoc($result)) {
    $i = $i + 1;
	
	print_r($row);
    // do stuff with $row
}*/
$link->close();
?>