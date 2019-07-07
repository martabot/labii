<?php 
class Archivos {
    public function subirFoto($us,$path,$var){
        $fileName=$_FILES[$var]['name'];
        $tmpName=$_FILES[$var]['tmp_name'];

        $fileSize=$_FILES[$var]['size'];
        $fileType=$_FILES[$var]['type'];
        if($tmpName==""){
        echo "esta vacio";
        }
        if($fileType=="image/jpeg" || $fileType=="image/jpg" || $fileType=="image/png" || $fileType=="image/gif"){
            $imagenes=$_SERVER['DOCUMENT_ROOT']."/LABII/public/img/".$path."/";
            $extension=explode("/",$fileType);
            $fileName=bin2hex(random_bytes(8)).'.'.$extension[1];
                $filePath=$imagenes.$fileName;
                $serverName="http://localhost/LABII/public/img/".$path."/".$fileName;
            if($result=move_uploaded_file($tmpName, $filePath)){
                    $us->__set($var,$serverName);
            }else{
                echo "no se subio";
                exit;
            }
            }else{
                echo "debe subir imagen con extension .jpg .jpeg .gif o .png";
            }
        return $us;
    }

}

?>