<?php
class Session
{
    public function index(Type $var = null)
    {
        require_once 'views/assets/header.php';
        require_once 'views/session/session.php';
        require_once 'views/assets/footer.php';
    }
    public function welcome(Type $var = null)
    {
        require_once 'views/assets/header.php';
        require_once 'views/session/welcome.php';
        require_once 'views/assets/footer.php';
    }
    public function login()
    {
        require_once 'model/user/User.php';
        $user = new User();
        if ($user->validateUser($_POST['email'], $_POST['password'])) {
            $_SESSION['user'] = hash('md5',$user->getUser($_POST['email'])[0]['username']);
        }
        header('location: .');
    }
    public function logout(Type $var = null)
    {
        session_destroy();
        $_SESSION = array();
        header('location: .');
    }
}
