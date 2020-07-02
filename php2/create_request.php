<?php
    include ("connections.php");
    $usyd_no = $ssr_owner = $sre_name = $exec_date = $prior = $priority = $usyd_cat = $description = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["usyd_no"]){
            $usyd_no = $_POST["usyd_no"];
        }

        if($_POST["ssr_owner"]){
            $ssr_owner = $_POST["ssr_owner"];
        }

        if($_POST["sre_name"]){
            $sre_name = $_POST["sre_name"];
        }

        if($_POST["exec_date"]){
            $exec_date = $_POST["exec_date"];
        }

        if($_POST["priority"]){
            $priority = $_POST["priority"];
        }

        if($_POST["usyd_cat"]){
            $usyd_cat = $_POST["usyd_cat"];
        }

        if($_POST["description"]){
            $description = $_POST["description"];
        }


        if($usyd_no && $ssr_owner && $sre_name && $exec_date && $priority && $usyd_cat && $description){
            $query = mysqli_query($connections, "INSERT INTO ssr_tracker(usyd_no, ssr_owner, sre_name, exec_date, priority, usyd_cat, description) 
            VALUES ('$usyd_no','$ssr_owner','$sre_name','$exec_date','$priority','$usyd_cat','$description')");
        }

        
    }
?>

<html>
<form method="POST" action="<?php htmlspecialchars("PHP_SELF"); ?>">
    <h1>SSR Request Details</h1><br>

    <label for="subject">Subject:</label>
    <input type="text" id="subject" name="subject"><br>
    
    <label for="usyd_no">Usyd Service request reference:</label>
    <input type="text" id="usyd_no" name="usyd_no" value="usyd_no" required><br>
    
    <label for="priority">Usyd Priority:</label>
    <select id="priority" name="priority">
        <option value="p1">P1 - Critical</option>
        <option value="p2">P2 - High</option>
        <option value="p3">P3 - Moderate</option>
        <option selected="p4" value="p4">P4 - Low</option>
    </select><br><br>

    
    <b><label for="sequencing">Usyd Sequencing:</label></b><br>
    
    <label for="applicable">Applicable (yes/no):</label>
    <select id="applicable" name="applicable">
        <option value="yes">Yes</option>
        <option value="no">No</option>
    </select><br>
    
    <label for="sre_name">Usyd Person responsible to coordinate:</label>
    <input type="text" id="sre_name" name="sre_name" required><br>
    
    <label for="prior">Actions to be done prior to this SSR:</label>
    <input type="text" id="prior" name="prior"><br>
    
    <label for="action">Actions to be done after this SSR:</label>
    <input type="text" id="action" name="action"><br><br>

    <label for="ssr_owner">Service Request Owner:</label>
    <input type="text" id="ssr_owner" name="ssr_owner" required><br><br>

    <b><label for="exe">Execution Window:</label></b><br>
    
    <label for="exec_date">Date:</label>
    <input type="date" id="exec_date" name="exec_date" required><br>
    
    <label for="start_time">Start time (24hr Time):</label>
    <input type="time" id="start_time" name="start_time" required><br>
    
    <label for="end_time">End time (24hr Time):</label>
    <input type="time" id="end_time" name="end_time" required><br>

    <label for="usyd_cat">Service Request Category: (Select the applicable category)</label>
    <select id="usyd_cat" name="usyd_cat">
        <option value="asa">ASA Firewall</option>
        <option value="backup">Backup</option>
        <option value="oracle">Database Oracle</option>
        <option value="sql">Database SQL</option>
        <option value="f5">F5</option>
        <option value="msv">MSV CloudOps</option>
        <option value="nsx">NSX Firewall</option>
        <option value="aws">Public Aws CloudOps</option>
        <option value="azure">Public Azure CloudOps</option>
        <option value="storage">Storage Team</option>
        <option value="unix">Unix/Linux</option>
        <option value="vmware">VMWare</option>
        <option value="wintel">Wintel</option>
    </select><br><br>


    <b><label for="perform">Please perform the following steps on</label></b><br>
    
    <b><label for="description">Description:</label></b><br>
    <textarea id="description" name="description" rows="30" cols="100"></textarea required><br><br>

    <button type="submit" id="create_request" onclick="goBack()">Create Request</button><br>
    <button type="button" id="back" onclick="goBack()">Back</button>

</form>

<script>
    function goBack() {
        history.back();
    }
</script>

</html>