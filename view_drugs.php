<?php
session_start();

$pageTitle = 'ViewDrugs';

if (isset($_POST['viewToday'])) {
    require_once("connect.php");
    echo "<br>";
    $sql = "SELECT * FROM drug";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $_SESSION['data'] = $data;
    }
    $pageTitle = 'ViewDrugs';
    include 'dasgboard.php';
}
?>

<head>
    <style>
        img {
            display: block;
            border: 0;
            width: 200px;
            height: 200px;
        }

        ul.items {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
        }

        ul.items li {
            margin-right: 40px;
        }

        ul {
            padding: 0 0 0 40px;
        }
    </style>
</head>
<div>
    <h2>Drug List</h2>
    <ul class="items">
        <?php
        foreach ($data as $id => $item) {
            echo getItemHtml($id, $item);
        }
        ?>
    </ul>
</div>
<?php

function getItemHtml($id, $item)
{
    $output = "<li><a href='view_drug_detail.php?id=" . $item["DrugID"] . "'><img src='"
        . $item["image"] . "' alt='"
        . $item["TradeName"] . "' />
        <p>View Details</p></a></li>";

    return $output;
}

?>