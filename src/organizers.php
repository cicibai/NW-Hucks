<!--Test Oracle file for UBC CPSC304 2018 Winter Term 1
  Created by Jiemin Zhang
  Modified by Simona Radu
  Modified by Jessica Wong (2018-06-22)
  This file shows the very basics of how to execute PHP commands
  on Oracle.  
  Specifically, it will drop a table, create a table, insert values
  update values, and then query for values
 
  IF YOU HAVE A TABLE CALLED "demoTable" IT WILL BE DESTROYED
  The script assumes you already have a server set up
  All OCI commands are commands to the Oracle libraries
  To get the file to work, you must place it somewhere where your
  Apache server can run it, and you must rename it to have a ".php"
  extension.  You must also change the username and password on the 
  OCILogon below to be your ORACLE username and password -->

  <html>
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="icon" type="image/x-icon" href="logo.png">
        <title>nwminus - For Organizers</title>
    </head>

    <body>
        <h1>For Organizers</h1>
        <button class="button" onclick="window.location.href='index.php';">Back to Home</button><br><br>

        <div class="resetDiv">
            <h2>Reset</h2>
            <p>If you wish to reset the table press on the reset button. If this is the first time you're running this page, you MUST use reset</p>

            <form method="POST" action="organizers.php">
                <!-- if you want another page to load after the button is clicked, you have to specify that page in the action parameter -->
                <input type="hidden" id="resetTablesRequest" name="resetTablesRequest">
                <p><input class="button" type="submit" value="Reset" name="reset"></p>
            </form>
        </div><br><br>

        <div class="queryDiv">
            <h2>Show tables</h2>
            <form method="GET" action="organizers.php"> <!--refre sh page when submitted-->
                <input type="hidden" id="selectTableRequest" name="selectTableRequest">
                <select name="selectTable" id="selectTable">
                    <option value="Participant">Participant</option>
                    <option value="Hackathon">Hackathon</option>
                    <option value="Volunteer">Volunteer</option>
                    <option value="Workshop">Workshop</option>
                    <option value="Organizer">Organizer</option>
                    <option value="MarketingRecruitment">Marketing Recruitment</option>
                    <option value="Hospitality">Hospitality</option>
                    <option value="Caterer">Caterer</option>
                    <option value="SponsorshipOutreach">Sponsorship Outreach</option>
                    <option value="Participant">Participant</option>
                    <option value="ParticipantSchool">Participant School</option>
                    <option value="Company">Company</option>
                    <option value="Guest">Guest</option>
                    <option value="Mentor">Mentor</option>
                    <option value="GuestSpeaker">Guest Speaker</option>
                    <option value="CompanyRepresentative">Company Representative</option>
                </select>

                <input class="button" type="submit" name="selectTableSubmit"></p>
            </form>
        </div><br><br>
        

        <div class="queryDiv">
            <h2>1. Add a Participant</h2>
            <form method="POST" action="organizers.php"> <!--refresh page when submitted-->
                <input type="hidden" id="insertQueryRequest" name="insertQueryRequest">
                ID: <input type="text" name="insID"> <br /><br />
                Name: <input type="text" name="insName"> <br /><br />
                Email: <input type="text" name="insEmail"> <br /><br />
                School: <input type="text" name="insSchool"> <br /><br />

                <input class="button" type="submit" value="Insert" name="insertSubmit"></p>
            </form>
        </div><br><br>
    

        <div class="queryDiv">
            <h2>2. Delete a guest </h2>
            <form method="POST" action="organizers.php"> <!--refresh page when submitted-->
                <input type="hidden" id="deleteQueryRequest" name="deleteQueryRequest">
                Name: <input type="text" name="delName"> <br /><br />

                <input class="button" type="submit" value="Delete" name="deleteSubmit"></p>
            </form>
        </div><br><br>

        <div class="queryDiv">
            <h2>3. Update a Workshop's Room Number</h2>
            <p>The values are case sensitive and if you enter in the wrong case, the update statement will not do anything.</p>

            <form method="POST" action="organizers.php"> <!--refresh page when submitted-->
                <input type="hidden" id="updateQueryRequest" name="updateQueryRequest">
                Workshop's Title: <input type="text" name="oldName"> <br /><br />
                New Room Number: <input type="text" name="newName"> <br /><br />

                <input class="button" type="submit" value="Update" name="updateSubmit"></p>
            </form>
        </div><br><br>
       

        <div class="queryDiv">
            <h2>4. Get the information of participants from ______ whose ID is greater than ______  </h2>
            <form method="GET" action="organizers.php"> <!--refresh page when submitted-->
                <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
                Participant's school: <input type="text" name="schoolName"> <br /><br />
                Minimum ID#: <input type="text" name="minID"> <br /><br />
                <input class="button" type="submit" name="selectTuples"></p>
            </form>
        </div><br><br>

        <div class="queryDiv">
            <h2>5. Get the volunteer's ID, name, and role for all the volunteers </h2>
            <form method="GET" action="organizers.php"> <!--refresh page when submitted-->
                <input type="hidden" id="projectTupleRequest" name="projectTupleRequest">
                <input class="button" type="submit" name="projectTuples"></p>
            </form>
        </div><br><br>

        <div class="queryDiv">
            <h2>6. Workshop attendance:</h2>
            <form method="GET" action="organizers.php"> <!--refresh page when submitted-->
                <input type="hidden" id="joinRequest" name="joinRequest">
                Workshop Name: <input type="text" name="workshopName"><br /><br>
                <input class="button" type="submit" name="join"></p>
            </form>
        </div><br><br>

        <div class="queryDiv">
            <h2>7. Find the number of participants who go to each school </h2>
            <form method="GET" action="organizers.php"> <!--refresh page when submitted-->
                <input type="hidden" id="countTupleRequest" name="countTupleRequest">
                <input class="button" type="submit" name="countTuples"></p>
            </form>
        </div><br><br>
    

        <div class="queryDiv">
            <h2>8. Find the schools that have 2 or more participants attending </h2>
            <form method="GET" action="organizers.php"> <!--refresh page when submitted-->
                <input type="hidden" id="aggregationHavingRequest" name="aggregationHavingRequest">
                <input class="button" type="submit" name="aggregationHaving"></p>
            </form>
        </div><br><br>

        <div class="queryDiv">
            <h2>9. For all the companies that are sponsoring a hackathon, which companies have sent more than one company representative? </h2>
            <form method="GET" action="organizers.php"> <!--refresh page when submitted-->
                <input type="hidden" id="nestedAggregationRequest" name="nestedAggregationRequest">
                <input class="button" type="submit" name="nestedAggregation"></p>
            </form>
        </div><br><br>

        <div class="queryDiv">
            <h2>10. Find all the names of the volunteers that have helped run all the hackathons </h2>
            <form method="GET" action="organizers.php"> <!--refresh page when submitted-->
                <input type="hidden" id="displayTupleRequest" name="displayTupleRequest">
                <input class="button" type="submit" name="divideTuples"></p>
            </form>
        </div><br><br>

        <?php
		//this tells the system that it's no longer just parsing html; it's now parsing PHP
        $success = True; //keep track of errors so it redirects the page only if there are no errors
        $db_conn = NULL; // edit the login credentials in connectToDB()
        $show_debug_alert_messages = False; // set to True if you want alerts to show you which methods are being triggered (see how it is used in debugAlertMessage())
        function debugAlertMessage($message) {
            global $show_debug_alert_messages;
            if ($show_debug_alert_messages) {
                echo "<script type='text/javascript'>alert('" . $message . "');</script>";
            }
        }
        function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
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
        function executeBoundSQL($cmdstr, $list) {
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
                    unset ($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
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
        function printTableResult($result) { //prints results from a select statement
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
        function connectToDB() {
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
        function disconnectFromDB() {
            global $db_conn;
            debugAlertMessage("Disconnect from Database");
            OCILogoff($db_conn);
        }
        function handleUpdateRequest() {
            global $db_conn;
            $old_name = $_POST['oldName'];
            $new_name = $_POST['newName'];
            // you need the wrap the old name and new name values with single quotations
            executePlainSQL("UPDATE Workshop SET roomNum='" . $new_name . "' WHERE title='" . $old_name . "'");
            OCICommit($db_conn);
        }
        function handleResetRequest() {
            global $db_conn;

            // reset all the tables and run initial setup sql script
            $file = fopen("hackathons-setup.sql","r");
            while(! feof($file)){
               $sql_str = fgets($file);
               executePlainSQL("" . $sql_str . "");
            }
            fclose($file);
        
            OCICommit($db_conn);
        }
        function handleInsertRequest() {
            global $db_conn;
            //Getting the values from user and insert data into the table
            $tuple = array (
                ":bind1" => $_POST['insID'],
                ":bind2" => $_POST['insName'],
                ":bind3" => $_POST['insEmail'],
                ":bind4" => $_POST['insSchool'],
            );
            $alltuples = array (
                $tuple
            );
            executeBoundSQL("insert into Participant values (:bind1, :bind2, :bind3, :bind4)", $alltuples);
            OCICommit($db_conn);
        }
        function handleDeleteRequest() {
            global $db_conn;
            executePlainSQL("DELETE FROM Guest WHERE gname='" . $_POST['delName'] . "'");
            OCICommit($db_conn);
        }
        function handleCountRequest() {
            global $db_conn;
            $result = executePlainSQL("SELECT COUNT(ID) as COUNT, school FROM Participant GROUP BY school");
            
            echo "<div class='queryDiv'><br>The number of participants who go to each school:<br>";
            echo "<table>";
            echo "<tr><th>School</th><th>Count</th></tr>";
    
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row["SCHOOL"] . "</td><td>" . $row["COUNT"] . "</td></tr>"; //or just use "echo $row[0]" 
            }
    
                echo "</table></div>";
            }
        function handleSelectRequest() {
            global $db_conn;
            $school_name = $_GET['schoolName'];
            $min_id = $_GET['minID'];
            $result = executePlainSql("SELECT * FROM Participant WHERE school = '$school_name' AND ID >'$min_id'");

            echo "<div class='queryDiv'><br>Retrieved data from table Participant:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>School Name</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["PNAME"] . "</td><td>" . $row["EMAIL"] . "</td><td>" . $row["SCHOOL"] . "</td></tr>"; //or just use "echo $row[0]" 
            }
            echo "</table></div>";
        }
        function handleSelectTableRequest() {
            global $db_conn;
    
            $result = executePlainSql("SELECT * FROM " . $_GET["selectTable"]);
            
            printTableResult($result);
        }
        function handleProjectRequest() {
            global $db_conn;
    
            $result = executePlainSql("SELECT ID, vname, vrole FROM Volunteer");
            
            echo "<div class='queryDiv'><br>Retrieved data from table Volunteer:<br>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Role</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["VNAME"] . "</td><td>" . $row["VROLE"] . "</td></tr>"; //or just use "echo $row[0]" 
            }
            echo "</table></div>";
        }
        function handleDivisionRequest() {
            global $db_conn;
            $result = executePlainSql("SELECT v.vname FROM Volunteer v WHERE NOT EXISTS ((SELECT hname FROM Hackathon) MINUS (SELECT hname FROM HelpsRun hr WHERE v.ID = hr.vID))");
            echo "<div class='queryDiv'><br>The names of the volunteers that have helped run all the hackathons<br>";
            echo "<table>";
            echo "<tr><th>Name</th></tr>";
    
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td></tr>"; 
            }
    
                echo "</table></div>";
        }
        function handleJoinRequest() {
            global $db_conn;
            $result = executePlainSql("SELECT DISTINCT P.pname FROM Participant P, RegistersFor RF WHERE P.ID = RF.pID AND RF.wtitle = '" . $_GET['workshopName'] . "'");
            echo "<div class='queryDiv'><br>Participants who have signed up for workshop '" . $_GET['workshopName'] . "':<br>";
            echo "<table>";
            echo "<tr><th>Name</th></tr></div>";
    
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td></tr>"; 
            }
    
                echo "</table></div>";
        }
        function handleAggregationHavingRequest() {
            global $db_conn;
            $result = executePlainSql("SELECT P.school, COUNT(*) FROM Participant P GROUP BY P.school HAVING COUNT(*) >= 2");
            echo "<div class='queryDiv'><br>The schools that have 2 or more participants attending:<br>";
            echo "<table>";
            echo "<tr><th>Name</th></tr>";
    
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                    echo "<tr><td>" . $row[0] . "</td></tr>"; 
            }
    
                echo "</table></div>";
        }
        function handleNestedAggregationRequest() {
            global $db_conn;
            $result = executePlainSql("SELECT C.cname FROM CompanyRepresentative C GROUP BY C.cname HAVING COUNT(*) > 1 AND EXISTS (SELECT * FROM Sponsors S WHERE S.cname = C.cname)");
            echo "<div class='queryDiv'><br>The companies that have attended hackathons and sent more than one representatives:<br>";
            echo "<table>";
            echo "<tr><th>CompanyName</th></tr>";
            while ($row = OCI_Fetch_Array($result, OCI_BOTH)) {
                echo "<tr><td>" . $row["CNAME"] . "</td></tr>"; //or just use "echo $row[0]" 
            }
            echo "</table></div>";
        }
        // HANDLE ALL POST ROUTES
	// A better coding practice is to have one method that reroutes your requests accordingly. It will make it easier to add/remove functionality.
        function handlePOSTRequest() {
            if (connectToDB()) {
                if (array_key_exists('resetTablesRequest', $_POST)) {
                    handleResetRequest();
                } else if (array_key_exists('updateQueryRequest', $_POST)) {
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
        function handleGETRequest() {
            if (connectToDB()) {
                if (array_key_exists('countTuples', $_GET)) {
                    handleCountRequest();
                } else if (array_key_exists('selectTuples', $_GET)) {
                    handleSelectRequest();
                } else if (array_key_exists('divideTuples',$_GET)) {
                    handleDivisionRequest();
                } else if (array_key_exists('join',$_GET)) {
                    handleJoinRequest();
                } else if (array_key_exists('aggregationHaving',$_GET)) {
                    handleAggregationHavingRequest();
                } else if (array_key_exists('projectTuples',$_GET)) {
                    handleProjectRequest();
                } else if (array_key_exists('nestedAggregation',$_GET)) {
                    handleNestedAggregationRequest();
                } else if (array_key_exists('selectTable',$_GET)) {
                    handleSelectTableRequest();
                }
                disconnectFromDB();
            }
        }
		if (isset($_POST['reset']) || isset($_POST['updateSubmit']) || isset($_POST['insertSubmit']) || isset($_POST['deleteSubmit'])) {
            handlePOSTRequest();
        } else if (isset($_GET['countTupleRequest']) || isset($_GET['displayTupleRequest']) || isset($_GET['joinRequest']) || 
        isset($_GET['projectTupleRequest']) || isset($_GET['aggregationHavingRequest']) || isset($_GET['nestedAggregationRequest']) ||
        isset($_GET['selectTableSubmit'])) {
            handleGETRequest();
        }
		?>
	</body>
</html>