<?php
abstract class AbstractController{
    protected function getView($viewName){
        require __DIR__."/../view/$viewName.php";
        die;
    }
}