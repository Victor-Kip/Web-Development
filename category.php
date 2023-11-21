<?php
session_start();

$pageTitle = "Full Catalog";
$section = null;

// Retrieve the data from the session
if (isset($_SESSION['data'])) {
    $data = $_SESSION['data'];
}

if (isset($_GET['cat'])) {
    $selectedCategory = $_GET['cat'];
    $filteredCatalog = array();

    // Use the $data variable fetched from view_drugs.php
    foreach ($data as $item) {
        if ((strtolower($item['Formula']) == strtolower($selectedCategory))) {
            $filteredCatalog[] = $item;
        }
    }

    if ($selectedCategory == 'tablets') {
        $pageTitle = 'Tablets';
        $section = 'tablets';
    } else if ($selectedCategory == 'powder') {
        $pageTitle = 'Powder';
        $section = 'powder';
    } else if ($selectedCategory == 'paste') {
        $pageTitle = 'Paste';
        $section = 'paste';
    }
}

include 'dasgboard.php';
?>

<div class="section catalog page">
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

    <div class="wrapper">
        <h1><?php echo $pageTitle ?></h1>
        <ul class="items">
            <?php
            foreach ($filteredCatalog as $item) {
                echo "<li><a href='view_drug_detail.php?id=" . $item["DrugID"] . "'><img src='" . $item["image"] . "' alt='" . $item["TradeName"] . "' />
                    <p>View Details</p></a></li>";
            }
            ?>
        </ul>
    </div>
</div>
<?php
