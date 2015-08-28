<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TestAppBundle\Component;

/**
 * Description of FileDescription
 *
 * @author andrzej.mroczek
 */
class FileDescription {

    private $file;
    private $path;

    public function __construct($file) {
        $this->file = $file;
    }
    
    public function zapiszplik() {
        $this->path =$this->get('kernel')->getRootDir().'/../web/'.
    }
    
    
    //name
    public function getName() {
        return $this->file['name'];
    }
    
    //type
    public function getType() {
        return $this->file['type'];
    }
    //tmp_name
    public function getSource() {
//        return $this->file['tmp_name'];
        
        return file_get_contents($this->file['tmp_name']);
    }
    //error
    //size
    public function getSize() {
        return $this->file['size'];
    }
}
