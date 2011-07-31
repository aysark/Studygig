<?php

$data = file_get_contents("data/csshort.txt"); //read the file
$convert = explode("\n", $data); //create array separate by new line

$term = trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends
$x =0;
for ($i=0;$i<count($convert) & $x < 20;$i++)  
{
				$s = $convert[$i];
				if (preg_match("/^$term/i",$s)){
					if ($i < 6378){
					$array['category']="<b><u>COURSE</u></b>";
					$array['label']=htmlentities(stripslashes($s));
				}else{
					$array['category']="<b><u>SUBJECT</u></b>";
					$array['label']=htmlentities(stripslashes($s));
				}
					$row_set[] = $array;
					$x++;
				 }
}

/**$data2 = file_get_contents("data/sshort.txt"); //read the file
$convert2 = explode("\n", $data); //create array separate by new line
	
for ($i=0;$i<count($convert) & $x < 5;$i++)  
{
				$s = $convert[$i];
				
				if (preg_match("/$term/i",$s)){
					//$results[$i] = $s;
					//echo "$term - $s - ".preg_match("/$term/i",$s)." //";
					$array['label']=htmlentities(stripslashes($s));
					$array['category']="Subject";
					$row_set[] = $array;
					$x++;
				 }
}**/

if (!isset($array)){
	$array['category']="<p id='noCourseFound'>No course or subject found @ YorkU  <a href='http://studygig.com/index.php/site/contact' id='addYourUniLink'>Add your university </a></p>";
	$row_set[] = $array;
	echo json_encode($row_set);
}else{
echo json_encode($row_set);
}