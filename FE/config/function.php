<?php
    require_once('config/db.php');
    
    function display_data(){
        global $conn;
        $sql = "SELECT * FROM infor_news ORDER BY id DESC limit 10";
        $result = $conn->query($sql);

        return $result;
    }

    function display_data_no_limit(){
        global $conn;
        $sql = "SELECT * FROM infor_news ORDER BY id ASC " ;
        $result = $conn->query($sql);
        return $result;
    }

    function display_data_limit($limit){
        global $conn;
        $sql = "SELECT * FROM infor_news  ORDER BY id DESC limit $limit " ;
        $result = $conn->query($sql);
        return $result;
    }

    function display_data_filter_by_date($date_from, $date_to, $limit){
        global $conn;
        $sql = "SELECT * FROM infor_news where created_at between '".$date_from."' and '".$date_to."' limit $limit ";
        $result = $conn->query($sql);

        return $result;
    }
    
?>