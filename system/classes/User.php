<?php

namespace System\classes;

class User{

    /**
     *
     * Getting User by ID
     * @param $id int User ID
     * @return array|false|null Associative array with User fields
     */
    public function getUserById($id){
        global $mysqli;
        $user_result = $mysqli->query("SELECT * FROM users WHERE user_id = '$id'");
        $user = $user_result->fetch_assoc();
        return $user;
    }

    /**
     *
     * Getting User by username
     * @param $username string User login (username)
     * @return array|false|null Associative array with User fields
     */
    public function getUserByUserName($username){
        global $mysqli;
        $user_result = $mysqli->query("SELECT * FROM users WHERE username = '$username'");
        $user = $user_result->fetch_assoc();
        return $user;
    }

    /**
     *
     * Auth user in application
     *
     * @param $username string User login (username)
     * @param $password string User real password
     * @return void Print result on screen or redirect to main page if user exists
     */
    public function authUser($username, $password){
        global $mysqli;

        $hashed_password = md5($password);
        $result = $mysqli->query("SELECT * FROM users WHERE username = '".$username."' AND hashed_password = '".$hashed_password."'") or die($mysqli->error);
        $user = $result->fetch_assoc();

        if(!empty($user)){
            $_SESSION['username'] = $user['username'];
            $_SESSION['uid'] = $user['user_id'];
            echo "<script>location.replace('/?page=main')</script>";
        }else{
            echo "<div class='alert alert-danger alert-dismissible fade show '>Username or Password not correct
 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
 <span aria-hidden='true'>&times;</span>
  </button></div>";
        }
    }

    /**
     *
     * Register user
     * @param $username string User login (username)
     * @param $password string User real password
     * @param $first_name string User First Name
     * @param $last_name string User Last Name
     * @param $status string User status
     * @return string|void Status or MySQL error
     */
    public function registerUser($username, $password, $first_name, $last_name, $email, $status){

        global $mysqli;

        $hashed_password = md5($password);
        $check_q = $mysqli->query("SELECT * FROM users WHERE username = '".$username."'");
        $user_count = $check_q->num_rows;

        if($user_count > 0){
            echo "<div class='alert alert-danger alert-dismissible fade show '> User exists!
 <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
 <span aria-hidden='true'>&times;</span>
  </button></div>";
        }else {
            $mysqli->query("
            INSERT INTO
                users (
                       username,
                       hashed_password, 
                       name,
                       surname,
                       email,
                       user_role,
                       avatar,
                        contact_info,
                       profile_description,
                       is_banned
                       ) 
                VALUES 
                       (
                        '" . $username . "',
                        '" . $hashed_password . "',
                        '" . $first_name . "', 
                        '" . $last_name . "', 
                        '" . $email . "',
                        '" .$status. "',
                         ' ',
                         ' ',
                         ' ', 
                         0
                        )  "
            )
            or
            die($mysqli->error);

            echo "<div class='alert alert-success alert-dismissible fade show '> User was registered
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
  </button></div>";
        }
    }


}