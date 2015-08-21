<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TestAppBundle\Przyklad;

/**
 * Description of HelloWorld
 *
 * @author andrzej.mroczek
 */
class Upload {

    private $path;
    private $_FILES;
    private $fileNme;
    private $fileType;
    private $fileSize;

    public function __construct($path, $_FILES) {
        $this->path = $path;
        
        $this->_FILES->$_FILES;
        
    }

    public function zapiszplik() {
           
        foreach ($this->_FILES['pliki']['name'] as $key => $name) {
                $this->fileNme = $_FILES['pliki']['name'][$key];
                $this->path = $this->path . $this->fileNme;
                $this->fileSize = $_FILES['pliki']['size'][$key];
                $this->zapisywanie();
        
            }
        }
      
        public function zapisywanie(){
          if ($this->sprawdzformat() == true && $this->sprawdzrozmiar() == true) {
                    move_uploaded_file($this->_FILES['pliki']['tmp_name'][$key], $this->path);
                    return "Pliki zapisano";
                }
                elseif($this->sprawdzformat()==false){
                    return "Zły format pliku".$this->fileNme;
                }
                elseif($this->sprawdzrozmiar()==false){
                    return "Za duzy rozmiar pliku".$this->fileNme;
                }
      }  
        
    

    public function sprawdzformat() {

        $temp = explode(".", $this->fileNme);
        $allowedExts = array("txt", "htm", "html", "php", "css", "js", "json", "xml", "swf", "flv", "pdf", "psd", "eps", "ps", "doc", "rtf", "ppt", "odt", "ods", "jpg", "bmp", "png", "gif");
        $this->fileType = end($temp);
        if (in_array($this->fileType, $allowedExts)) {
            return true;
        } else {
            return false;
        }
    }

    public function sprawdzrozmiar() {
        $this->fileSize = returnbytes($this->fileSize);
        $maxsize = returnbytes(ini_get('post_max_size'));
        if ($this->fileSize <= $maxsize) {
            return true;
        } elseif ($this->fileSize > $maxsize) {
            return false;
        }
    }

    public function returnbytes($val) {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        switch ($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }

        return $val;
    }

}
