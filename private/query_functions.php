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
        $sql .= "WHERE id='" . db_escape($db,$id) . "'";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result); 
        // since i'm done with this data, i can free up the data set
        mysqli_free_result($result);
        return $subject; // returns an assoc array
    }

    function validate_subject($subject){
        
        $errors = [];

        // menu_name
        // this $errors[] syntax is to add things to the end of the array
        if(is_blank($subject['menu_name'])){
            $errors[] = "Name cannot be blank."; 
        } else if(!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Name must be between 2 and 255 characters.";
        }

        // position
        // Make sure we are working with an integer
        $position_int = (int) $subject['position'];
        if($position_int <= 0){
            $errors[] = "Position must be greater than zero.";
        }
        if($position_int > 999){
            $errors[] = "Position must be less than 999.";
        }

        // visible
        // Make sure we are working with a string
        $visible_str = (string) $subject['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])){
            $errors[] = "Visible must be true or false";
        }

        return $errors;
    }

    function validate_page($page){
        
        $errors = [];

        // subject_id
        if(is_blank($page['subject_id'])){
            $errors[] = "Subject cannot be blank.";
        }

        // menu_name
        // this $errors[] syntax is to add things to the end of the array
        if(is_blank($page['menu_name'])){
            $errors[] = "Name cannot be blank."; 
        } else if(!has_length($page['menu_name'], ['min' => 2, 'max' => 255])) {
            $errors[] = "Name must be between 2 and 255 characters.";
        }
        $current_id = $page['id'] ?? '0';
        if(!has_unique_page_menu_name($page['menu_name'], $current_id)) {
            $errors[] = "Menu name must be unique.";
        }

        // position
        // Make sure we are working with an integer
        $position_int = (int) $page['position'];
        if($position_int <= 0){
            $errors[] = "Position must be greater than zero.";
        }
        if($position_int > 999){
            $errors[] = "Position must be less than 999.";
        }

        // visible
        // Make sure we are working with a string
        $visible_str = (string) $page['visible'];
        if(!has_inclusion_of($visible_str, ["0","1"])){
            $errors[] = "Visible must be true or false";
        }

        // content
        if(is_blank($page['content'])){
            $errors[] = "Content cannot be blank.";
        }

        return $errors;
    }

    function update_subject($subject){
        global $db;

        $errors = validate_subject($subject); // check if there were any errors
        if(!empty($errors)){
            return $errors;
        }

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

    function insert_subject($subject){
        global $db;

        $errors = validate_subject($subject); // check if there were any errors
        if(!empty($errors)){
            return $errors;
        }
        
        $sql =  "INSERT INTO subjects ";
        $sql .= "(menu_name, position, visible) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db,$subject['menu_name']) . "',";
        $sql .= "'". db_escape($db,$subject['position']) . "',";
        $sql .= "'" . db_escape($db,$subject['visible']) . "'";
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

    function delete_subject($id){
        global $db;
        
        $sql = "DELETE FROM subjects ";
        $sql .= "WHERE id='" . $id . "' ";
        $sql .= "LIMIT 1";
    
        $result = mysqli_query($db, $sql);
    
        // For DELETE statements, $result is true/false
    
        if($result) {
            return true;
        } else {
            // DELETE failed
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
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

    function find_page_by_id($id){
        global $db;

        $sql = "SELECT * FROM pages ";
        $sql .= "WHERE id='$id' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql); // send the query to the database 
        confirm_result_set($result); // ensure it is correct else DATABASE failed
        $page = mysqli_fetch_assoc($result); // take the result and give it into a associative array
        mysqli_free_result($result); // release the data

        return $page;
    }

    function insert_page($page){
        global $db;

        $errors = validate_page($page);
        if(!empty($errors)){
            return $errors;
        }

        $sql = "INSERT INTO pages ";
        $sql .= "(subject_id, menu_name, position, visible, content) ";
        $sql .= "VALUES (";
        $sql .= "'" . db_escape($db,$page['subject_id']) . "', ";
        $sql .= "'" . db_escape($db,$page['menu_name']) . "', "; 
        $sql .= "'" . db_escape($db,$page['position']) . "', "; 
        $sql .= "'" . db_escape($db,$page['visible']) . "', "; 
        $sql .= "'" . db_escape($db,$page['content']) . "'";
        $sql .= ")"; 

        $result = mysqli_query($db,$sql);


        if($result){
            return true;
        } else {
        echo $sql;
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
        }
    }

    function update_page($page){
        global $db;

        $errors = validate_page($page);
        if(!empty($errors)){
            return $errors;
        }

        $sql = "UPDATE pages SET ";
        $sql .= "subject_id='" . db_escape($db,$page['subject_id']) . "', ";
        $sql .= "menu_name='" . db_escape($db,$page['menu_name']) . "', ";
        $sql .= "position='" . db_escape($db,$page['position']) . "', ";
        $sql .= "visible='" . db_escape($db,$page['visible']) . "', ";
        $sql .= "content='" . db_escape($db,$page['content']) . "' ";
        $sql .= "WHERE id='" . db_escape($db,$page['id'] ). "' ";
        $sql .= "LIMIT 1";

        $result = mysqli_query($db, $sql);
        // $returns true/false
        if($result) {
            return true;
        } else {
            // Update fails
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }

    }

    function delete_page($id){
        global $db;

        $sql = "DELETE FROM pages ";
        $sql .= "WHERE id='$id' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);

        if($result){
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

?>