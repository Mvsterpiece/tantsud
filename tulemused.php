<?php
require_once("konf.php");

if (isset($_REQUEST["kustutusid"])) {
    global $yhendus;
    $kask = $yhendus->prepare("DELETE FROM tantsupaarid WHERE id=?");
    $kask->bind_param("s", $_REQUEST['kustutusid']);
    $kask->execute();

    header("Location: $_SERVER[PHP_SELF]");
}

if(!empty($_REQUEST["vormistamine_id"])){
    global $yhendus;
    $kask=$yhendus->prepare(
        "UPDATE tantsupaarid SET luba=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["vormistamine_id"]);
    $kask->execute();
}
$kask=$yhendus->prepare(
    "SELECT id, CONCAT(nimi1,', ', nimi2) AS nimed, hinne1, hinne2, hinne3 ,(hinne1 + hinne2 + hinne3)/3 AS kesk FROM tantsupaarid GROUP by nimi1");
$kask->bind_result($id,$nimed, $hinne1,
    $hinne2, $hinne3, $kesk);
$kask->execute();

//WHERE hinne1!=-1 and hinne2!=-1 and hinne3!=-1;

//SELECT AVG(hinne1,hinne2,hinne3) as Keskminne_hinne FROM tantsupaarid;


//SELECT (hinne1 + hinne2 + hinne3)/3 AS KeskmineHinne FROM tantsupaarid GROUP by nimi1;






function asenda($nr){
    if($nr==-1){return ".";} //tegemata
    if($nr== 1){return "korras";}
    if($nr== 2){return "ebaõnnestunud";}
    return "Tundmatu number";
}



?>
<!doctype html>
<html>
<head>
    <title>Võistluse tulemused</title>
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
<h1>Lõpetamine</h1>
<table>
    <tr>
        <th>Kustutamine</th>
        <th>Paari nimed</th>
        <th>Esinemistehnika</th>
        <th>Liikumise musikaalsus</th>
        <th>Partnerlus</th>
        <th>Keskmine hinne</th>
    </tr>
    <?php
    while($kask->fetch()){
        $asendatud_hinne1=asenda($hinne1);
        $asendatud_hinne2=asenda($hinne2);
        $asendatud_hinne3=asenda($hinne3);
        $asendatud_hinne3=asenda($kesk);
        echo "<tr>";
        ?>
        <td><a style="color: black" href="?kustutusid=<?=$id ?>"
               onclick="return confirm('Kas ikka soovid kustutada?')">Kustutada</a>
        </td>
        <?php
        echo "<td>".$nimed."</td>";
        echo   "<td>".$hinne1."</td>";
        echo   "<td>".$hinne2."</td>";
        echo	"<td>".$hinne3."</td>";
        echo	"<td>".round($kesk,1)."</td>";
        echo	 "</tr>";
    }
    ?>
</table>
<style>

    table {
        width: 100%;
        border-collapse: collapse;
    }
    /* Zebra striping */
    th {
        background: #333;
        color: white;
        font-weight: bold;
    }
    td, th {
        padding: 6px;
        border: 1px solid #ccc;
        text-align: left;
    }
</style>

</body>
</html>