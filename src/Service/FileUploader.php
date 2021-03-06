<?php


namespace App\Service;



use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader{

    // private $directory;
    /*
        public function __construct($directory){
            $this->directory = $directory;
        }
      */
    public function upload(UploadedFile $file, $directory)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($directory, $fileName);

        return $fileName;
    }
}