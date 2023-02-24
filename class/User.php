<?php
class User{
    public $mail;
    public $id, $name, $surname, $admin, $active, $trip, $accident, $nearmiss;

    public function __construct($pMail, $pdo){
        $this->mail = $pMail;
        if ($r = getUserByMail($this->mail, $pdo)) {
            $this->id = $r['id'];
            $this->name = $r['name'];
            $this->surname = $r['surname'];
            $this->admin = $r['admin'];
            $this->active = $r['active'];
            $this->trip = getTripsByUser($this->id, $pdo);
            $this->accident = getAccidentsByUser($this->id, $pdo);
            $this->nearmiss = getNearmissByUser($this->id, $pdo);
        }
    }
}
/* FOR THE FUTURE CUSTOMERS ALSO USERS
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
//        $this->accidents = getAccidentsByTrip($pId, $pdo);
    }
    
    public function showTrips($pdo){
        getTripsByUser($userId, $pdo);
    }
}
*/
?>
