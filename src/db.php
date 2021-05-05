<?php
/*
====================================================================================
                      CONNECT / DISCONNECT TO ORACLE
====================================================================================
*/
function connectToDB() {
    global $db_conn;

    // Your username is ora_(CWL_ID) and the password is a(student number). For example, 
    // ora_platypus is the username and a12345678 is the password.
    $db_conn = OCILogon("ora_bdai00", "a82496506", "dbhost.students.cs.ubc.ca:1522/stu");

    if ($db_conn) {
        debugAlertMessage("Database is Connected");
        return true;
    } else {
        debugAlertMessage("Cannot connect to Database");
        $e = OCI_Error(); // For OCILogon errors pass no handle
        echo htmlentities($e['message']);
        return false;
    }
}

function disconnectFromDB() {
    global $db_conn;

    debugAlertMessage("Disconnect from Database");
    OCILogoff($db_conn);
}

/*
====================================================================================
                      BUILD INSERT, UPDATE, DELETE, QUERY
====================================================================================
*/

/*
 * Return INSERT command for inserting a tuple into table with given attributes
 * 
 * @param table         name of the table for INTO clause
 * @param conditions    array of values for tuple in the form [attribute => value], 
 *                      eg. ["ID" => 1, "pname" => "'Amy Huynh'", "email" => "'amyh32@gmail.com'", "school" => "'UBC'"]
 * 
 * @return the string corresponding to the SQL insert command with the given table
 *         and values
 */
function insertStr($table, $values) {
    $attributesArr = [];
    $valuesArr = [];
    foreach ($values as $attribute => $value) {
        array_push($attributesArr, $attribute);
        array_push($valuesArr, $value);
    }
    $attributesStr = join(", ", $attributesArr);
    $valuesStr = join(", ", $valuesArr);
    $result = "INSERT INTO " . $table . "(" . $attributesStr . ") VALUES (" . $valuesStr . ");";
    return $result;
}

/*
 * Return UPDATE command for updating tuples from table with given attributes.
 * 
 * @param table         name of the table for UPDATE clause
 * @param conditions    array of attributes in the form [attribute => value], 
 *                      eg. ["pname" => "'Amy Huynh'", "school" => "'UBC'"]
 * 
 * @return the string corresponding to the SQL update command with the given table
 *         and conditions
 */
function updateStr($table, $values, $conditions=[]) {
    $valuesArr = [];
    foreach ($values as $attribute => $value) {
        array_push($valuesArr, $attribute . "=" . $value);
    }
    $valuesStr = join(", ", $valuesArr);
    $conditionsArr = [];
    foreach ($conditions as $attribute => $value) {
        array_push($conditionsArr, $attribute . "=" . $value);
    }
    $conditionsStr = join(" AND ", $conditionsArr);
    $result = "UPDATE " . $table . " SET " . $valuesStr . (($conditionsStr === "") ? "" : " WHERE " . $conditionsStr) . ";";
    return $result;
}

/*
 * Return DELETE command for deleting tuples from table satisfying given conditions.
 * 
 * @param table         name of the table for FROM clause
 * @param conditions    array of conditions in the form [attribute => value], 
 *                      eg. ["pname" => "'Amy Huynh'", "school" => "'UBC'"]
 * 
 * @return the string corresponding to the SQL delete command with the given table
 *         and conditions
 */
function deleteStr($table, $conditions) {
    $conditionsArr = [];
    foreach ($conditions as $attribute => $value) {
        array_push($conditionsArr, $attribute . "=" . $value);
    }
    $conditionsStr = join(" AND ", $conditionsArr);
    $result = "DELETE FROM " . $table . " WHERE " . $conditionsStr . ";";
    return $result;
}


/*
====================================================================================
                                DEMO
====================================================================================
*/

echo insertStr("Participant", ["ID" => 1, "pname" => "'Amy Huynh'", "email" => "'amyh32@gmail.com'", "school" => "'UBC'"]), "</br>";
echo deleteStr("Participant", ["pname" => "'Amy Huynh'", "school" => "'UBC'"]), "</br>";
echo updateStr("Workshop", ["wtime" => '12:00:00', "roomNum" => "'123'"], ["title" => "'Introduction to Python'"]), "</br>";
