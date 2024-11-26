<?php

class userController extends fremwork {
    public function index(){
        echo "userController";
    }

    public function userMethod(){
        // $myModel = $this->model('userModel'); 
        // if(($myModel->myData())){
        //     echo "Data insert";
        // }else{
        //     echo "Data is not insert";
        // }


        // $myData = [
        //     'name' => "Deepak",
        //     'email' => "dk367748@gmail.com",
        // ];
        // $this->view("user", $myData);


         $myModel = $this->model('userModel'); 
        if(($myModel->myData())){
            print_r($myModel->myData());
        }else{
            echo "Data is not insert";
        }

    }
}