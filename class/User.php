<?php
class User{
    public $mail, $password;

    public function __construct($pMail, $pPassword){
        $this->mail = htmlspecialchars(stripslashes(trim($pMail)));
        $this->password = hash('sha256', htmlspecialchars(stripslashes(trim($pPassword))));
    }

    public function login($pdo){
        $r = getUserByMail($this->mail, $pdo);
        $userLogged = (($this->password === $r['password']) ? new UserLogged($this->mail, $this->password, $r['id'], $r['name'], $r['surname'], $r['admin'], $r['active'], $pdo) : NULL );
        return $userLogged;
    }
}

class UserLogged extends User{
    public $id, $name, $surname, $admin, $active, $trips;

    public function __construct($pMail, $pPassword, $pId, $pName, $pSurname, $pAdmin, $pActive, $pdo){
        parent::__construct($pMail, $pPassword);
        $this->id = $pId;
        $this->name = $pName;
        $this->surname = $pSurname;
        $this->admin = $pAdmin;
        $this->active = $pActive;
        $this->trips = getTripsByUser($pId, $pdo);
        $this->accidents = getAccidentsByTrip($pId, $pdo);
    }
    
    public function showTrips($pdo){
        getTripsByUser($userId, $pdo);
    }
}
?>
