<?php
class User{
    public $email, $password, $id, $name, $surname, $phone, $admin, $active; 
    #public $trip, $accident, $nearmiss;

    public function __construct($pMail, $pdo){
        if ($r = getUserByMail(filter_var($pMail, FILTER_VALIDATE_EMAIL), $pdo)) {
            $this->email = $r['email'];
            $this->id = $r['id'];
            $this->password = $r['password'];
            $this->name = $r['name'];
            $this->surname = $r['surname'];
            $this->phone = $r['phone'];
            $this->admin = $r['admin'];
            $this->active = $r['active'];
            #$this->trip = getTripsByUser($this->id, $pdo);
            #for($i=0; $i<count($this->trip); $i++){
            #    $this->trip[$i]['accident'] = getAccidentsByTripID($this->trip[$i]['id'], $pdo);
            #    $this->trip[$i]['near_miss'] = getNear_missesByTripID($this->trip[$i]['id'], $pdo);
            #}
            #$this->accident = getAccidentsByUser($this->id, $pdo);
            #$this->nearmiss = getNearmissByUser($this->id, $pdo);
        }
    }

    public function validate($pPassword){
        return ($pPassword === $this->password ? true : false);
    }
}

class Safari{
    public $id, $name, $length, $weekday, $description, $time, $active;

    public function __construct($id, $name, $length, $weekday, $description, $time, $active){
        $this->id = $id;        
        $this->name = $name;        
        $this->length = $length;        
        $this->weekday = $weekday;        
        $this->description = $description;        
        $this->time = $time;        
        $this->active = $active;        
    }
}

class Trip{
    public $id, $user_id, $safari_id, $erp_link, $date, $route, $remarks, $done;

    public function __construct($pId, $pUser_id, $pSafari_id, $pErp_link, $pDate, $pRoute, $pRemarks, $pDone){
//        if ($r = getTripsByUser($pUserId, $pdo)){
            $this->id = $pId;
            $this->user_id = $pUser_id;
            $this->safari_id = $pSafari_id;
            $this->erp_link = $pErp_link;
            $this->date = $pDate;
            $this->route = $pRoute;
            $this->remarks = $pRemarks;
            $this->done = $pDone;
//        }
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
