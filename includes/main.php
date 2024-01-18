<?php
function fetch_data($link, $query){
  // echo $query;
  $res = mysqli_query($link,$query);
  echo mysqli_error($link);
  $rows = array();
  while($row = mysqli_fetch_array($res,MYSQLI_ASSOC)){
    $rows[] = $row;
  }
  return $rows;
}
function update_data($link, $table, $data, $condition_array){
  $table = mysqli_real_escape_string($link, $table);
  $params = map_params($link, $data, ",");
  $condition = map_params($link, $condition_array, " and ");
  $sql = "UPDATE `$table` SET $params where $condition";
  // echo $sql;
  $res = mysqli_query($link,$sql);
  //echo mysqli_error($link);
}
function map_params($link, $data, $join = ","){
  $escaped_values = array_map( array($link, 'real_escape_string'), array_values($data));
  $keys  = array_keys($data);
  $new_data = array();
  foreach ($escaped_values as $key => $value) {
    $new_data[]=   $keys[$key].' = '."'$value'";
  }
  return join($join,$new_data);
}
function add_data($link, $table, $data){
  $table = mysqli_real_escape_string($link, $table);
  $columns = implode(", ",array_keys($data));
  $escaped_values = array_map( array($link, 'real_escape_string'), array_values($data));
  $values  = implode("', '", $escaped_values);
  $sql = "INSERT INTO `$table`($columns) VALUES ('$values')";
  //echo $sql;
  $res = mysqli_query($link,$sql);
  return mysqli_insert_id($link);
}

function save_slug($con, $id, $table_name, $column_name, $title){
	$slug = slugify($title);
	$new_slug = validate_slug($con, $id, $table_name, $column_name, $slug, 1);

	update_data($con, $table_name, array(
		"slug" => $new_slug
	), array(
		$column_name => $id
	));

}
function validate_slug($con, $id, $table_name, $column_name, $slug, $integer){
$query = "SELECT COUNT(*) AS NumHits, $column_name  FROM $table_name WHERE slug='$slug'";
$result = mysqli_query($con, $query);
// echo mysqli_error($con);
$row = $result->fetch_assoc();
$numHits = $row['NumHits'];
if ($numHits == 0 or ($numHits == 1 and $row[$column_name] == $id)){
	return $slug;
}else {
	$new_slug = ($numHits > 0) ? ($slug . '-' . $integer) : $slug;
	return validate_slug($con, $id, $table_name, $column_name, $new_slug, $integer+1);
}
}

function slugify($text)
{
// replace non letter or digits by -
$text = preg_replace('~[^\pL\d]+~u', '-', $text);

// transliterate
$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

// remove unwanted characters
$text = preg_replace('~[^-\w]+~', '', $text);

// trim
$text = trim($text, '-');

// remove duplicate -
$text = preg_replace('~-+~', '-', $text);

// lowercase
$text = strtolower($text);

if (empty($text)) {
	return 'n-a';
}

return $text;
}
function insert_update_delete_data($link, $qry){
	if(mysqli_query($link,$qry))
		return 1;
	else
		return 0;
}
function validate_string($link,$data){
	$data = trim($data);
	// $data = stripslashes($data);
	// $data = strip_tags($data);
	// $data = htmlspecialchars($data);
	$data = mysqli_real_escape_string($link,$data);
	//$data = escapeshellcmd($data);
	
	//replace single and double quotes
	$data = str_replace("\"","&quot;",$data);
	$data = str_replace("'","&rsquo;",$data);
	return $data;    
}

function show_number($Price, $decimal=2){
	if($Price=="0" || $Price==""){
		return number_format(0,$decimal);
	}
	else
		return number_format($Price,$decimal);
}

function show_number_without_decimal($Price){
	if($Price=="0" || $Price=="")
		return "0";
	else
		return number_format($Price,0);
}

function show_zero_number($num){
	if($num=="0" || $num=="")
		return "-";
	else
		return $num;
}

function round_number($num, $decimal){		
	if($num=="0" || $num=="")		
		return 0;		
	else		
		return round($num,$decimal);		
}

