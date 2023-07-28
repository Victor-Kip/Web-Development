<a href="viewrecords.php">Exit</a>
<?php
require_once 'connect.php';

$query1 = "SELECT * FROM contract";
$result1 = mysqli_query($conn, $query1);



if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM contract WHERE contractId=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
            window.onload = function() {
                alert('The contract has been successfully terminated');
                window.location.href = 'contract.php';
            };
        </script>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}


?>




<!DOCTYPE html>
<html>

<head>
    <title>Contract Awards</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="contract.css">

</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="text-center">The following contracts have been awarded</h3>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Contracts</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr class="bg-dark text-white">
                                <td> Contratc Id </td>
                                <td> Supervisor </td>
                                <td> Start Date </td>
                                <td> End Date</td>
                                <td> Duration (days)</td>
                                <td> Company </td>
                                <td> Pharmacy</td>
                                <td> Drug Name</td>

                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($result1)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['contractId']; ?></td>
                                    <td><?php echo $row['supervisor']; ?></td>
                                    <td><?php echo $row['start_date']; ?></td>
                                    <td><?php echo $row['end_date']; ?></td>
                                    <td><?php echo $row['duration']; ?></td>
                                    <td><?php echo $row['company']; ?></td>
                                    <td><?php echo $row['pharmacy']; ?></td>
                                    <td><?php echo $row['drug_name']; ?></td>

                                    <td>
                                        <a href="contract.php?delete=<?php echo $row['contractId']; ?>" class="btn btn-danger" name="Delete">Terminate</a>
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
    <div>
        <form action="contract.php" method="post">
            <button name="newcon" class="newcontbtn">Add a new Contract</button>
        </form>
    </div>

    <?php
    if (isset($_POST['newcon'])) {



        echo '<div class="contain">';
        echo '    <div class="title">Contract Management</div>';
        echo '    <div class="content">';
        echo '        <form action="contract.php" method="post">';
        echo '            <div class="user-details">';
        echo '                <div class="input-box">';
        echo '                    <span class="details">Supervisor</span>';
        echo '                    <input type="text" name="supervisor" placeholder="The contractor name" required>';
        echo '                </div>';
        echo '                <div class="input-box">';
        echo '                    <span class="details">Start Date</span>';
        echo '                    <input type="date" name="start_date" placeholder="The starting date of the contract" required>';
        echo '                </div>';
        echo '                <div class="input-box">';
        echo '                    <span class="details">End Date</span>';
        echo '                    <input type="date" name="end_date" placeholder="The end date of the contract" required>';
        echo '                </div>';
        echo '                <div class="input-box">';
        echo '                    <span class="details">Company</span>';
        echo '                    <input type="text" name="company" placeholder="The company to supply" required>';
        echo '                </div>';
        echo '                <div class="input-box">';
        echo '                    <span class="details">Pharmacy</span>';
        echo '                    <input type="text" name="pharmacy" placeholder="The pharmacy being supplied" required>';
        echo '                </div>';
        echo '                <div class="input-box">';
        echo '                    <span class="details">Drug Name</span>';
        echo '                    <input type="text" name="drug_name" placeholder="The drug being supplied" required>';
        echo '                </div>';
        echo '            </div>';
        echo '            <div class="button">';
        echo '                      <input type="submit" name="create" value="Add Contract">';
        echo '            </div>';
        echo '            </form>';
        echo '    </div>';
        echo '</div>';
    }

    if (isset($_POST['create'])) {


        $supervisor = $_POST['supervisor'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $diff = date_diff(date_create($start_date), date_create($end_date));
        $duration = $diff->days;
        $company = $_POST['company'];
        $pharmacy = $_POST['pharmacy'];
        $drug_Name = $_POST['drug_name'];

        $query = "INSERT INTO contract (supervisor, start_date, end_date, duration, company, pharmacy, drug_name) VALUES ('$supervisor', '$start_date', '$end_date', '$duration', '$company', '$pharmacy', '$drug_Name')";



        if (mysqli_query($conn, $query)) {
            echo "<script>
            window.onload = function() {
                alert('Contract created');
                window.location.href = 'contract.php';
            };
        </script>";
        } else {
            echo "<script>
            window.onload = function() {
                alert('Error in creating new contract');
                window.location.href = 'contract.php';
            };
        </script>";
        }
    }


    $conn->close();
    ?>



</body>

</html>