<?php
require_once('../class.function.php');
$account = new DTFunction(); 

if (isset($_POST['action'])) {
	
	$output = array();
	$stmt = $account->runQuery("SELECT * FROM `news` WHERE news_ID  = '".$_POST["news_ID"]."' 
			LIMIT 1");
	$stmt->execute();
	$result = $stmt->fetchAll();
	foreach($result as $row)
	{

	
		if (!empty($row['news_Img'])) {
		 $s_img = 'data:image/jpeg;base64,'.base64_encode($row['news_Img']);
		}
		else{
		  $s_img = 'data:image/svg+xml;charset=UTF-8,<svg%20width%3D"725"%20height%3D"250"%20xmlns%3D"http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg"%20viewBox%3D"0%200%20725%20250"%20preserveAspectRatio%3D"none"><defs><style%20type%3D"text%2Fcss">%23holder_16d4ec8c8a0%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A36pt%20%7D%20<%2Fstyle><%2Fdefs><g%20id%3D"holder_16d4ec8c8a0"><rect%20width%3D"725"%20height%3D"250"%20fill%3D"%23777"><%2Frect><g><text%20x%3D"270.4140625"%20y%3D"140.9"><%2Ftext><%2Fg><%2Fg><%2Fsvg>';
		}
		
		$output["news_Img"] = $s_img;
		$output["news_ID"] = $row["news_ID"];
		$output["news_Title"] = $row["news_Title"];
		$output["news_Content"] = $row["news_Content"];
	
	}
	
	echo json_encode($output);
	
}









 

?>