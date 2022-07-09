<?php

class Model
{
    public function requestPreparation($arr){

        $keys = array_keys($arr);
        $firstKey = $keys[0];

        if ((isset($arr[$firstKey]))){
            $queryDelete = "DELETE FROM `".NAME_TABLE_MYQSL."`";
            $resultDel = $this->db->query($queryDelete);

            $fields = '';

            $keys = array_keys($arr);
            $firstKey = $keys[0];

            foreach ($arr[$firstKey] as $key => $cell) {

                $fields .= '`' . $key . '`' . ',';

            }
            $fields = trim($fields, ',');

            $str = '';
            // INSERT INTO `main` (``,``,``..) VALUES ('','','',),(),(),();
            foreach ($arr as $item) {
                $str .= "(";
                foreach ($item as $cell) {

                    $str .= "'" . $cell . "',";
                }
                $str = trim($str, ",");
                $str .= "),";
            }
            $str = trim($str, ",");
            $query = "INSERT INTO `".NAME_TABLE_MYQSL."` (" . $fields . ") VALUES " . $str;
            $result = $this->db->query($query);

            if($result) {
                return TRUE;
            }else{
                print_r($this->db->errorInfo());
                return false;
            }

            if($resultDel) {
                return TRUE;
            }else{
                print_r($this->db->errorInfo());
                return false;
            }
        }else{
            return false;
        }
    }

    public function connect() {
        $this->db = new PDO(DSN, USER_NAME_DB, PASSWORD_DB);
    }

    public function __construct() {
        try {
            $this->connect();
        }
        catch(\Exception $e) {
            echo "\nPDO::errorInfo():\n";
            echo $e->getMessage();
            exit();
        }
    }
}