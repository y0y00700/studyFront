<?php
header("access-control-allow-origin: *");
header("Content-Type: text/json; charset=UTF-8"); 

$mysql_hostname = 'localhost';
$mysql_username = 'kmh';
$mysql_password = 'rnjsalsgur1!';
$mysql_database = 'kmh';
$mysql_port = '3306';
$mysql_charset = 'utf8';

//넘어오는 패러미터 값을 받음.
$q = $_REQUEST["q"];//값을 받음.


//1. DB 연결
$connect = mysqli_connect($mysql_hostname, $mysql_username, $mysql_password); 

if(!$connect){
	echo '[연결실패] : '.mysqli_error().'<br>'; 
	die('MySQL 서버에 연결할 수 없습니다.');
    
} 
//2. DB 선택
mysqli_select_db($connect, $mysql_database) or die('DB 선택 실패');

//3. 문자셋 지정
mysqli_query($connect,' SET NAMES '.$mysql_charset);

//4. 쿼리 생성
$query = 'select keyword from search where keyword like \''.$q.'%\'';

//5. 쿼리 실행
$result = mysqli_query($connect,$query);



//6. 결과 처리
//[
//  {"name" : "우유", "price" : 2000},
//  {"name" : "홍차", "price" : 5000},
//  {"name" : "커피", "price" : 5000}
//]
$output='';


while($row = mysqli_fetch_array($result))
{	
    if ($output!="")
    {
        $output.= ",";//콤마붙이기
    }

    $output.='{"keyword":"'.$row['keyword'].'"}';  
   
}
$output='['.$output.']';

echo $output;

//6. 연결 종료
mysqli_close($connect);

?>