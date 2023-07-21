<?php
session_start();
if (isset($_SESSION['AdminSSN']) && !empty($_SESSION['AdminSSN'])) {
    $loggedInUser = $_SESSION['AdminSSN'];
} else {
    header("location: viewrecords.php");
}


require_once 'connect.php';

$query1 = "SELECT * FROM Patients";
$result1 = mysqli_query($conn, $query1);

$query2 = "SELECT * FROM Doctor";
$result2 = mysqli_query($conn, $query2);

$query3 = "SELECT * FROM Pharmacist";
$result3 = mysqli_query($conn, $query3);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM Patients WHERE PatientSSN=$id";
    if (mysqli_query($conn, $sql)) {
        header("location: viewrecords.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (isset($_GET['delete2'])) {
    $id = $_GET['delete2'];
    $sql = "DELETE FROM Doctor WHERE DoctorSSN=$id";
    if (mysqli_query($conn, $sql)) {
        header("location: viewrecords.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

if (isset($_GET['delete3'])) {
    $id = $_GET['delete3'];
    $sql = "DELETE FROM Pharmacist WHERE PharmaSSN=$id";
    if (mysqli_query($conn, $sql)) {
        header("location: viewrecords.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Patient Records</title>
    <style>
        .container {
            margin-top: 50px;
            padding: 20px;
        }

        .user-box {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <a href="adminlogout.php">Logout</a>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-center">Welcome user <?php echo $loggedInUser; ?></h3>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Patient Records</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr class="bg-dark text-white">
                                <td> PatientSSN </td>
                                <td> FirstName </td>
                                <td> SecondName </td>
                                <td> Address</td>
                                <td> Age</td>
                                <td> Height</td>
                                <td> Weight</td>
                                <td> Allergies</td>
                                <td> PrimaryDoctor</td>
                                <td> Actions</td>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($result1)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['PatientSSN']; ?></td>
                                    <td><?php echo $row['FirstName']; ?></td>
                                    <td><?php echo $row['SecondName']; ?></td>
                                    <td><?php echo $row['Address']; ?></td>
                                    <td><?php echo $row['Age']; ?></td>
                                    <td><?php echo $row['Height']; ?></td>
                                    <td><?php echo $row['Weight']; ?></td>
                                    <td><?php echo $row['Allergies']; ?></td>
                                    <td><?php echo $row['PrimaryDoctor']; ?></td>
                                    <td>
                                        <a href="viewrecords.php?delete=<?php echo $row['PatientSSN']; ?>" class="btn btn-danger" name="Delete">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Doctor Records</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr class="bg-dark text-white">
                                <td> DoctorSSN </td>
                                <td> FirstName </td>
                                <td> SecondName </td>
                                <td> Speciality</td>
                                <td> YearsPracticed</td>
                                <td> Actions</td>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($result2)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['DoctorSSN']; ?></td>
                                    <td><?php echo $row['FirstName']; ?></td>
                                    <td><?php echo $row['SecondName']; ?></td>
                                    <td><?php echo $row['Specialty']; ?></td>
                                    <td><?php echo $row['YearsPractised']; ?></td>
                                    <td>
                                        <a href="viewrecords.php?delete2=<?php echo $row['DoctorSSN']; ?>" class="btn btn-danger" name="Delete">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Pharmacist Records</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr class="bg-dark text-white">
                                <td> PharmaSSN </td>
                                <td> FirstName </td>
                                <td> SecondName </td>
                                <td> Age</td>
                                <td> Pharmacy</td>
                                <td> YearsPracticed</td>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($result3)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['PharmaSSN']; ?></td>
                                    <td><?php echo $row['FirstName']; ?></td>
                                    <td><?php echo $row['SecondName']; ?></td>
                                    <td><?php echo $row['Age']; ?></td>
                                    <td><?php echo $row['Pharmacy']; ?></td>
                                    <td><?php echo $row['YearsPractised']; ?></td>
                                    <td>
                                        <a href="viewrecords.php?delete3=<?php echo $row['PharmaSSN']; ?>" class="btn btn-danger" name="Delete">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>
</body>

</html>