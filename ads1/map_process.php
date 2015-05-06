<?php
session_start();
//$_SESSION['nama']="dora";
$na=$_SESSION['nama'];
//$_SESSION['level']="petugas";
$level=$_SESSION['level'];
$id_ang=$_SESSION['id_anggota'];
// database settings 
$db_username = 'root';
$db_password = '';
$db_name = 'ads';
$db_host = 'localhost';
// untuk koneksi database
try {
    mysql_connect($db_host, $db_username, $db_password) or die(mysql_error());
    mysql_select_db($db_name) or die(mysql_error());
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
} 
 
// Save & delete markers 
if ($_POST) {
// hanya untuk POST request yang dikirim dengan ajax
    $xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
    if (!$xhr) {
        header('HTTP/1.1 500 Error: Request must come from Ajax!');
        exit();
    }
 
    // dapatkan posisi geospasial data
    $mLatLang = explode(',', $_POST["latlang"]);
    $mLat = filter_var($mLatLang[0], FILTER_VALIDATE_FLOAT);
    $mLng = filter_var($mLatLang[1], FILTER_VALIDATE_FLOAT);
 	
    //Delete Marker
    if (isset($_POST["del"]) && $_POST["del"] == true) {
        $results = mysql_query("DELETE FROM sampah WHERE lat=$mLat AND lng=$mLng");
        if (!$results) {
            header('HTTP/1.1 500 Error: Could not delete Markers!');
            exit();
        }
        exit("Done!");
    }
 
    //validasi data
    //$mName = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    //$mAddress = filter_var($_POST["address"], FILTER_SANITIZE_STRING);
    //$mType = filter_var($_POST["type"], FILTER_SANITIZE_STRING);
    // menambahkan data ke table
    //$results = mysql_query("INSERT INTO markers (name, address, lat, lng, type) VALUES ('$mName','$mAddress',$mLat, $mLng, '$mType')")
	
	if($level=="petugas"){$results = mysql_query("INSERT INTO sampah (lat, lng) VALUES ($mLat, $mLng)")or die(mysql_error());}
	else{$results = mysql_query("update sampah set id_anggota='".$id_ang."',nama='".$na."',status='punya' WHERE lat=$mLat AND lng=$mLng")or die(mysql_error());}
	
	/*if(($results=1) and ($level=="petugas")){ 
	ini_set('memory_limit', '-1');
	$query = mysql_query("select * from jalan");
 $jum=mysql_num_rows($query);
 $data = mysql_fetch_array($query);
$i=0;
while ($data){
	$a1=abs($data['lng']);
	$a2=abs($mLng);
	$a3=abs($data['lat']);
	$a4=abs($mLat);
	if($a1>$a2){$var1=$a1-$a2;} else {$var1=$a2-$a1;}
	if($a3>$a4){$var2=$a3-$a4;} else {$var2=$a3-$a4;}
	$nilai[$i]=$var1+$var2;
$cla[$i]=$data['wilayah'];
//echo $nilai[$i];echo $cl[$i]. "<br><br>";
$i++;
}

$flag=min($nilai);
//echo $flag."<br>";
for($d=0;$d<jum;$d++){if($nilai[$d]==$flag){$final=$cl[$d];} else {}}
$res = mysql_query("update markers set wilayah='".$final."' WHERE lat=$mLat AND lng=$mLng");}*/
	
    if (!$results) {
        header('HTTP/1.1 500 Error: Could not create marker!');
        exit();
    } 
 
  // $output = '<h1 class="marker-heading">' . $mLat . '</h1><p>' . $mLng . '</p>';
    exit();
}
 
/* if(($results=1) and ($level=="petugas")){ $query = mysql_query("select * from jalan");
 $jum=mysql_num_rows($query);
 $data = mysql_fetch_array($query);
$i=0;
while ($data){
	$a1=abs($data['lng']);
	$a2=abs($mLng);
	$a3=abs($data['lat']);
	$a4=abs($mLat);
	if($a1>$a2){$var1=$a1-$a2;} else {$var1=$a2-$a1;}
	if($a3>$a4){$var2=$a3-$a4;} else {$var2=$a3-$a4;}
	$nilai[$i]=$var1+$var2;
$cl[$i]=$data['wilayah'];
//echo $nilai[$i];echo $cl[$i]. "<br><br>";
$i++;
}

$flag=min($nilai);
//echo $flag."<br>";
for($d=0;$d<jum;$d++){if($nilai[$d]==$flag){$final=$cl[$d];} else {}}
$res = mysql_query("update markers set wilayah='".$final."' WHERE lat=$mLat AND lng=$mLng");
} */
 
 
 
//generating Map XML
//Create a new DOMDocument object
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers"); //Create new element node
$parnode = $dom->appendChild($node); //make the node show up 

$results2 = mysql_query("SELECT * FROM sampah WHERE nama='".$na."' ");
if (!$results2) {
    header('HTTP/1.1 500 Error: Could not get markers!');
    exit();
}

header("Content-type: text/xml");
// tampilkan dalan XML
while ($obj = mysql_fetch_object($results2)) {
    $node = $dom->createElement("marker2");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("name", $obj->nama);
    //$newnode->setAttribute("address", $obj->id_sampah);
    $newnode->setAttribute("lat", $obj->lat);
    $newnode->setAttribute("lng", $obj->lng);
    //$newnode->setAttribute("type", $obj->type);
}


// Select all the rows in the markers table
$results = mysql_query("SELECT * FROM sampah WHERE nama IS NULL ");
if (!$results) {
    header('HTTP/1.1 500 Error: Could not get markers!');
    exit();
}
 
 
//atur document header to text/xml
header("Content-type: text/xml");
// tampilkan dalan XML
while ($obj = mysql_fetch_object($results)) {
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("name", $obj->nama);
    //$newnode->setAttribute("address", $obj->id_sampah);
    $newnode->setAttribute("lat", $obj->lat);
    $newnode->setAttribute("lng", $obj->lng);
    //$newnode->setAttribute("type", $obj->type);
}

$results1 = mysql_query("SELECT * FROM sampah WHERE nama IS NOT NULL ");
if (!$results1) {
    header('HTTP/1.1 500 Error: Could not get markers!');
    exit();
}

header("Content-type: text/xml");
// tampilkan dalan XML
while ($obj = mysql_fetch_object($results1)) {
    $node = $dom->createElement("marker1");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("name", $obj->nama);
   // $newnode->setAttribute("address", $obj->id_sampah);
    $newnode->setAttribute("lat", $obj->lat);
    $newnode->setAttribute("lng", $obj->lng);
   // $newnode->setAttribute("type", $obj->type);
	}
	

echo $dom->saveXML();