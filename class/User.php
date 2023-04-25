<?php
class User{
    public $id, $email, $password, $fname, $lname, $tel, $userlevel, $activation, $updated; 

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

    public function resetPassword($pdo){
        if ($this->userlevel){
            $activation = bin2hex(random_bytes(16));
            $url = 'https://'.$_SERVER['HTTP_HOST'].'?account&username='.$this->email.'&activation='.$activation;
            updateTableItemWhere('user', 'activation', $activation, 'email', $this->email, $pdo);
            mail($this->email, 'sirius recover', $url);
        }
    }

    public function createUser($userMail, $pdo){
        if (filter_var($userMail, FILTER_VALIDATE_EMAIL)  && !(selectAllFromWhere('user', 'email', $userMail, $pdo)) && ($this->userlevel > 1)) {
            insertInto('user', 'email', $userMail, $pdo);
            $activation = bin2hex(random_bytes(16));
            $url = 'https://'.$_SERVER['HTTP_HOST'].'?account&username='.$userMail.'&activation='.$activation;
            updateTableItemWhere('user', 'activation', $activation, 'email', $userMail, $pdo);
            #$headers = array('From' => 'hugo@astrek.net', 'Reply-To' => 'sirius@astrek.net');
            mail($userMail, 'sirius acivation', $url); 
        }    
    }

    public function updateUserlevel($userId, $userLevel, $pdo){
        if (($row = selectAllFromWhere('user', 'id', $userId, $pdo)) &&  $this->userlevel > 1 && $row[0]['userlevel'] < $this->userlevel && $userLevel < $this->userlevel)
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
