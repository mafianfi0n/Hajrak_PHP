<?php
$xml = simplexml_load_file("andmed.xml");
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <title>Э-магазин</title>
</head>
<body>
<h2>Заказы э-магазина:</h2>
<table border="1">
    <tr>
        <th>Toodenimi</th>
        <th>Kogus</th>
        <th>Hind</th>
        <th>Tellija Nimi</th>
        <th>Tellija Perenimi</th>
        <th>Tellija Isikukood</th>
        <th>Tellija Address</th>
        <th>Kuupäev</th>
    </tr>
<?php
    foreach ($xml->children() as $arve)
    {
        $tellija = $arve -> tellija;
        echo "<tr>
            <td>".$arve->toodenimi."</td>
            <td>$arve->kogus</td>
            <td>$arve->hind</td>
            <td>$tellija->nimi</td>
            <td>$tellija->perenimi</td>
            <td>$tellija->isikukood</td>
            <td>$tellija->address</td>
            <td>$arve->kuupaev</td>
          </tr>";

    }
    ?>
</table>
<br/>
<h2>Заказы за последние 3 месяца:</h2>
<table border="1">
    <tr>
        <th>Toodenimi</th>
        <th>Kogus</th>
        <th>Hind</th>
        <th>Tellija Nimi</th>
        <th>Tellija Perenimi</th>
        <th>Tellija Isikukood</th>
        <th>Tellija Address</th>
        <th>Kuupäev</th>
    </tr>
    <?php
    foreach ($xml->children() as $arve)
    {
        $tellija = $arve -> tellija;
        $word = "11.2020";
        $word1 = "10.2020";
        $word2 = "09.2020";
        $mystring = $arve->kuupaev;
        if(strpos($mystring, $word) !== false || strpos($mystring, $word1) !== false  || strpos($mystring, $word2) !== false){
            $tellija = $arve->tellija;
            echo "<tr>
            <td>".$arve->toodenimi."</td>
            <td>$arve->kogus</td>
            <td>$arve->hind</td>
            <td>$tellija->nimi</td>
            <td>$tellija->perenimi</td>
            <td>$tellija->isikukood</td>
            <td>$tellija->address</td>
            <td>$arve->kuupaev</td>
            </tr>";

        }

    }
    ?>
</table>
<br/>
<h2>Сортировка заказов за 2020 год по цене:</h2>
<table border="1">
    <tr>
        <th>Toodenimi</th>
        <th>Hind</th>
        <th>Tellija Perenimi</th>
        <th>Kuupäev</th>
    </tr>
    <?php
    foreach ($xml->children() as $arve)
    {
        $hind = array();
        //array_multisort($hind, 1, $arve);
        $word = "2020";
        $mystring = $arve->kuupaev;
        if(strpos($mystring, $word) !== false){
            $tellija = $arve->tellija;
            echo "<tr>
            <td>".$arve->toodenimi."</td>
            <td>$arve->hind</td>
            <td>$tellija->perenimi</td>
            <td>$arve->kuupaev</td>
            </tr>";

        }

    }
    ?>
</table>
<br/>
<h2>Заказы стоящие более 700 долларов, заказанные на улицу Ringi и сделанные в 2020:</h2>
<table border="1">
    <tr>
        <th>Toodenimi</th>
        <th>Kogus</th>
        <th>Hind</th>
        <th>Tellija Nimi</th>
        <th>Tellija Perenimi</th>
        <th>Tellija Isikukood</th>
        <th>Tellija Address</th>
        <th>Kuupäev</th>
    </tr>
    <?php
    foreach ($xml->children() as $arve)
    {
        $tellija = $arve -> tellija;
        $word = "2020";
        $mystring = $arve->kuupaev;
        $word1 = 'Ringi';
        $mystring1 = $arve->tellija->address;
        if(strpos($mystring1, $word1) !== false and strpos($mystring, $word) !== false and $arve->hind > '700'){
            echo "<tr>
            <td>".$arve->toodenimi."</td>
            <td>$arve->kogus</td>
            <td>$arve->hind</td>
            <td>$tellija->nimi</td>
            <td>$tellija->perenimi</td>
            <td>$tellija->isikukood</td>
            <td>$tellija->address</td>
            <td>$arve->kuupaev</td>
            </tr>";

        }

    }
    ?>
</table>
<h2>Поиск по имени заказчика:</h2>
<form action="?" method="post">
    <input type="text" name="search" id="search" value="" placeholder="Tellija nimi">
    <button>Поиск</button>
</form>
<br/>
<table border="1">
    <tr>
        <th>Toodenimi</th>
        <th>Kogus</th>
        <th>Hind</th>
        <th>Tellija Nimi</th>
        <th>Tellija Perenimi</th>
        <th>Tellija Isikukood</th>
        <th>Tellija Address</th>
        <th>Kuupäev</th>
    </tr>
<?php
$query = $_POST['search'];
foreach ($xml->children() as $arve)
{
    $tellija = $arve -> tellija;
    if($tellija->nimi == $query){
        echo "<tr>
            <td>".$arve->toodenimi."</td>
            <td>$arve->kogus</td>
            <td>$arve->hind</td>
            <td>$tellija->nimi</td>
            <td>$tellija->perenimi</td>
            <td>$tellija->isikukood</td>
            <td>$tellija->address</td>
            <td>$arve->kuupaev</td>
            </tr>";

    }

}
?>
</table>
<h1><a href="andmed.json">JSON файл</a></h1>
