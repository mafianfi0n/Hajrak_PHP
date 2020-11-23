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
<h1>Система управления складами</h1>
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
    <?php
    if (isset($_POST['search'])) {
        echo '<tr>';
        echo    '<th>Toodenimi</th>';
        echo    '<th>Kogus</th>';
        echo    '<th>Hind</th>';
        echo   '<th>Tellija Nimi</th>';
        echo    '<th>Tellija Perenimi</th>';
        echo    '<th>Tellija Isikukood</th>';
        echo    '<th>Tellija Address</th>';
        echo    '<th>Kuupäev</th>';
        echo '</tr>';
        $query = $_POST['search'];
        echo '<tr>';
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
    }
    ?>
</table>
<br/>
<div>
    <h2 id="gg">Добавление данных:</h2>
    <form action="index.php">
        Tellija nimi: <input id="gg" type="text" name="nimi"><br/><br/>
        Tellija address: <input id="gg" type="text" name="address"><br/><br/>
        Tellija isikukood: <input id="gg" type="text" name="isikukood"><br/><br/>
        <input name="json" id="button" type="submit" value="Sisesta">
    </form>
</div>
<br>

<?php
if (isset($_POST['json'])){
    if (empty($_POST['nimi']) || empty($_POST['address']) || empty($_POST['isikukood'])){
        echo "<h4>Обязательно заполните все поля!</h4>";
    }
        else {
            unset($_POST['submit']);
            $file = "andmed.json";
            $data = json_decode(file_get_contents($file), TRUE);
            $_POSTED['Id'] = end($data['andmed'])['Id'] + 1;
            $_POSTED["nimi"] = $_POST["nimi"];
            $_POSTED["address"] = $_POST["address"];
            $_POSTED["isikukood"] = $_POST["isikukood"];
            array_push($data['andmed'], $_POSTED);
            file_put_contents($file, json_encode($data, JSON_UNESCAPED_UNICODE));

        }
}
?>
<h3><a target="_blank" href="andmed.json">JSON файл</a></h3>
<h3><a href="DocumentationIvanov.docx">Документация</a></h3>
