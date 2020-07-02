<html>
    <head>
        <title>Table with database</title>
    </head>

    <body>
        <table>
            <tr>
                <th>Employee ID</th>
                <th>Password</th>
                <th>Type</th>
            </tr>

            <?php
                $conn = mysqli_connect("localhost", "admin", "admin", "ssr_database");
                if ($conn-> connect_error) {
                    die("Connection failed:". $conn-> connect_error);
                }

                $sql = "SELECT employee_id, password, type from ssr_accounts";
                $result = $conn-> query($sql);

                if ($result-> num_rows > 0) {
                    while ($row = $result-> fetch_assoc()) {
                        echo "<tr>
                                <td>". $row["employee_id"] ."</td>
                                <td>". $row["password"] ."</td>
                                <td>". $row["type"] ."</td>
                            </tr>";
                    }
                    echo "</table>";
                }
                else {
                    echo "0 result";
                }

                $conn-> close();
            ?>
        </table>
    </body>
</html>