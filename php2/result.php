<?php
    include("connections.php");

    if(empty($_GET["search"])){
        
        echo "Walang laman si Get ... ";
        
    }else{
        $check = $_GET["search"];

        $terms = explode(" ", $check);
        $q = "SELECT * FROM ssr_tracker WHERE ";
        $i = 0;


        echo "<table border='5' width '0%'>";
        echo "<tr>
            <td>Date Received</td>
            <td>DXC SSR No</td>
            <td>Usyd No</td>
            <td>SSR Owner</td>
            <td>SRE Name</td>
        </tr>";


            foreach($terms as $each){
                $i++;
                if($i==1){
                    $q .= "usyd_no LIKE '%$each%' ";
                }else{
                    $q .= "OR usyd_no LIKE '%$each%' ";
                }
            }

            $query = mysqli_query($connections, $q);
            $c_q = mysqli_num_rows($query);

                if($c_q > 0 && $check != ""){

                    while($row = mysqli_fetch_assoc($query)){
                        $date = $row["date"];
                        $dxc_ssr = $row["dxc_ssr"];
                        $usyd_no = $row["usyd_no"];
                        $ssr_owner = $row["ssr_owner"];
                        $sre_name = $row["sre_name"];

                        echo "<tr>
                                <td>$date</td>
                                <td>$dxc_ssr</td>
                                <td>$usyd_no</td>
                                <td>$ssr_owner</td>
                                <td>$sre_name</td>
                            </tr>";
                    }
                }else{
                    echo "No result.";
                }
    }
?>