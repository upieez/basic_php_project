<?php 

    function find_all_subjects(){
        global $db;

        $sql = "SELECT * FROM subjects ";
        $sql .= "ORDER BY position ASC";
        // echo $sql if you wanna check for the error
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        return $result;
    }

    function find_subject_by_id($id){
        global $db;

        $sql = "SELECT * FROM subjects ";
        $sql .= "WHERE id='" . $id . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result); 
        // since i'm done with this data, i can free up the data set
        mysqli_free_result($result);
        return $subject; // returns an assoc array
    }

    function update_subject($subject){
        global $db;

        $sql = "UPDATE subjects SET ";
        $sql .= "menu_name='" . $subject['menu_name'] . "',";
        $sql .= "position='" . $subject['position'] . "',";
        $sql .= "visible='" . $subject['visible'] . "' ";
        $sql .= "WHERE id='" . $subject['id'] . "' ";
        $sql .= "LIMIT 1"; // not necessary but it's extra safety measure

        $result = mysqli_query($db, $sql);
        // For UPDATE statements, $result is true/false
        if($result){
            // redirect_to(url_for('/staff/subjects/show.php?id=' . $id));
            return true;
        } else {
            // UPDATE failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function insert_subject($subject) {
        global $db;

        $menu_name = $_POST['menu_name'] ?? '';
        $position = $_POST['position'] ?? '';
        $visible = $_POST['visible'] ?? '';
        
        $sql =  "INSERT INTO subjects ";
        $sql .= "(menu_name, position, visible) ";
        $sql .= "VALUES (";
        $sql .= "'" . $subject['menu_name'] . "',";
        $sql .= "'". $subject['position'] . "',";
        $sql .= "'" . $subject['visible'] . "'";
        $sql .= ")";
        $result = mysqli_query($db,$sql);
        // For INSERT statements, $result is true/false
        if($result){
            return true;
        } else {
            // INSERT failed report back the error
            echo mysqli_error($db);
            db_disconnect($db);
            exit; // quit everything and not run
        }
    }

    function find_all_pages(){
        global $db;

        $sql = "SELECT * FROM pages ";
        $sql .= "ORDER BY subject_id ASC, position ASC";
        $result = mysqli_query($db,$sql);
        confirm_result_set($result);
        return $result;
    }

?>