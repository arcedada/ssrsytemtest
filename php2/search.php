<?php


    $search = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["search"]){
            $search = $_POST["search"];
        }
    }

    if($search){
        echo "<script>window.location.href='result.php?search=$search';</script>";
    }

?>

<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

    <input type="text" name="search" value="<?php echo $search; ?>" required><br>
    <input type="submit" value="search">

</form>