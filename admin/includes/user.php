<?php

class User{


    public $id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;




    static public function find_all_users(){
        return self::find_this_query("SELECT * FROM users");


    }

    public static function find_user_by_id($user_id){
        global $database;
        $the_result_array = self::find_this_query("SELECT * FROM users WHERE id = $user_id LIMIT 1"); // LIMIT to have 1 record back
      
        
        return !empty($the_result_array) ? array_shift($the_result_array) : false; //if it is not empty in the_result_array, I want you to do that, else return false
        /*
        if(!empty($the_result_array)){
            $first_item = array_shift($the_result_array);
            return $first_item;
        } else {
            return false;
        } */

        return $found_user;
    }


    public static function find_this_query($sql){
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();

        while($row = mysqli_fetch_array($result_set)){

            $the_object_array [] = self::instantiation($row);
        }

        return $the_object_array; 

    }
    



    public static function instantiation($the_record){

        $the_object = new self();

        // this is the long version, normally you can make a loop to loop through the array
        /*
        $the_object->id         = $found_user["id"];
        $the_object->username   = $found_user["username"];
        $the_object->password   = $found_user["password"];
        $the_object->first_name = $found_user["first_name"];
        $the_object->last_name  = $found_user["last_name"];

        */


        foreach($the_record as $the_attribute =>$value){
            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;

            }

        }

        return $the_object;

    }

    private function has_the_attribute($the_attribute){
        $object_properties = get_object_vars($this);

        array_key_exists($the_attribute, $object_properties);

    }




}
























?>