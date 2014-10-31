<?php
function dupcheck($username, $dbCon) {
  $cksql="SELECT username FROM user WHERE username = '$username'";
  $result0 = mysqli_query($dbCon, $cksql);
  $dupcheck = mysqli_num_rows($result0);
  return $dupcheck;
}
function usercheck($lid, $uid, $dbCon){
  $ck1sql="SELECT uid FROM lists WHERE uid = '$uid' AND id = '$lid'";
  $ck2sql="SELECT suid FROM list_share WHERE suid = '$uid' AND lid = '$lid'";
  $ck1_query = mysqli_query($dbCon, $ck1sql);
  $ck2_query = mysqli_query($dbCon, $ck2sql);
  $ck1 = mysqli_num_rows($ck1_query);
  $ck2 = mysqli_num_rows($ck2_query);
  if($ck1 == '0' AND $ck2 == '0'){
	  $result = "FALSE";
	  return $result;
  } else {
  		 $result = "TRUE";
		 return $result;
  }
}
function dupcheck_email($email, $dbCon) {
  $lcksql="SELECT email FROM user WHERE email = '$email'";
  $result1 = mysqli_query($dbCon, $lcksql);
  $dupcheck1 = mysqli_num_rows($result1);
  return $dupcheck1;
}
function dupcheck_listitle($listitle, $uid, $dbCon) {
  $lcksql="SELECT title FROM lists WHERE title = '$listitle' AND uid = '$uid'";
  $result1 = mysqli_query($dbCon, $lcksql);
  $dupcheck1 = mysqli_num_rows($result1);
  return $dupcheck1;
}
function ismine_list($uid, $lid, $dbCon) {
  $ismine_sql="SELECT title FROM lists WHERE id = '$lid' AND uid = '$uid'";
  $query = mysqli_query($dbCon, $ismine_sql);
  if ($query == ''){
  	$ismine = '0';
  } else {
  	$ismine = '1';
  }
  return $ismine;
}
function addcontent($uid, $lid, $cont, $checked, $dbCon2) {
  $adsql="INSERT INTO list_content (uid, lid, content, checked)
		VALUES ('$uid', '$lid', '$cont', '$checked')";
  if (mysqli_query($dbCon2, $adsql) == '') {
  	$result2 = '0';
  	return $result2;
	}
	else { 
		$result2 = '1';
		return $result2;
	}
}
function get_fname($uid, $dbCon) {
  $lcksql="SELECT fname FROM user WHERE id = '$uid'";
  $result1 = mysqli_query($dbCon, $lcksql);
  $row = mysqli_fetch_row($result1);
  $info = $row[0];
  return $info;
}
function get_lname($uid, $dbCon) {
   $lcksql="SELECT lname FROM user WHERE id = '$uid'";
  $result1 = mysqli_query($dbCon, $lcksql);
  $row = mysqli_fetch_row($result1);
  $info = $row[0];
  return $info;
}
function get_email($uid, $dbCon) {
   $lcksql="SELECT email FROM user WHERE id = '$uid'";
  $result1 = mysqli_query($dbCon, $lcksql);
  $row = mysqli_fetch_row($result1);
  $info = $row[0];
  return $info;
}
function get_pass($uid, $dbCon) {
   $lcksql="SELECT password FROM user WHERE id = '$uid'";
  $result1 = mysqli_query($dbCon, $lcksql);
  $row = mysqli_fetch_row($result1);
  $info = $row[0];
  return $info;
}
function get_lid($uid, $listitle, $dbCon) {
  $getlid_sql="SELECT id FROM lists WHERE uid = '$uid' AND title = '$listitle'";
  $getlid = mysqli_query($dbCon, $getlid_sql);
  $row = mysqli_fetch_row($getlid);
  $lid = $row[0];
  return $lid;
}
function get_eid($lid, $uid, $cont, $dbCon) {
  $geteid_sql="SELECT eid FROM list_content WHERE lid = '$lid' AND uid = '$uid' AND content = '$cont'";
  $geteid = mysqli_query($dbCon, $geteid_sql);
  $row = mysqli_fetch_row($geteid);
  $eid = $row[0];
  return $eid;
}
function get_listype($lid, $dbCon) {
  $getlistype_sql="SELECT type FROM lists WHERE id = '$lid'";
  $getlistype = mysqli_query($dbCon, $getlistype_sql);
  $row = mysqli_fetch_row($getlistype);
  $listype = $row[0];
  return $listype;
}
function get_share($lid, $dbCon) {
  $count = 0;
  $share = array();
  $getshare_sql="SELECT suid FROM list_share WHERE lid = '$lid'";
  $getshare = mysqli_query($dbCon, $getshare_sql);
  while($row = mysqli_fetch_array($getshare)){
  	$share[$count] = $row;
  	$count++;
  }
  return $share;
}
function get_listitle($lid, $dbCon){
	$sql = "SELECT title from lists WHERE id = '$lid'";
	$query = mysqli_query($dbCon, $sql);
	$row = mysqli_fetch_row($query);
	$listitle = $row[0];
	return $listitle;	
}
function get_sharuser($lid, $suid, $dbCon){
	$sql = "SELECT uid from list_share WHERE lid = '$lid' AND suid ='$suid'";
	$query = mysqli_query($dbCon, $sql);
	$row = mysqli_fetch_row($query);
	$sharuser_id = $row[0];
	$sql2 = "SELECT username FROM user WHERE id = '$sharuser_id'";
	$query2 = mysqli_query($dbCon, $sql2);
	$row2 = mysqli_fetch_row($query2);
	$sharuser = $row2[0];
	return $sharuser;	
}
function upd_pass($cpass, $npass, $npassv, $uid, $dbCon) {
	$lcksql="SELECT password FROM user WHERE id = '$uid'";
	$result1 = mysqli_query($dbCon, $lcksql);
	$row = mysqli_fetch_row($result1);
	$pass = $row[0];
  $isValid = password_verify($cpass, $pass);
  if($isValid == '1'){
	  if($npass == $npassv){
		  $paswd = password_hash(mysqli_real_escape_string($dbCon, $npass), PASSWORD_DEFAULT);
		  $sql = "UPDATE `user` set `password` = '$paswd' WHERE `id` = '$uid'";
		  $query = mysqli_query($dbCon, $sql);
		  $result = "TRUE";
	  } else{
		  $result = "FALSE";
	  } 
  } else {
	  $result = '';
  }
  return $result;
}
function upd_fname($nfname, $uid, $dbCon) {
  $sql = "UPDATE `user` set `fname` = '$nfname' WHERE `id` = '$uid'";
  $query = mysqli_query($dbCon, $sql);
  $result = "TRUE";
  return $result;
}
function upd_lname($nlname, $uid, $dbCon) {
  $sql = "UPDATE `user` set `lname` = '$nlname' WHERE `id` = '$uid'";
  $query = mysqli_query($dbCon, $sql);
  $result = "TRUE";
  return $result;
}
function upd_email($nemail, $nemail2, $uid, $dbCon) {
	if($nemail == $nemail2){
	    $sql = "UPDATE `user` set `email` = '$nemail' WHERE `id` = '$uid'";
	    $query = mysqli_query($dbCon, $sql);
	    $result = "TRUE";
	    return $result;
	} else {
		$result = "FALSE";
		return $result;
	}
}
function set_share($uid, $lid, $suid, $dbCon) {
  $setshare_sql="INSERT INTO list_share (sid, uid, lid, suid)
			VALUES ('', '$uid', '$lid', '$suid')";
  $setshare = mysqli_query($dbCon, $setshare_sql);
  return $setshare;
}
function unshare($lid, $suid, $dbCon) {
  $unshare_sql="DELETE FROM `list_share` WHERE `lid` = '$lid' AND `suid` = '$suid'";
  $unshare = mysqli_query($dbCon, $unshare_sql);
  return $unshare;
}
function delete_list($lid, $dbCon) {
  $delist_sql="DELETE FROM `lists` WHERE `id` = '$lid'";
  $result = mysqli_query($dbCon, $delist_sql);
  return $result;
}
function delete_listitem($eid, $dbCon) {
  $delistitem_sql="DELETE FROM `list_content` WHERE `eid` = '$eid'";
  $result = mysqli_query($dbCon, $delistitem_sql);
  return $result;
}
function check_listitem($eid, $dbCon) {
  $cklistitems_sql="UPDATE `list_content` SET `checked` = '1' WHERE `eid` = '$eid'";
  mysqli_query($dbCon, $cklistitems_sql);
}
function uncheck_listitem($eid, $dbCon) {
  $ucklistitems_sql="UPDATE `list_content` SET `checked` = '0' WHERE `eid` = '$eid'";
  mysqli_query($dbCon, $ucklistitems_sql);
}
function ischecked($eid, $dbCon) {
  $true = "checked";
  $false = '';
  $ischecked_sql="SELECT checked FROM list_content WHERE eid = '$eid'";
  $get_ischecked = mysqli_query($dbCon, $ischecked_sql);
  $row = mysqli_fetch_row($get_ischecked);
  if ($row[0] == 1) {
  	return $true;
  } else {
  	return $false;
  	}
}
function search_listuser($search, $dbCon) {
  $count0 = '0';
  $count1 = '0';
  //$searchuserf = array();
  //$searchuserl = array();
  $searchuser = array();
  $searchlistul_sql="SELECT lname FROM user WHERE fname LIKE '$search' OR lname LIKE '$search'";
  $searchlistuf_sql="SELECT fname FROM user WHERE fname LIKE '$search' OR lname LIKE '$search'";
  $search_query0 = mysqli_query($dbCon, $searchlistuf_sql);
  $search_query1 = mysqli_query($dbCon, $searchlistul_sql);
  $row1 = mysqli_fetch_array($search_query1);
  $row0 = mysqli_fetch_array($search_query0);
  while($row0 && $row1){
  	$searchuser[$count] = $row0." ".$row1;
  	$count0++;
  }
  return $searchuser;
}


?>