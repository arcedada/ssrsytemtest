<?php
    include ("connections.php");

    $view_query = mysqli_query($connections, "SELECT * FROM ssr_tracker");

    echo "<table border='5' width '0%'>";
    echo "<tr>
            <td>Date Received</td>
            <td>DXC SSR No</td>
            <td>Usyd No</td>
            <td>SSR Owner</td>
            <td>SRE Name</td>
        </tr>";

    while($row = mysqli_fetch_assoc($view_query)){
        $db_dxc_ssr = $row["dxc_ssr"];
        $db_date = $row["date"];
        $db_usyd_no = $row["usyd_no"];
        $db_ssr_owner = $row["ssr_owner"];
        $db_sre_name = $row["sre_name"];

        echo "<tr>
                <td>$db_date</td>
                <td>$db_dxc_ssr</td>
                <td>$db_usyd_no</td>
                <td>$db_ssr_owner</td>
                <td>$db_sre_name</td>
            </tr>";
    }
    echo "</table>";
?>