function show_without_decimal($num){
	$parts = explode('.', $num);
	//print_r($parts);
	return $parts[0];
}
function makeInitials($name){
    $words = explode(' ', $name);
    return strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
}

function GenerateRandomPassword() {
    $alphabet = "0123456789";
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 4; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function getIp(){
	if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function getMac(){
	ob_start();  
	//Get the ipconfig details using system commond  
	system('ipconfig /all');  

	// Capture the output into a variable  
	$mycomsys=ob_get_contents();  

	// Clean (erase) the output buffer  
	ob_clean();  

	$find_mac = "Physical"; 
	//find the "Physical" & Find the position of Physical text  

	$pmac    = strpos($mycomsys, $find_mac);  
	// Get Physical Address  

	$macaddress=substr($mycomsys,($pmac+36),17);  
	//Display Mac Address 
	return $macaddress;
}

function time_difference($t_start, $t_end=""){
	
	$start  = date_create($t_start);
	if($t_end=="")
		$end = date_create(); // Current time and date
	else
		$end = date_create($t_end);
	$diff  	= date_diff( $start, $end );
	//var_dump($start);var_dump($end);var_dump($diff);
	
	//sprintf - add leading zero if on digit time
	return sprintf("%02d",$diff->days)."-".sprintf("%02d",$diff->h).":".sprintf("%02d",$diff->i);
	
	/*echo 'The difference is ';
	echo  $diff->y . ' years, ';
	echo  $diff->m . ' months, ';
	echo  $diff->d . ' days, ';
	echo  $diff->h . ' hours, ';
	echo  $diff->i . ' minutes, ';
	echo  $diff->s . ' seconds';*/
}


function show_date($dt){
	if($dt=="" || $dt=="0000-00-00" || $dt=="1971-01-01"){
		return "";
	}else{
		//$parts = explode('-',$dt);
		//return $parts[1]."/".$parts[2]."/".$parts[0];
		return date("d/m/Y", strtotime($dt));
	}
}

function show_date_long($dt){
	if($dt=="" || $dt=="0000-00-00" || $dt=="1971-01-01" || $dt=="1990-01-01 00:00:00.000")
		return "";
	else
		return date("d-M-Y", strtotime($dt));
}

function save_date($dt){
	if($dt=="")
		return "";
	else
		return date("Y-m-d", strtotime($dt));
}

function save_date_dmy($dt){
	//use to convert date from dd/mm/yyyy format
	$parts = explode('/',$dt);
	return $parts[2]."-".$parts[1]."-".$parts[0];
}

function save_date_mdy($dt){
	//use to convert date from mm/dd/yyyy format
	$parts = explode('-',$dt);
	return $parts[1]."/".$parts[2]."/".$parts[0];
}

function save_datetime_long($dt){
	return date("Y-m-d H:i:s", strtotime($dt));
}

function show_datetime_long($dt){
	if($dt=="" || $dt=="0000-00-00" || $dt=="1971-01-01")
		return "";
	else
		return date("d/m/Y H:i:s", strtotime($dt));
}

function show_time_long($dt){
	if($dt=="" || $dt=="0000-00-00" || $dt=="1971-01-01")
		return "";
	else
		return date("h:i:s A", strtotime($dt));
}

function show_time($dt){
	if($dt=="" || $dt=="0000-00-00" || $dt=="1971-01-01")
		return "";
	else
		return date("H:i", strtotime($dt));
}

function show_time_picker($dt){
	if($dt=="" || $dt=="0000-00-00" || $dt=="1971-01-01")
		return "";
	else
		return date("H:i", strtotime($dt));
}

function convert_date_long($dt){
	if($dt=="" || $dt=="0000-00-00" || $dt=="1971-01-01"){
		return "";
	}else{
		return date("jS F, Y", strtotime($dt));
	}
}

function convert_date_dmy($dt){
	if($dt=="" || $dt=="0000-00-00" || $dt=="1971-01-01"){
		return "";
	}else{
		return date("d/m/y", strtotime($dt));
	}
}

function get_db_datetime(){
	$qry="select now()";
	$res = mysqli_query($link,$qry);
	if(mysqli_num_rows($res)<=0){
		return "";
	}else{
		$row = mysqli_fetch_array($res,MYSQLI_BOTH);
		return $row[0];
	}
}

function get_datetime(){
	return date('Y-m-d H:i:s');
}

function show_status($status){
	if($status==1)
		return "<span  class='label label-success'>Active</span>";
	else if($status==0)
		return "<span  class='label label-danger'><strong>In-Active</strong></span>";
	else
		return "";
}

function get_next_auto_id($id_field,$table,$link) {
	$qry = "Select max(".$id_field.")+1 AS ID from ".$table;
	$data = select_data($qry, $link);
	if($data[0]>0 && intval($data[1][0]["ID"])>0)
		return $data[1][0]["ID"];
	else
		return 0;
}

function get_max_id($id_field,$table,$link) {
	$qry = "Select max(".$id_field.") AS ID from ".$table;
	$data = select_data($qry, $link);
	if($data[0]>0 && intval($data[1][0]["ID"])>0)
		return $data[1][0]["ID"];
	else
		return 0;
}

function chk_duplicate_record($id_field,$criteria_field,$criteria_value,$table,$link,$addl_clause="") {
	$qry="select count(" . $id_field . ") as count from " . $table . " where " . $criteria_field . "='" . $criteria_value . "' $addl_clause ";
	$res = mysqli_query($link,$qry);
	$row = mysqli_fetch_array($res,MYSQLI_BOTH);
	if($row[0]>0)
		return true;
	else
		return false;
}

function chk_child_record($id_field,$criteria_field,$criteria_value,$table,$link) {
	$qry="select count(" . $id_field . ") from " . $table . " where " . $criteria_field . "='" . $criteria_value . "' ";
	$res = mysqli_query($link,$qry);
	$row = mysqli_fetch_array($res,MYSQLI_BOTH);
	if($row[0]>0)
		return true;
	else
		return false;
}

function count_record($id_field,$criteria_field,$criteria_value,$table,$link, $addl_clause="") {
	$qry="select count(" . $id_field . ") as count from " . $table . " where " . $criteria_field . "='" . $criteria_value . "' ". $addl_clause;
	$res = odbc_exec($link,$qry);
	$row = odbc_fetch_array($res);
	if(odbc_num_rows($res)<=0)
		return 0;
	else
		return $row['count'];
}

function delete_record_from_table($criteria_field,$criteria_value,$table,$link) {
	$qry = "delete from " . $table . " where " . $criteria_field . "='" . $criteria_value . "' ";
	$res = odbc_exec($link, $qry);
	if(!$res)
		return false;
	else
		return true;
}

function delete_record_from_table_mysqli($criteria_field,$criteria_value,$table,$link) {
	$qry="delete from " . $table . " where " . $criteria_field . "='" . $criteria_value . "' ";
	$res = mysqli_query($link,$qry);
	if(mysqli_affected_rows($link)<=0)
		return false;
	else
		return true;
}

function return_title($return_field,$criteria_field,$criteria_value,$table,$link,$addl_clause=""){
	$qry="select " . $return_field . " from " . $table . " where " . $criteria_field . "='" . $criteria_value . "' $addl_clause ";
	$res = mysqli_query($link,$qry);
	if(mysqli_affected_rows($link)<=0){
		return "";
	}else{
		$row = mysqli_fetch_array($res,MYSQLI_BOTH);
		return $row[0];
	}
}

function return_title_mysqli($return_field,$criteria_field,$criteria_value,$table,$link,$addl_clause=""){
	$qry="select " . $return_field . " from " . $table . " where " . $criteria_field . "='" . $criteria_value . "' $addl_clause ";
	$res = mysqli_query($link,$qry);
	if(mysqli_affected_rows($link)<=0){
		return "";
	}else{
		$row = mysqli_fetch_array($res,MYSQLI_BOTH);
		return $row[0];
	}
}

function display_number_with_decimal($num){
	if($num==0)
		return "-";
	else
		return number_format($num,2);
}

function validate_ckeditor_data($link,$data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	$data = mysqli_real_escape_string($link,$data);
	return $data;
}

function crypt_pass($string){
	$f_pass = md5($string);
	return $f_pass;
}

function encodeString($string){
	//return $string;
	$num1=sha1(rand(1000,5000));
	$string = base64_encode($string);
	$finalString = $num1.":+;".$string;
	return base64_encode($finalString);
}

function decodeString($string){
	//return $string;
	$string = base64_decode($string);
	$parts = explode(":+;",$string);
	if(isset($parts[1]))
		return base64_decode($parts[1]);
	else
		return "Invalid String";
}

function encodeString_1($string){
	$num1=sha1(rand(1000,5000));
	$string = base64_encode($string);
	$finalString = $num1.":+;".$string;
	return base64_encode($finalString);
}

function decodeString_1($string){
	$string = base64_decode($string);
	$parts = explode(":+;",$string);
	if(isset($parts[1]))
		return base64_decode($parts[1]);
	else
		return "Invalid String";
}

function show_month_name($monthID){
	if($monthID =="1"){
		$monthID = "January";
	}
	else if($monthID =="2"){
		$monthID = "February";
	}
	else if($monthID =="3"){
		$monthID = "March";
	}
	else if($monthID =="4"){
		$monthID = "April";
	}
	else if($monthID =="5"){
		$monthID = "May";
	}
	else if($monthID =="6"){
		$monthID = "June";
	}
	else if($monthID =="7"){
		$monthID = "July";
	}
	else if($monthID =="8"){
		$monthID = "August";
	}
	else if($monthID =="9"){
		$monthID = "September";
	}
	else if($monthID =="10"){
		$monthID = "October";
	}
	else if($monthID =="11"){
		$monthID = "November";
	}
	else if($monthID =="12"){
		$monthID = "December";
	}
	return $monthID;
}
function show_month_name_short($monthID){
	if($monthID =="1"){
		$monthID = "Jan";
	}
	else if($monthID =="2"){
		$monthID = "Feb";
	}
	else if($monthID =="3"){
		$monthID = "Mar";
	}
	else if($monthID =="4"){
		$monthID = "Apr";
	}
	else if($monthID =="5"){
		$monthID = "May";
	}
	else if($monthID =="6"){
		$monthID = "Jun";
	}
	else if($monthID =="7"){
		$monthID = "Jul";
	}
	else if($monthID =="8"){
		$monthID = "Aug";
	}
	else if($monthID =="9"){
		$monthID = "Sep";
	}
	else if($monthID =="10"){
		$monthID = "Oct";
	}
	else if($monthID =="11"){
		$monthID = "Nov";
	}
	else if($monthID =="12"){
		$monthID = "Dec";
	}
	return $monthID;
}
function number_format_short( $n, $precision = 1 ) {
    if ($n < 900) {
        // 0 - 900
        $n_format = number_format($n, $precision);
        $suffix = '';
    } else if ($n < 900000) {
        // 0.9k-850k
        $n_format = number_format($n / 1000, $precision);
        $suffix = 'K';
    } else if ($n < 900000000) {
        // 0.9m-850m
        $n_format = number_format($n / 1000000, $precision);
        $suffix = 'M';
    } else if ($n < 900000000000) {
        // 0.9b-850b
        $n_format = number_format($n / 1000000000, $precision);
        $suffix = 'B';
    } else {
        // 0.9t+
        $n_format = number_format($n / 1000000000000, $precision);
        $suffix = 'T';
    }
  // Remove unecessary zeroes after decimal. "1.0" -> "1"; "1.00" -> "1"
  // Intentionally does not affect partials, eg "1.50" -> "1.50"
    if ( $precision > 0 ) {
        $dotzero = '.' . str_repeat( '0', $precision );
        $n_format = str_replace( $dotzero, '', $n_format );
    }
    return $n_format . $suffix;
}
?>