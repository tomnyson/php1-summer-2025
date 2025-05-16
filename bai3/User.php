<?php
session_start();

class User
{
    public $name;
    public $username;
    public $password;
    public $role;

    function __construct($name, $username, $password, $role)
    {
        $this->name = $name;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }
    function dangNhap($username, $password)
    {
        if ($this->username == $username && $this->password == $password) {
            echo "tai khoan hop le";
            return true;
        } else {
            echo "sai tai khoan";
            return false;
        }
    }
    function set_password($password)
    {
        $this->password = $password;
    }
}

$user = new User("admin", "admin", "123456", "admin");

$ketqua = $user->dangNhap("admin", "123456");
var_dump($ketqua);
if($ketqua){
    $_SESSION["user"] = $user;
}