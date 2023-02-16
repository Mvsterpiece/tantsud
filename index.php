<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>PHP veebirakenduste tööd</title>
    <link rel="stylesheet" type="text/css" href="Styles/style.css">
</head>
<body>
<?php
include('header.php');
?>
<div class="nav">
    <input type="checkbox" id="nav-check">
    <div class="nav-header">
        <div class="nav-title">
        </div>
    </div>
    <div class="nav-btn">
        <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
        </label>
    </div>

    <div class="nav-links">
        <?php
        echo "<a href='registreerimine.php' target='_self'>Registreerimine</a>";
        echo "<a href='hindamine.php' target='_self'>Hindamine</a>";
        echo "<a href='tulemused.php' target='_self'>Võistluse tulemused</a>";
        ?>
    </div>
</div>
<main>
    <br>
    <?php
    if(isset($_GET['leht'])){
        include('content/'.$_GET['leht']);
    }else{
        echo "Tere tulemast, vajuta navigatsiooni linki peale.";
    }

    ?>
</main>


<?php
include('footer.php');
?>
</body>
</html>