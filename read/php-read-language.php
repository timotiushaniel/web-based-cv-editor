<?php
require "../form/session_time.php";
// Check existence of id parameter before processing further
if(isset($_GET["lg_id"]) && !empty(trim($_GET["lg_id"]))){
    // Include config file
    require_once "../dbh.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM language WHERE lg_id = ?";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $lg_id);
        
        // Set parameters
        $lg_id = trim($_GET["lg_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $language = $row["language"];
                $language_test = $row["language_test"];
                $language_proficient = $row["Language_proficient"];
                $score = $row["score"];
                $tgl_raw = $row["date"];
                $tanggal = date("F o", strtotime($tgl_raw));
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: ../error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again.";
        }
    }
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: ../error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Language Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Language Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Language</label>
                        <p class="form-control-static"><?php echo $row["language"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Language test</label>
                        <p class="form-control-static"><?php echo $row["language_test"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Language proficient</label>
                        <p class="form-control-static"><?php echo $row["Language_proficient"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Skill</label>
                        <?php 
                            require_once "../dbh.php";
                            $language_skill_sql_read = "SELECT * FROM language_skill WHERE lg_id = $lg_id";
                            if($language_skill_result = mysqli_query($conn, $language_skill_sql_read)){
                                if(mysqli_num_rows($language_skill_result) > 0){
                                        while($language_skill_row = mysqli_fetch_array($language_skill_result)){
                                            echo "<li>" . $language_skill_row['skill'] . "</li>";
                                        }
                                    // Free result set
                                    mysqli_free_result($language_skill_result);
                                } else{
                                    echo "<p class='lead'><em>No Skill records were found.</em></p>";
                                }
                            } else{
                                echo "ERROR: Could not able to execute $language_skill_sql_read. " . mysqli_error($conn);
                            }
                            // Close statement
                            mysqli_stmt_close($stmt);
                            
                            // Close connection
                            mysqli_close($conn);
                        ?>
                    </div>
                    <div class="form-group">
                        <label>Score</label>
                        <p class="form-control-static"><?php echo $row["score"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <p class="form-control-static"><?php echo $tanggal; ?></p>
                    </div>
                    <p><a href="../form/language.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>