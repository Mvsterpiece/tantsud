<?php
require_once("konf.php");
//if (!empty($_POST['eesnimi']) && !empty($_POST['perekonnanimi'])){
    if(isSet($_REQUEST["sisestusnupp"]) &&!empty($_REQUEST['nimi1'] &&!empty($_REQUEST['nimi2']))){
        global $yhendus;
        $kask=$yhendus->prepare(
            "INSERT INTO tantsupaarid(nimi1, nimi2) VALUES (?, ?)");
        $kask->bind_param("ss", $_REQUEST["nimi1"], $_REQUEST["nimi2"]);
        $kask->execute();
        $yhendus->close();
        header("Location: $_SERVER[PHP_SELF]?lisatudeesnimi=$_REQUEST[nimi1],$_REQUEST[nimi2]");
        header("Location: hindamine.php");
        exit();
    }

?>
<!doctype html>
<html>
<head>
    <title>Kasutaja registreerimine</title>
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
<table>
    <tr>
        <th>
            </table>
            <h2>Registreerimine</h2>
            <?php
            if(isSet($_REQUEST["lisatudeesnimi"])){
                echo "Lisati $_REQUEST[lisatudeesnimi]";
            }
            ?>
            <form action="?">
                <dl>
                    <dt>Esimene tantsuja:</dt>
                    <dd><input type="text" name="nimi1" pattern="[^0-9]*"/></dd>
                    <dt>Teine tanstuja:</dt>
                    <dd><input type="text" name="nimi2" pattern="[^0-9]*" /></dd>
                    <dt><input type="submit" name="sisestusnupp" value="sisesta" /></dt>
                </dl>
            </form>
        </th>
        <th>
<!--            <center><img src="jalgratta.jpg" alt="centered image"  width="600"> </center>-->
        </th>
    </tr>

<style>

    h2{
        text-align: center;
    }

    form{
        text-align: center;
    }


    input[type=text], select {
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type=submit] {
        background-color: #000;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }


</style>


</body>
</html>
