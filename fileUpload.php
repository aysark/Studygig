<?php

if (!empty($_FILES)) {
	
	$location = "uploads/";
	$field = 'Filedata';
	
	if ( ! is_uploaded_file($_FILES[$field]['tmp_name']))
	{
		//echo "\nerror in uploading file";
		exit(0);
	}
	
	$path_parts = pathinfo($location.$_FILES[$field]['name']);
	$dirname = $path_parts['dirname'];
	$name = strtolower(rtrim($path_parts['basename'],'.'));
	$fullname = $name;
	$ext = ".".strtolower($path_parts['extension']);
	$file_size = $_FILES[$field]['size'];
	//echo  "\n".$path_parts['basename']."\n";
	
	if ($file_size > 0)
	            {
	                $file_size = round($file_size/1024, 2);
	            }
	//limit file name
	if ($name > 0)
	{
		$filename = $name;
			$length = 30;
			if (strlen($filename) < $length)
			{
				$name = $filename;
			}else{
	
				$ext = '';
				if (strpos($filename, '.') !== FALSE)
				{
					$parts		= explode('.', $filename);
					$ext		= '.'.array_pop($parts);
					$filename	= implode('.', $parts);
				}
		
				$name = substr($filename, 0, ($length - strlen($ext))).$ext;
			}
	}
	
	//clean file name
	$bad = array(
							"<!--",
							"-->",
							"'",
							"<",
							">",
							'"',
							'&',
							'$',
							'=',
							';',
							'?',
							'/',
							"%20",
							"%22",
							"%3c",		// <
							"%253c",	// <
							"%3e",		// >
							"%0e",		// >
							"%28",		// (
							"%29",		// )
							"%2528",	// (
							"%26",		// &
							"%24",		// $
							"%3f",		// ?
							"%3b",		// ;
							"%3d"		// =
						);
	
			$name = str_replace($bad, '', $name);
	
			$name = stripslashes($name);
	//remove white spaces
	$name = preg_replace("/\s+/", "_", $name);
	
	//do not overwrite files with similar name
	$orig_name = $name;
				
	$filename=$name;
			if ( ! file_exists($location.$filename))
			{
				$name = $filename;
			}else {
	
			$filename = str_replace($ext, '', $filename);
			//echo  "\n filename:".$filename."\n";
			//echo  "\n ext:".$ext."\n";
			$new_filename = '';
			for ($i = 1; $i < 100; $i++)
			{
				if ( ! file_exists($location.$filename.$i.$ext))
				{
					$new_filename = $filename.$i.$ext;
					break;
				}
			}
	
			if ($new_filename == '')
			{
				//echo '\nbad file name';
				exit(0);
			}
			else
			{
				$name = $new_filename;
			}
		}
				if ($name === FALSE)
				{
					//echo '\nbad file name error2';
					exit(0);
				}
				
	//move the file to final destination --- no ext in name: substr($name, 0,strrpos($name,'.'))
	if (move_uploaded_file($_FILES[$field]['tmp_name'], $location.$name)) {
		 $file_info = array(
	                            'name' => $name,
	                            'file' => $location.$name,
	                            'size' => $file_size,
	                            'ext' => $ext,
	                            );
	
	     echo json_encode($file_info);
	    
	    if ($ext === ".pdf"){
	    	$input_file = $location.$name."[0]";
		    $output_file = str_replace($ext,".jpg",$fullname);
			$command = "convert $input_file -resize 85% -crop 540x465+0+0 canvas:none -fill \"#0076e6\" -font AvantGarde-Demi -pointsize 28 -draw \"text 60,270 'Studygig.com Preview'\" -channel RGBA $output_file ";
										
			exec($command);
	    }
	} else {
	    echo "\nPossible file upload attack!\n";
	}
}