<?php
//Error reporting
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

if (isset($_FILES["testname"]["name"])) {
    
    //Extractd file properties into variables
    $name     = $_FILES['testname']['name'];
    $tmpName  = $_FILES['testname']['tmp_name'];
    $error    = $_FILES['testname']['error'];
    $size     = $_FILES['testname']['size'];
    $ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    
    //Swich statements determines whether to contintue or whether to throw up error messages
    switch ($error) {
        case UPLOAD_ERR_OK:
            $valid = true;
            //Checks file types
            if ( !in_array($ext, array('doc','docx','odt','ods','odp','xls', 'xlsx','zip', 'ppt','pdf','pptx')) ) {
                $valid = false;
                $response = 'Invalid file extension.';
            }
            //Checks file size
            if ( $size/10000/10000 > 2 ) {
                $valid = false;
                $response = 'File size is exceeding maximum allowed size.';
            }
            //If deemed valid the file will be uploaded
            if ($valid) {
                $targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR. $name;
                move_uploaded_file($tmpName,$targetPath);
                header( 'Location: index.php' ) ;
                exit;
            }
            break;

        //Generic upload error procedures 
        case UPLOAD_ERR_INI_SIZE:
            $response = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $response = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
            break;
        case UPLOAD_ERR_PARTIAL:
            $response = 'The uploaded file was only partially uploaded.';
            break;
        case UPLOAD_ERR_NO_FILE:
            $response = 'No file was uploaded.';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $response = 'Missing a temporary folder. Introduced in PHP 4.3.10 and PHP 5.0.3.';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $response = 'Failed to write file to disk. Introduced in PHP 5.1.0.';
            break;
        case UPLOAD_ERR_EXTENSION:
            $response = 'File upload stopped by extension. Introduced in PHP 5.2.0.';
            break;
        default:
            $response = 'Unknown error';
        break;
    }

    echo $response;
}
else{
    echo "if skipped";
    }
?>