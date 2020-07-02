<?php
    include ("./php/connections.php");
    if (isset($_GET["search"])){
            $check = $_GET["search"];

            $terms = explode(" ", $check);
            $q = "SELECT * FROM ssr_tracker WHERE ";
            $i = 0;

        foreach($terms as $each){
                $i++;
                if($i==1){
                    $q .= "usyd_no LIKE '%$each%' ";
                }
                else{
                    $q .= "OR usyd_no LIKE '%$each%' ";
                }
            }

            $query = mysqli_query($connections, $q);
        }
        else{
            $check = "";
            $query = mysqli_query($connections, "SELECT * FROM ssr_tracker");
        }

        
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Request</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/searchrequest.css">
</head>

<body>

    <div class="full-height">
        <div class="p1-colorstrip">
        </div>
        <div class="p2">
            <div class="logodiv">
                <img class="logo1" src="images/logo1.png" alt="Usyd logo">
            </div>
            <div class="titlediv">
                <h1 class="title">SEARCH REQUEST</h1>
            </div>
        </div>
        <div class="p3-content">
            <div class="form">
                <form>
                    <form method="GET" action="searchrequest.php">
                        <label for="Sdxcssr_no">Search RITM No.</label>
                        <input type="text" id="Sdxcssr_no" name="search" value="<?php echo $check; ?>" required>
                        <input type="submit" value="search">
                    </form>
                    <form method="post" action="searchrequest.php">
                        <input type="submit" name="clear" value="Clear">
                    </form>
                    <div class="container">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Open Request</th>
                                    <th>Date Received</th>
                                    <th>DXC SSR No</th>
                                    <th>Usyd No</th>
                                    <th>SSR Owner</th>
                                    <th>SRE Name</th>
                                </tr>
                            </thead>
                            <tbody>
        
                            <?php
                            while($row = mysqli_fetch_assoc($query)){
                                $db_dxc_ssr = $row["dxc_ssr"];
                                $db_date = $row["date"];
                                $db_usyd_no = $row["usyd_no"];
                                $db_ssr_owner = $row["ssr_owner"];
                                $db_sre_name = $row["sre_name"];
        
                                    echo "<tr>
                                        <td><a href='openrequest.php?dxcssr=$db_usyd_no'>Open</a> &nbsp <a href='updaterequest.php?usyd_no=$db_usyd_no'>Update</td>
                                        <td>$db_date</td>
                                        <td> DXCSSR$db_dxc_ssr</td>
                                        <td>$db_usyd_no</td>
                                        <td>$db_ssr_owner</td>
                                        <td>$db_sre_name</td>
                                        </tr>";
                                }
                            ?>
                            
                            </tbody>
                        </table>
                    </div><br>
                </form>
            </div>
        </div>
    </div>

</body>

<script>
    function goBack() {
        history.back();
    }
</script>

</html>