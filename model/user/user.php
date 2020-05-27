<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::schemaUser();
    }
    
    public function validateUser($email, $password)
    {
        $sql = 'SELECT * FROM user WHERE email=:email';
        $statement = $this->db->prepare($sql);
        $statement->execute(array(
            ':email'=> $email
        ));
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);
        // print_r($user);
        if (isset($user)) {
            return $user[0]['password'] == $password;
        } else {
            return false;
        }
    }

    public function getUser($email)
    {
        $sql = 'SELECT * FROM user WHERE email=:email';
        $statement = $this->db->prepare($sql);
        $statement->execute(array(
            ':email'=> $email
        ));
        $user = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (isset($user)) {
            return $user;
        } else {
            return false;
        }
    }
}
