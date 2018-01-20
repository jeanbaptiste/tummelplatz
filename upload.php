
<?php
$ds          = DIRECTORY_SEPARATOR; 
 
$storeFolder = './uploads';  

//echo phpinfo();
 
function scan_dir($dir) {
    $ignored = array('.', '..', '.svn', '.htaccess');

    $files = array();    
    foreach (scandir($dir) as $file) {
        if (in_array($file, $ignored)) continue;
        $files[$file] = filemtime($dir . '/' . $file);
    }

    arsort($files);
    $files = array_keys($files);

    return ($files) ? $files : false;
}



if (!empty($_FILES)) {
 
    $tempFile = $_FILES['file']['tmp_name'];         
 
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
 
    $targetFile =  $targetPath. $_FILES['file']['name']; 
 
    move_uploaded_file($tempFile,$targetFile);
 
} else {                                                           
    $result  = array();
 
    $files = scan_dir($storeFolder);                 //1
    if ( false!==$files ) {
        foreach ( $files as $file ) {
            	
            if ( '.'!=$file && '..'!=$file) {       //2
                $obj['name'] = $file;
                $obj['size'] = filesize($storeFolder.$ds.$file);

//////////////////////// METADATA /////////////////////////////////////////////////

	    exec("exiv2 -pc $storeFolder/$file", $output, $return_var);
				
	    if ( $return_var == 0 ) {

	 	$obj['metadata'] = $output;
		$output = "";
		} else {
		$obj['metadata'] = $file;
		}
	   	    
//////////////////////////////////////////////////////////////////////////////////

                $result[] = $obj;
            }
        }
    }
     
    header('Content-type: text/json');              //3
    header('Content-type: application/json');
    echo json_encode($result);
}
?>
