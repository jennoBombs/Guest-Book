<!DOCTYPE html>
<title>Guest Book Posts</title>
<html>
    <body>
    <h3>Jennifer Reisinger CS316</h3>
    <h3>Assignment 8-2</h3>
    <h3>Guest Book Posts</h3><hr />
    
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $DBName = "guestbook";
    $TableName = "visitors";

        
        $DBConnect = new mysqli($servername, $username, $password, $DBName);

        if($DBConnect -> connect_error){
            die("<p>Unable to connect to the database server.</p>" . $DBConnect -> connect_error . "</p>");
        }   
        else{

            $SQLstring = "SELECT * FROM $TableName";
            if($DBConnect -> query($SQLstring)=== 0)
                echo "<p>Guest Book does not exist!" . $DBConnect -> error . "</p>";       
            else{
                $result = $DBConnect ->query($SQLstring);
                echo "<p>The following visitors have signed our guest book:</p>";
                echo "<table width='100%' border='1'>";
                echo "<tr><th>First Name</th><th>Last Name</th></tr>";
                if($result ->num_rows >0){
                    while ($Row = $result ->fetch_assoc()){
                        echo "<tr><td>{$Row['first_name']}</td>";
                        echo "<td>{$Row['last_name']}</td></tr>";
                    } 
                     
                } 
                else {
                    echo "<p>There are no entries in the guest book!</p>";           
                }
                mysqli_free_result($result);
             }
             mysqli_close($DBConnect);
        }

    ?>

    </body>
</html>