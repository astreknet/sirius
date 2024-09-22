<?php
class Safari{
    public $id, $zone_id, $name, $length, $weekday, $description, $time, $price_adult, $price_solo, $price_child, $active;

    public function __construct($id, $zone_id, $name, $length, $weekday, $description, $time, $price_adult, $price_solo, $price_child, $active){
        $this->id = $id;
        $this->zone_id = $zone_id;
        $this->name = $name;
        $this->length = $length;
        $this->weekday = $weekday;
        $this->description = $description;
        $this->time = $time;
        $this->price_adult = $price_adult;
        $this->price_solo = $price_solo;
        $this->price_child = $price_child;
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
