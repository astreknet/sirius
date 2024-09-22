<?php
class Zone{
    public $id, $name, $address, $active;

    public function __construct($id, $name, $address, $active){
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->active = $active;
    }
    
    public function create($name){
        $sql = 'INSERT INTO zone (name) values (:name)';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        $sql = 'SELECT LAST_INSERT_ID() as id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    public function update($id, $item, $value){
        $sql = 'UPDATE zone SET '.$item.' = :'.$item.' WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':'.$item, $value);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $stmt->closeCursor();
    }
}
?>
