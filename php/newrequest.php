<?php
    include ("./connections.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["subject"]){
            $description = $_POST["subject"];
        }
        if($_POST["usyd_no"]){
            $usyd_no = $_POST["usyd_no"];
        }
        if($_POST["priority"]){
            $priority = $_POST["priority"];
        }
        if($_POST["applicable"]){
            $applicable = $_POST["applicable"];
        }
        if($_POST["sre_name"]){
            $sre_name = $_POST["sre_name"];
        }
        if($_POST["prior"]){
            $prior = $_POST["prior"];
        }
        if($_POST["action"]){
            $action_after = $_POST["action"];
        }
        if($_POST["ssr_owner"]){
            $ssr_owner = $_POST["ssr_owner"];
        }
        if($_POST["exec_date"]){
            $exec_date = $_POST["exec_date"];
        }
        if($_POST["start_time"]){
            $start_time = $_POST["start_time"];
        }
        if($_POST["end_time"]){
            $end_time = $_POST["end_time"];
        }
        if($_POST["usyd_cat"]){
            $usyd_cat = $_POST["usyd_cat"];
            $dxc_cat = $usyd_cat;
        }
        if($_POST["description"]){
            $perform = $_POST["description"];
        }

        //date & time in a different time zone e.g. Australia/sydney
        //date_default_timezone_set('Australia/Sydney');
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        //status of request
        $status = 'For change creation';
        
        //dxc_contact - PDLs
        if($usyd_cat === "asa"){
            $dxc_contact = "cyber_nss_unisyd@dxc.com";
        }
        if($usyd_cat === "backup"){
            $dxc_contact = "itogdcgocphbursusyd@dxc.com";
        }
        if($usyd_cat === "oracle"){
            $dxc_contact = "redrocksupport@dxc.com";
        }
        if($usyd_cat === "sql"){
            $dxc_contact = "rocksolid.sqlsupport@dxc.com";
        }
        if($usyd_cat === "f5"){
            $dxc_contact = "sim@dxc.com";
        }
        if($usyd_cat === "msv"){
            $dxc_contact = "anz-ph-cloudops-uos@dxc.com";
        }
        if($usyd_cat === "nsx"){
            $dxc_contact = "anz-ph-wintel-iaction@dxc.com";
        }
        if($usyd_cat === "aws"){
            $dxc_contact = "dxc_in_aws_cloudops_pod1@dxc.com";
        }
        if($usyd_cat === "azure"){
            $dxc_contact = "dxc_in_azure_cloudops_pod2@dxc.com";
        }
        if($usyd_cat === "storage"){
            $dxc_contact = "itogdcgocphbursusyd@dxc.com";
        }
        if($usyd_cat === "unix"){
            $dxc_contact = "BSS_ITO_GOC_PH_UNIX_USYD@dxc.com";
        }
        if($usyd_cat === "vmware"){
            $dxc_contact = "anz-ph-wintel-iaction@dxc.com";
        }
        if($usyd_cat === "wintel"){
            $dxc_contact = "anz-ph-wintel-iaction@dxc.com";
        }
        
        
            if($query = mysqli_query($connections, "INSERT INTO ssr_tracker(description, usyd_no, priority, applicable, sre_name, prior, action_after, ssr_owner, exec_date, start_time, end_time, usyd_cat, dxc_cat, perform, date, status, dxc_contact) 
            VALUES ('$description','$usyd_no','$priority','$applicable','$sre_name','$prior','$action_after','$ssr_owner','$exec_date','$start_time','$end_time','$usyd_cat','$dxc_cat','$perform', '$date', '$status', '$dxc_contact')")){



                        //IMPORTANT CHANGE THE FOLDER OF USYD_NO TO DXCSSR
            // Uploads files
        if (!$_POST['myfile']) {

            // Create Folder
            if (!file_exists('../uploads/' . $_POST['usyd_no'])) {
                mkdir('../uploads/' . $_POST['usyd_no'], 0777, true);
            }
           
            $i = 0;
            foreach ($_FILES['myfile']['name'] as $filename){
                $destination = '../uploads/' . $_POST['usyd_no'] . '/' . $filename;
                $extension = pathinfo($filename, PATHINFO_EXTENSION);
                //temp
                $file = $_FILES['myfile']['tmp_name'][$i];
                $size = $_FILES['myfile']['size'][$i];
                //size
                if ($_FILES['myfile']['size'][$i] > 10000000) {
                    echo "File too large!";
                } 
                else {
                //temp to dest
                    if (move_uploaded_file($file, $destination)) {
                        $sql = "INSERT INTO ssr_files (dxc_ssr, name, size, downloads) VALUES ('$usyd_no','$filename', $size, 0)";
                        if (mysqli_query($connections, $sql)) {
                            echo "File uploaded successfully";
                        }
                    } 
                    else {
                        echo "Failed to upload file.";
                    }
                }
                $i++;
            }
        }
        echo "<script>
        alert('New Request has been created!');
        window.location.href='../newrequest.html';
        </script>"; 
    }
    }

?>