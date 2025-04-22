
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Hamish Allan | Add Room</title>
    <link rel="icon" type="image/x-icon" href="../img/favicon-32x32.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

        <link href="../css/style.css" rel="stylesheet" />

</head>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg" style="padding: 0px;">
            <div class="container-fluid nav-container">
                <a class="navbar-brand" href="#">
                    <img src="../img/logo.png" height="30" alt="">
                </a>
                <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarExample01"
                    aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse " id="navbarExample01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../index.html">Home</a>
                        </li>
                </div>
            </div>
        </nav>
    </header>
    <!-- Navbar -->
<body>
   

<div id="results-container" class="container w-50 py-3 text-center">
    <h1>Room Details</h1>
    <hr>

    <?php
      if (!isset($_POST['room_number']) || !isset($_POST['building']) || !isset($_POST['password']) ) {
          exit('Error: Missing Required Information');
      }
      
      $config = include(__DIR__ . '/../../config.php'); 

      $AUTH_CODE = $config['AUTH_CODE'];


    if ($_POST['password'] != $AUTH_CODE) {
        exit('Invalid Authentication Code');
      }

    $DATABASE_HOST = $config['DATABASE_HOST'];
    $DATABASE_USER = $config['DATABASE_USER'];
    $DATABASE_PASS = $config['DATABASE_PASS'];
    $DATABASE_NAME = $config['DATABASE_NAME'];
     // Create connection
     $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
     // Check connection
     if ( mysqli_connect_errno() ) {
         // If there is an error with the connection, stop the script and display the error.
         exit('Failed to connect to MySQL: ' . mysqli_connect_error());
     }

        //if ( !isset($_POST['username']) ) {
        // Could not get the data that should have been sent.
        //	exit('Please fill in the username field!');
        //}
        if ($stmt = $con->prepare("INSERT INTO room (room_number, building_id, room_capacity, whiteboard_type, computer_type, chair_id, description) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
    
            // Bind parameters
            $stmt->bind_param(
                'iiissis', 
                $_POST['room_number'], 
                $_POST['building'], 
                $_POST['room_capacity'], 
                $_POST['whiteboard_type'], 
                $_POST['computer_type'], 
                $_POST['chair_id'], 
                $_POST['description']
            );
        
            // Execute the statement
            if ($stmt->execute()) {
                echo "Room added successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
        
            // Close the statement
            $stmt->close();
        }
    ?>  
    <br><br>
    <a href="room-finder.php" class="btn btn-primary">Search Rooms</a>
    <a href="add-room-form.php" class="btn btn-success">Add Another Room</a>
</div>
    
<br>


<footer class="text-center fixed-bottom text-white" style="background-color: #2d3035;">
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2025 Copyright:
                <a class="text-white" href="https://hamishallan.uk/">Hamish Allan</a>
            </div>
        </footer>
</html>

