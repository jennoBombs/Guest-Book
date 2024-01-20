<!DOCTYPE html>
<title>Sign Guest Book</title>
<html>
    <body>
        <h3>Jennifer Reisinger CS316</h3>
        <h3>Assignment 8-1</h3>
        <h3>sign Guest Book</h3><hr />
    <h2>Enter your name to sign our guest book.</h2>
        <form method="POST" action="ShowGuestBook.php">
            <p>First Name <input type="text" name="first_name"/></p>
            <p>Last Name <input type="text" name="last_name"/></p>
            <p><input type="submit" value="Submit" /></p>
        </form>
    <?php

        $servername = "localhost";
        $username = "root";
        $password = "";

        //ensure visitors enter their first and last name
        if(empty($_POST['first_name']) || empty($_POST['last_name']))
            echo "<p>You must enter your first and last name! Click your browser's Back button to return
                to the Guest Book Form.</p>";
        else{ 
            //connect and create a database using W3 schools technique
            $DBConnect = new mysqli($servername, $username, $password);

            if($DBConnect -> connect_error){
                die("<p>Unable to connect to the database server.</p>" . $DBConnect -> connect_error . "</p>");
            }    
                    
            //create a database named guestbook if it doesn't already exist
            $DBName = "guestbook";
            $DBCreate = "CREATE DATABASE $DBName";
            if($DBConnect -> query($DBCreate)===TRUE){
                echo "<p>You are the first visitor!</p>";
            }
            else{
                     echo "<p>Error creating database: " . $DBConnect->error . "</p>";
            }    

            //create an auto incrementing table named count if it doesn't already exist
            $TableName = "visitors";
            $SQLstring = "SHOW TABLES LIKE $TableName";

            if($DBConnect -> query($SQLstring)==FALSE){
            $DBConnect = new mysqli($servername, $username, $password, $DBName);

                $SQLstring = "CREATE TABLE $TableName(countID INT
                NOT NULL AUTO_INCREMENT PRIMARY KEY, last_name
                VARCHAR(40), first_name VARCHAR(40))";

                if($DBConnect -> query($SQLstring) ===TRUE){
                    echo "Table $TableName created successfully</p>";
                }
                else{
                    echo "<p>Unable to create the table." . $DBConnect -> error . " </p>";
                }
            }

                //add the visitor to the database
                $LastName = stripslashes($_POST['last_name']);
                $FirstName = stripslashes($_POST['first_name']);
                $SQLstring = "INSERT INTO visitors (last_name, first_name)
                VALUES('$LastName', '$FirstName')";
                $DBConnect = new mysqli($servername, $username, $password, $DBName);
                if($DBConnect -> query($SQLstring)===TRUE){
                    echo "<h1>Thank you for signing our guestbook!</h1>";
                }
                else{
                    echo "<p>Unable to execute the query.</p>" . "<br>" . $DBConnect -> error; 
                }
                mysqli_close($DBConnect);
            }
        
    ?>
    </body>
    
    <p><a href="ShowGuestBook.php">Show Guest Book</a></p>
</html>