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

    public function validate_pass($pass){
        return ($pass === $this->password ? true : false);
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

class Guide extends User{
    public $gig, $nearmiss, $accident, $issue;

    public function __construct($pMail, $pdo){
        parent::__construct($pMail, $pdo);
        $this->gig = selectAllFromWhere('gig', 'user_id', $this->id, $pdo);
        $this->nearmiss = selectAllFromWhere('nearmiss', 'user_id', $this->id, $pdo);
        $this->accident = selectAllFromWhere('accident', 'user_id', $this->id, $pdo);
        $this->issue = selectAllFromWhere('issue', 'user_id', $this->id, $pdo);
    }

    public function updateTable($table, $tableId, $inputs, $checks, $pdo){
        foreach ($inputs as $in) {
            (!isset($_POST[$in]) && empty($_POST[$in]) ?: updateTableItemWhere($table, $in, $_POST[$in], 'id', $tableId, $pdo));
        }
        foreach($checks as $c) {
            (isset($_POST[$c]) ? updateTableItemWhere($table, $c, 1, 'id', $tableId, $pdo) : updateTableItemWhere($table, $c, 0, 'id', $tableId, $pdo));
        }
    }
}

class Admin extends Guide{
    public $allgig, $allincident, $allissue, $alluser;

    public function __construct($pMail, $pdo){
        parent::__construct($pMail, $pdo);
        $this->allgig = selectAllFrom('gig', $pdo);
        $this->allincident = selectAllFrom('nearmiss', $pdo);
        $this->allissue = selectAllFrom('issue', $pdo);
        $this->alluser = selectAllFrom('user', $pdo);
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
    public $id, $user_id, $safari_id, $erp_link, $datetime, $route, $remarks, $done;

    public function __construct($pId, $pUser_id, $pSafari_id, $pErp_link, $pDatetime, $pRoute, $pRemarks, $pDone){
        $this->id = $pId;
        $this->user_id = $pUser_id;
        $this->safari_id = $pSafari_id;
        $this->erp_link = $pErp_link;
        $this->datetime = $pDatetime;
        $this->route = $pRoute;
        $this->remarks = $pRemarks;
        $this->done = $pDone;
    }
}
?>
