<?php
    class Router{
        private $pages = array();
        function getPages(){
            return $this->pages;
        }
        function addRoute($url, $path){
            //echo "addRoute";
            $this->pages[$url] = $path;
        }
        function route($url){
            //echo "url ".$url;
            $path = $this->pages[$url];
            $file_dir = $path;
            if(file_exists($file_dir)){
                require $file_dir;
                //echo "create";
                die();
            }
            else{
                echo "no page";
                die();
            }
        }
    }
?>