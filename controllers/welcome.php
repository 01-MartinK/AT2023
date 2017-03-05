<?php namespace Halo;

class welcome extends Controller
{
    public $requires_auth = false;

    function index()
    {
        if (isset($_SESSION['practical'])) {
            header('Location: test/practical');
            exit();
        } else if (isset($_SESSION['theoretical'])) {
            header('Location: test');
            exit();
        }

        $this->users = get_all("SELECT * FROM users");
    }

    function AJAX_register()
    {
        if(empty($_POST['firstName'] || $_POST['lastName'] || $_POST['social_id'] || $_POST['password'])) {
            exit('Error. Missing required parameters.');
        }

        if(time() < strtotime($this->settings['start'])) {
            exit('Test is closed at the moment. Please try again later.');
        }

        if(time() > strtotime($this->settings['end'])) {
            exit('Test is closed at the moment. Please try again later.');
        }

        if($_POST['password'] != $this->settings['pwd']) {
            exit('Invalid PIN.');
        }

        $user_id =
        insert('users', [
            'firstname' => $_POST['firstName'],
            'lastname' => $_POST['lastName'],
            'social_id' => $_POST['social_id']
        ]);

        // in case the user already exists
        if($user_id === false) {
            $social_id = addslashes($_POST['social_id']);
            $user_id = get_one("SELECT user_id FROM users WHERE social_id = '$social_id'");
        }

        $_SESSION['user_id'] = $user_id;
        $_SESSION['social_id'] = $_POST['social_id'];
        $_SESSION['name'] = $_POST['firstName'].' '.$_POST['lastName'];

        echo "ok";
    }

    function POST_index()
    {
        echo "\$_POST:<br>";
        var_dump($_POST);
    }
}