<?php
class User{
    public $id, $email, $password, $fname, $lname, $tel, $userlevel, $created; 

    public function __construct($pMail, $pdo){
        if ($row = selectAllFromWhere('user', 'email', filter_var($pMail, FILTER_VALIDATE_EMAIL), $pdo)) {
            foreach ($row[0] as $k => $v) {
                $this->$k = $v;
            }
        }
    }

    public function validate($pPassword){
        return ($pPassword === $this->password ? true : false);
    }

    public function resetPassword($me, $userId, $pdo){
        if ($row = selectAllFromWhere('user', 'id', $userId, $pdo) &&  $me->userlevel > 1 && $row[0]['userlevel'] < $me->userlevel) 
            updateTableItemWhere('user', 'password', NULL, 'id', $userId, $pdo);
    }

    public function updateUserlevel($me, $userId, $userLevel, $pdo){
        if ($row = selectAllFromWhere('user', 'id', $userId, $pdo) &&  $me->userlevel > 1 && $row[0]['userlevel'] < $me->userlevel && $userLevel < $me->userlevel)
            updateTableItemWhere('user', 'userlevel', $userLevel, 'id', $userId, $pdo);
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
        $this->id = $pId;
        $this->user_id = $pUser_id;
        $this->safari_id = $pSafari_id;
        $this->erp_link = $pErp_link;
        $this->date = $pDate;
        $this->route = $pRoute;
        $this->remarks = $pRemarks;
        $this->done = $pDone;
    }
}
?>
