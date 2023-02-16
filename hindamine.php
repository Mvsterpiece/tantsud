<?php
require_once("konf.php");
if(!empty($_REQUEST["hinne1"])){
    global $yhendus;
    $kask=$yhendus->prepare(
        "UPDATE tantsupaarid SET hinne1=?, hinne2=?, hinne3=? WHERE id=?");
    $kask->bind_param("iiii", $_REQUEST["hinne1"],$_REQUEST["hinne2"], $_REQUEST["hinne3"],$_REQUEST["id"]);
    $kask->execute();
}
$kask=$yhendus->prepare("SELECT id, nimi1, nimi2 
     FROM tantsupaarid WHERE hinne1=0 and hinne2=0 and hinne3=0");
$kask->bind_result($id, $nimi1, $nimi2);
$kask->execute();
?>
<!doctype html>
<html>
<head>
    <title>Hindamine</title>
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
<h1>Hindamine</h1>
<table>
    <tr>
        <th>Esimese paarinimi</th>
        <th>Teise paarinimi</th>
        <th>Esinemistehnika</th>
        <th>Liikumise musikaalsus</th>
        <th>Partnerlus</th>
        <th>Tulemusi sisestamine</th>
    </tr>
    <?php
    while($kask->fetch()){
        echo "
		    <tr>
			  <td>$nimi1</td>
			  <td>$nimi2</td>
			  <form action=''>
			         <input type='hidden' name='id' value='$id' />
			         <td>
			         <select name='hinne1'>
                      <option value=1>1 punkt</option>
                      <option value=2>2 punkti</option>
                      <option value=3>3 punkti</option>
                      <option value=4>4 punkti</option>
                      <option value=5>5 punkti</option>
                    </select>
                    </td>
                    <td>
                    <select name='hinne2'>
                      <option value=1>1 punkt</option>
                      <option value=2>2 punkti</option>
                      <option value=3>3 punkti</option>
                      <option value=4>4 punkti</option>
                      <option value=5>5 punkti</option>
                    </select>
                    </td>
                    <td>
                    <select name='hinne3'>
                      <option value=1>1 punkt</option>
                      <option value=2>2 punkti</option>
                      <option value=3>3 punkti</option>
                      <option value=4>4 punkti</option>
                      <option value=5>5 punkti</option>
                    </select>
                    </td>
                    <td>
                    <input type='submit' value='Sisesta tulemus' />
                    </td>
			      </form>
			</tr>
		  ";
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
