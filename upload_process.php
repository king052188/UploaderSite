<?php

class Uploads {
    
    public static $file_count = 1;
    public static $folder_name = "";
    public static $original = "ORGL";
    public static $edited = "EDIT";
    public static $compressed = "COMP";
    public static $thumb = "THMB";
    public static $watermarkFile = "cpg-watermark.png";
    
    public static $last_Id;
    public static $imgFilename;

    public static $connection;
    public static $server = "localhost";
    public static $user = "root";
    public static $password = "ABC12abc";
    public static $database = "kpadb_cdgdb";

    public static $root_folder = "D:/KPA-Project/Contracts";

    public function checkpoint($path, $filename, $reference)
    {
        $filenames = explode(".", $filename);
        $filename = $reference ."_". $filenames[0] .".". $filenames[1];
        $fileInfo = $path . $filename;
        if(file_exists($fileInfo)) {
            unlink($fileInfo);
        }
        return $filename;
    }

    public function compressedImage($destination, $source, $quality = 50)
    {
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($source);
        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($source);
        imagecreatefromjpeg( $source );
        imagejpeg( $image, $destination, $quality );
    }
    
    public function resizeImage($tempFile, $destination)
    {
        require_once 'ImageManipulator.php';
        $manipulator = new ImageManipulator($tempFile);
        $newImage = $manipulator->resample(150, 113);
        $manipulator->save($destination);
    }

    public function created_folder($path) {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    }
}

    $upload = new Uploads;
    if(IsSet($_GET['trans']))
    {
        $trans = $_GET['trans'];
    }

    if (!empty($_FILES)) {

        $tempFile = $_FILES['file']['tmp_name'];

        $filename = $_FILES['file']['name'];

//        $f_info = finfo_open(FILEINFO_MIME_TYPE);
//
//        $mime = finfo_file($f_info, $tempFile);
//
//        $ok = true;
//
//        switch ($mime) {
//            case 'application/pdf':
//                break;
//            case 'image/png':
//                break;
//            case 'image/jpg':
//                break;
//            default:
//                $ok = false;
//                break;
//        }
//
//        if(!$ok) {
//            echo "Invalid application/image mime.";
//            return;
//        }

        $dir_name = $trans;
        $root_path = $upload::$root_folder ."/". $dir_name ."/".  $upload::$original;
        $newFilename = $upload->checkpoint($root_path, $filename, $trans);

        $upload->created_folder($upload::$root_folder ."/". $dir_name);
        $upload->created_folder($upload::$root_folder ."/". $dir_name ."/". $upload::$original);

        $destination = $upload::$root_folder ."/". $dir_name ."/".  $upload::$original ."/". $newFilename;
        move_uploaded_file($tempFile, $destination);

    }

?>














