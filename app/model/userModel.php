<?php
class userModel extends database {
    public function myData() {
        // return [
        //     'name' => 'Deepak',
        //     'email' => 'dk366748@gmail.com',
        // ];

        // if($this->Query("INSERT INTO country(v_country_name,v_country_code,v_country_phone, i_created_id, dt_created_at) VALUES('Deepak', '458', '91', 1 ,'NOW()');")){
        //     return true;
        // }else{
        //     return false;
        // }


        // if($this->Query("SELECT * FROM country")){
        //     return $this->rowCount();
        // }else{
        //     return false;
        // }
        if($this->Query("SELECT * FROM country")){
            return $this->fetchall();
        }else{
            return false;
        }
    }
}