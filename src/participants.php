<html>

<head>
  <link rel="stylesheet" href="style.css">
  <link rel="icon" type="image/x-icon" href="logo.png">
  <title>nwminus - For Participants</title>
</head>

<body>
  <h1>For Participants</h1>
  <button class="button" onclick="window.location.href='index.php';">Back to Home</button>
  <br><br>

  <div class="queryDiv">
    <h2>Register</h2>
    <form method="POST" action="participants.php">
      <!--refresh page when submitted-->
      <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
      ID: <input type="text" name="insID"> <br /><br />
      Name: <input type="text" name="insName"> <br /><br />
      Email: <input type="text" name="insEmail"> <br /><br />
      School: <input type="text" name="insSchool"> <br /><br />

      <input class="button" type="submit" value="Register" name="insertSubmit"></p>
    </form>
  </div>
  <br><br>

  <?php
  //this tells the system that it's no longer just parsing html; it's now parsing PHP
  $success = True; //keep track of errors so it redirects the page only if there are no errors
  $db_conn = NULL; // edit the login credentials in connectToDB()
  $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())
  function debugAlertMessage($message)
  {
    global $show_debug_alert_messages;
    if ($show_debug_alert_messages) {
      echo "<script type='text/javascript'>alert('" . $message . "');</script>";
    }
  }
  function executePlainSQL($cmdstr)
  { //takes a plain (no bound variables) SQL command and executes it
    //echo "<br>running ".$cmdstr."<br>";
    global $db_conn, $success;
    $statement = OCIParse($db_conn, $cmdstr);
    //There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work
    if (!$statement) {
      echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
      $e = OCI_Error($db_conn); // For OCIParse errors pass the connection handle
      echo htmlentities($e['message']);
      $success = False;
    }
    $r = OCIExecute($statement, OCI_DEFAULT);
    if (!$r) {
      echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
      $e = oci_error($statement); // For OCIExecute errors pass the statementhandle
      echo htmlentities($e['message']);
      $success = False;
    }
    return $statement;
  }
  function executeBoundSQL($cmdstr, $list)
  {
    /* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection. 
		See the sample code below for how this function is used */
    global $db_conn, $success;
    $statement = OCIParse($db_conn, $cmdstr);
    if (!$statement) {
      echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
      $e = OCI_Error($db_conn);
      echo htmlentities($e['message']);
      $success = False;
    }
    foreach ($list as $tuple) {
      foreach ($tuple as $bind => $val) {
        // echo $val;
        // echo "<br>".$bind."<br>";
        OCIBindByName($statement, $bind, $val);
        unset($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
      }
      $r = OCIExecute($statement, OCI_DEFAULT);
      if (!$r) {
        echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
        $e = OCI_Error($statement); // For OCIExecute errors, pass the statementhandle
        echo htmlentities($e['message']);
        echo "<br>";
        $success = False;
      }
    }
  }
  function printTableResult($result)
  { //prints results from a select statement
    echo "<div class='queryDiv'><table>";
    echo "<tr>";
    // https://www.php.net/manual/en/function.oci-num-fields.php
    $ncols = oci_num_fields($result);
    for ($i = 1; $i <= $ncols; $i++) {
      echo "<th>" . oci_field_name($result, $i) . "</th>";
    }
    echo "</tr>\n";
    while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
      echo "<tr>";
      $i = 0;
      foreach ($row as $v) {
        if ($i % 2 == 0) {
          echo "<td>" . $v . "</td>";
        }
        $i++;
      }
      echo "</tr>\n";
    }
    echo "</table></div>";
  }
  function connectToDB()
  {
    global $db_conn;
    // Your username is ora_(CWL_ID) and the password is a(student number). For example, 
    // ora_platypus is the username and a12345678 is the password.
    $db_conn = OCILogon("ora_season12", "a27239169", "dbhost.students.cs.ubc.ca:1522/stu");
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
  function disconnectFromDB()
  {
    global $db_conn;
    debugAlertMessage("Disconnect from Database");
    OCILogoff($db_conn);
  }
  function handleUpdateRequest()
  {
    global $db_conn;
    $old_name = $_POST['oldName'];
    $new_name = $_POST['newName'];
    // you need the wrap the old name and new name values with single quotations
    executePlainSQL("UPDATE Workshop SET roomNum='" . $new_name . "' WHERE title='" . $old_name . "'");
    OCICommit($db_conn);
  }
  function handleInsertRequest()
  {
    echo "INSERTING!";
    global $db_conn;
    //Getting the values from user and insert data into the table
    $tuple = array(
      ":bind1" => $_POST['insID'],
      ":bind2" => $_POST['insName'],
      ":bind3" => $_POST['insEmail'],
      ":bind4" => $_POST['insSchool'],
    );
    $alltuples = array(
      $tuple
    );
    executeBoundSQL("insert into Participant values (:bind1, :bind2, :bind3, :bind4)", $alltuples);
    OCICommit($db_conn);
  }
  function handleDeleteRequest()
  {
    global $db_conn;
    executePlainSQL("DELETE FROM Guest WHERE gname='" . $_POST['delName'] . "'");
    OCICommit($db_conn);
  }
  function handleSelectTableRequest()
  {
    global $db_conn;

    $result = executePlainSql("SELECT * FROM " . $_GET["selectTable"]);

    printTableResult($result);
  }
  
  // HANDLE ALL POST ROUTES
  // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
  function handlePOSTRequest()
  {
    if (connectToDB()) {
      if (array_key_exists('updateQueryRequest', $_POST)) {
        handleUpdateRequest();
      } else if (array_key_exists('insertQueryRequest', $_POST)) {
        handleInsertRequest();
      } else if (array_key_exists('deleteQueryRequest', $_POST)) {
        handleDeleteRequest();
      }
      disconnectFromDB();
    }
  }
  // HANDLE ALL GET ROUTES
  // A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
  function handleGETRequest()
  {
    if (connectToDB()) {
      if (array_key_exists('checkSubmit', $_GET)) {
        handleSelectRequest();
      } else if (array_key_exists('projectTuples', $_GET)) {
        handleProjectRequest();
      } else if (array_key_exists('selectTable', $_GET)) {
        handleSelectTableRequest();
      }
      disconnectFromDB();
    }
  }

  if (isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['deleteSubmit'])) {
    handlePOSTRequest();
  } else if (isset($_GET['checkQueryRequest']) || isset($_GET['projectTupleRequest']) || isset($_GET['selectTableSubmit'])) {
    handleGETRequest();
  }
  ?>
</body>

</html>