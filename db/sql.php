<?php

/**
 * Various sql standard functions for manipulating the database
 */
function sqliFetch($query) {
    global $mysqli;
    if ($query != "") {
        $result = mysqli_query(mysqli, $query);

        if (mysqli_error($mysqli)) {
            var_dump($query, mysqli_error($mysqli));
        }
        return $result->fetch_object();
    } else {
        return null;
    }
}

function sqliQuery($query) {
    global $mysqli;
    if ($query != "") {
        $result = $mysqli->query($query);
        if (mysqli_error($mysqli)) {
            var_dump($query, mysqli_error($mysqli));
        }
        return $result;
    } else {
        return null;
    }
}

function sqliQueryMulti($query) {
    global $mysqli;
    if ($query != "") {
        $mysqli->multi_query($query);
        if (mysqli_error($mysqli)) {
            var_dump($query, mysqli_error($mysqli));
        }
        while ($mysqli->next_result()) {
            ;
        }
    }
}

function sqliInsertId() {
    global $mysqli;
    return mysqli_insert_id($mysqli);
}

function sqliEscape($str) {
    global $mysqli;
    return $mysqli->real_escape_string($str);
}

?>
