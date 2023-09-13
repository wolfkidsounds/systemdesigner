<?php //User.php

class User {
    private $user_id;
    private $user_uid;
    private $user_name;
    private $user_email;
    public function __construct($user_id, $user_uid, $user_name, $user_email) {
        $user_id->user_id;
        $user_uid->user_uid;
        $user_name->user_name;
        $user_email->user_email;
    }
    public function get_user_id() {
        return $this->user_id;
    }
    public function get_user_name() {
        return $this->user_name;
    }
    public function get_user_uid() {
        return $this->user_uid;
    }
    public function set_user_name($user_name) {
        $user_name->user_name;
    }
    public function get_user_email() {
        return $this->user_email;
    }
    public function set_user_email($user_email) {
        $user_email->user_email;
    }
}