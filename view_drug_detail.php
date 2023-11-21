<?php
require_once('connect.php');

// Check if the 'id' query parameter is set
if (isset($_GET['id'])) {
    $drugId = $_GET['id'];

    // Fetch the drug details based on the drugId
    $query = "SELECT * FROM Drug WHERE DrugId = $drugId";
    $result = mysqli_query($conn, $query);

    // Check if the drug was found
    if ($row = mysqli_fetch_assoc($result)) {
?>
        <section id="drug-details">
            <h2>Drug Details</h2>
            <div class="drug">
                <h3><?php echo $row['TradeName']; ?></h3>
                <img src="<?php echo $row['image']; ?>" alt=" ">
                <p>Price: $<?php echo $row['Cost']; ?></p>
                <p>Formula: <?php echo $row['Formula']; ?></p>
                <p>Manufacturer: <?php echo $row['Company']; ?></p>
            </div>
        </section>
<?php
    } else {
        echo "Drug not found.";
    }
} else {
    echo "Drug ID not provided.";
}
