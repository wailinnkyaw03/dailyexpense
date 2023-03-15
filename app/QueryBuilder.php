<?php 

class QueryBuilder{
    private $conn;
    public function __construct($connection){
        $this->conn = $connection;
        return $this->conn;
    }

    //create
    public function create($table, $datas){
        $column_names = implode("," , array_keys($datas));
        $bind_values = implode(", :", array_keys($datas));
        $sql = "INSERT INTO $table($column_names) VALUES(:$bind_values)";

        $stmt = $this->conn->prepare($sql);
        foreach($datas as $key => &$value){
            $stmt->bindParam(":".$key, $value);
        }
        $stmt->execute();
        return true;
    }
    //getAllJoin
    public function getAll($table, $cols, $join, $where, $order){
        $sql = "SELECT $cols FROM $table";
        if($join != null){
            $sql .= " $join";
        }
        if($where != null){
            $sql .= " WHERE $where";
        }
        if($order != null){
            $sql .= " ORDER BY $order";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    
    }
    //getoneJoin
    public function get($table, $cols, $join, $where){
        $sql = "SELECT $cols FROM $table";
        if($join != null){
            $sql .= " $join";
        }
        if($where != null){
            $sql .= " WHERE $where";
        }
        // echo $sql;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //update
    public function update($table, $datas, $id){
        $edits = "";
        foreach($datas as $key=>$value){ 
            $edits .= "$key=:$key,"; 
        }
        $edits = rtrim($edits, ',');
        $sql = "UPDATE $table SET $edits WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        foreach($datas as $key => &$value){
            $stmt->bindParam(":".$key, $value);
        }
        $stmt->execute();
        return true;
    }

    //delete
    public function delete($table, $id){
        $sql = "DELETE FROM $table WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return true;
    }
}

?>