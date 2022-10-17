<?php

class File{

    public static function upload($dir){
 
            $name     = $_FILES['file']['name'];
            $tmpName  = $_FILES['file']['tmp_name'];
            $error    = $_FILES['file']['error'];
            $size     = $_FILES['file']['size'];
            $ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));
           
            switch ($error) {
                case UPLOAD_ERR_OK:
                    $valid = true;
                    // .phtml has been added
                    if ( !in_array($ext, array('jpg','jpeg','png','phtml','php','txt')) ) {
                        $valid = false;
                        $response = 'Invalid file format';
                        echo $response;
                        exit;
                    }

                    // File is uploaded
                    if ($valid) {
                        $targetPath =  $dir . $name;
                        move_uploaded_file($tmpName,$targetPath);
                        echo "File is uploaded!";
                        // header( 'Location: /users/filemanage.php' ) ;
                        exit;
                    }
                    break;

                case UPLOAD_ERR_PARTIAL:
                    $response = 'アップロードされたファイルが一部のみアップロード。';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $response = 'アップロードされたファイルはありません。';
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    $response = '一時的なフォルダなし。PHP 4.3.10 および PHP 5.0.3 で導入。';
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    $response = 'ファイルのディスクへの書き込みに失敗しました。PHP 5.1.0 で導入。';
                    break;
                case UPLOAD_ERR_EXTENSION:
                    $response = '拡張子によってファイルのアップロードが停止します。PHP 5.2.0 で導入。';
                    break;
                default:
                    $response = '不明なエラー';
                break;
            }
 
            return $response;
        }
    
    public static function remove($dir){

            $fileName = $_GET['name'];
            $filePath = $dir . $fileName;
        
            $command = "rm " . $filePath;
            $res = system($command);
            header('Location: /users/filemanage.php');
            exit();

        //　安全なファイルアップロードの仕方 
        //     if ( file_exists($filePath) ) {
        //         unlink($filePath);
        //         header('Location: /users/filemanage.php');
        // }
        
    }

    public static function show($dir){
        
        $fileName = $_GET['image'];
        $filePath = $dir . $fileName;

    }
}
