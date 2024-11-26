<?php
class fremwork {
    public function view($viewName, $data = []){
        if (file_exists("../app/view/" . $viewName . ".php")) {
            require_once "../app/view/$viewName.php";
        }else{
            echo "<div style='margin:0;padding:0; background-color:silver;'>Sorry $viewName.php file not found.</div>";
        }
    }
    public function model($modelName){
        if(file_exists("../app/model/" . $modelName . ".php")){
            require_once "../app/model/$modelName.php";
            return new $modelName;
        }else{
            echo "<div style='margin:0;padding:0; background-color:silver;'>Sorry $modelName.php file not found.</div>";
        }
    }
}