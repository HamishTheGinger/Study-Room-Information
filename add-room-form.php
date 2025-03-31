<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="blank">
    <script src="https://kit.fontawesome.com/1810ce7433.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/x-icon" href="img/favicon-32x32.png">

    <title>Hamish Allan | Add Room</title>


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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="css/style.css" rel="stylesheet" />


</head>

<body>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>

    <script>// Initialization for ES Users
        import { Collapse, Ripple, initMDB } from "mdb-ui-kit";

        initMDB({ Collapse, Ripple });</script>

    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg" style="padding: 0px;">
            <div class="container-fluid nav-container">
                <a class="navbar-brand" href="#">
                    <img src="img/logo.png" height="30" alt="">
                </a>
                <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarExample01"
                    aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse " id="navbarExample01">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="projects.html">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Navbar -->


    <br>
    <div class="shadow-lg bg-body contact container rounded-4" data-bs-theme="dark">
        <h1>Room Search</h1>
        <form required action="add-room.php" class="align-items-center" method="post">
            <div class="mb-4 w-100">
                <label class="form-label text-light" for="building">Select Building</label>
                <select class="form-select" name="building" id="building">
                    <option value="none" selected disabled>Select Building</option>
                    <?php
                        $DATABASE_HOST = 'localhost';
                        $DATABASE_USER = 'root';
                        $DATABASE_PASS = '';
                        $DATABASE_NAME = 'uofg_room_information';

                        // Create connection
                        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

                        if (mysqli_connect_errno()) {
                            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
                        }

                        if ($stmt = $con->prepare("SELECT building_id, building_name FROM building ORDER BY building_name")) {
                            $stmt->execute();
                            $result = $stmt->get_result();
                            foreach ($result as $row) {
                                echo "<option value='" . $row['building_id'] . "'>" . $row['building_name'] . "</option>";
                            }
                            $stmt->close();
                        }
                    ?>
                </select>
            </div>

            <div class="mb-4 w-100">
                    <label class="form-label text-light" for="room_number">Room Number</label>
                    <input type="number" id="room_number" name="room_number" class="form-control" />
            </div>
            <div class="mb-4 w-100">
                    <label class="form-label text-light" for="room_capacity">Room Capacity</label>
                    <input type="number" min=1 id="room_capacity" name="room_capacity" class="form-control" />
            </div>
            <div class="mb-4 w-100">
                    <label class="form-label text-light" for="whiteboard_type">Whiteboard Type</label>
                    <input type="text" id="whiteboard_type" name="whiteboard_type" class="form-control" />
            </div>
            <div class="mb-4 w-100">
                    <label class="form-label text-light" for="computer_type">Computer Type</label>
                    <input type="text" id="computer_type" name="computer_type" class="form-control" />
            </div>
            <div class="mb-4 w-100">
                <label class="form-label text-light" for="chair_id">Select Chair</label>
                <select class="form-select" name="chair_id" id="chair_id">
                    <option value="none" selected disabled>Select Chair</option>
                    <?php
                        $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

                        if (mysqli_connect_errno()) {
                            exit('Failed to connect to MySQL: ' . mysqli_connect_error());
                        }

                        if ($stmt = $con->prepare("SELECT chair_id, chair_name FROM chair ORDER BY chair_name")) {
                            $stmt->execute();
                            $result = $stmt->get_result();
                            foreach ($result as $row) {
                                echo "<option value='" . $row['chair_id'] . "'>" . $row['chair_name'] . "</option>";
                            }
                            $stmt->close();
                        }
                    ?>
                </select>
            </div>
            <div data-mdb-input-init class="mb-4 w-100">
                    <label class="form-label text-light" for="description">Additional Info</label>
                    <textarea class="form-control" name="description" id="description" rows="2"></textarea>
            </div>
            <div class="mb-4 w-100">
                    <label class="form-label text-light" for="password">Authentication Code</label>
                    <input type="password" name="password" id="password" class="form-control" />
            </div>
            
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4">Add Room</button>
        </form>
    </div>

    <footer class="text-center fixed-bottom text-white" style="background-color: #2d3035;">
        <!-- Grid container -->
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2025 Copyright:
            <a class="text-white" href="https://hamishallan.uk/">Hamish Allan</a>
        </div>
        <!-- Copyright -->
    </footer>

    </div>
</body>