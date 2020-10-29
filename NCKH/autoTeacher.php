<form action="" method="post">
    <button type="submit">Gửi</button>
</form>
<?php
require_once "config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
			$input = array("Toan", "Ly", "Hoa", "Sinh", "Anh", "Van", "Su", "Dia", "GDCD", "QPAN", "TD", "Tin");
			$rand_keys = $input[array_rand($input, 1)];
			

	for ($l = 1; $l<=50; $l++){
			$token = getToken(40);
			$pass = getToken(20);
			$sex = "";
			$a = rand(1,2);
			if ($a == 1){ $sex = "female";} else { $sex = "male";}
			$sex_vn = "Nữ";
			if ($sex == "male"){ $sex_vn = "Nam"; }
			$img = imagecreatefromjpeg('https://thispersondoesnotexist.com/image');
			$json = "https://api.namefake.com/vietnamese-vietnam/".$sex;
			$json_value = get_web_page($json)['content'];
			$arr = json_decode($json_value, true);
			$input = array("Toan", "Ly", "Hoa", "Sinh", "Anh", "Van", "Su", "Dia", "GDCD", "QPAN", "TD", "Tin");
			$rand_keys = $input[array_rand($input, 1)];
			
			//if ($arr["email_url"] != null && $arr["phone_h"] != null && $arr["address"] != null && $arr["name"] != null && $arr["birth_data"] != null ){
				$address = $arr["address"];
				$phone = $arr["phone_h"];
				$email = $arr["email_url"];
				$name = removeText($arr["name"]);
				$birth = $arr["birth_data"];
				$encode = password_hash($pass, PASSWORD_DEFAULT);
				$dir = '/img/teacher/'.trim(str_replace(' ', '_', vn_to_str($name))).'.jpg';
				$use_dir = dirname(__FILE__).$dir;
				imagejpeg($img, $use_dir);
				$sql = "INSERT INTO teacher (username, password, password_encode, img, fullname, birthday, gentle, address, mail, phone, Subject) VALUES (
						'$token',
						'$pass',
						'$encode',
						'$dir',
						'$name',
						'$birth',
						'$sex_vn', 
						'$address',
						'$email',
						'$phone',
						'$rand_keys'
						)"; 
				if(mysqli_query($link, $sql)){
					echo "Thêm bản ghi thành công.";
				} else{
					echo "ERROR: Không thể thực thi $sql. " . mysqli_error($link);
				}
			//}
			
		}
	
		
	}
	

	
	function removeText($str){
		$new_str = $str;
		if(($pos = strpos($str, '.')) !== false)
		{
		   $new_str = substr($str, $pos + 1);
		}
		return $new_str;
	}
	function removeEverythingBefore($in, $before) {
		$pos = strpos($in, $before);
		return $pos !== FALSE
			? substr($in, $pos + strlen($before), strlen($in))
			: "";
	}
	function getToken($length) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function get_web_page( $url )
    {
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $options = array(

            CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
            CURLOPT_POST           =>false,        //set to GET
            CURLOPT_USERAGENT      => $user_agent, //set user agent
            CURLOPT_COOKIEFILE     =>"cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR      =>"cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 12000000,      // timeout on connect
            CURLOPT_TIMEOUT        => 12000000,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        return $header;
    }
	function vn_to_str ($str){
 
		$unicode = array(
		 
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
		 
		'd'=>'đ',
		 
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		 
		'i'=>'í|ì|ỉ|ĩ|ị',
		 
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		 
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		 
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
		 
		'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		 
		'D'=>'Đ',
		 
		'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		 
		'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
		 
		'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		 
		'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		 
		'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		 
		);
		 
		foreach($unicode as $nonUnicode=>$uni){
		 
		$str = preg_replace("/($uni)/i", $nonUnicode, $str);
		 
		}
		$str = str_replace(' ','_',$str);
		 
		return $str;
		 
	}
?>