<?php
    // Report all errors except E_NOTICE
    error_reporting(E_ALL & ~E_NOTICE);
    $dbhost = '127.0.0.1'; #MySQL IP
    $dbuser = 'root'; #帳號
    $dbpass = '123456';
    $dbname = 'paintings'; #資料庫名稱
    #建立連線
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass) or die('Error with MySQL connection'); 
    mysqli_query($conn, "SET NAMES 'utf8'"); #編碼
    mysqli_select_db($conn, $dbname); #選擇要使用的資料庫
    $sql = "SELECT * FROM painting";
    $result = $conn->query($sql);

    $arr_title = array();
    $arr_author = array();
    $arr_year = array();
    $arr_attribute = array();
    $arr_descripition = array();
    $arr_picture = array();
    if ($result->num_rows > 0) {
        // 輸出資料
        while($row = $result->fetch_assoc()) {
            $title=$row["title"];
            $author = $row["author"];
            $year = $row["year"];
            $attribute = $row["attribute"];
            $descripition = $row["descripition"];
            $picture = $row["picture"];

            array_push($arr_title, $title);
            array_push($arr_author, $author);
            array_push($arr_year, $year);
            array_push($arr_attribute, $attribute);
            array_push($arr_descripition, $descripition);
            array_push($arr_picture, $picture);
        }
    }
?>

<style>
    body{background:url(bg_index.jpg); background-size: cover; background-repeat:no-repeat;}
</style>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php
    $after_search = array();
    for($i = 0; $i < count($arr_attribute); $i++){
        if (str_contains($arr_attribute[$i], $_GET['attribute']) == true){
            array_push($after_search, $arr_title[$i]);
        }
    }
?>

<form action = "output.php" method = "get">
    <label style = "color: white; font-size: 20px; font-family:DFKai-sb;">&nbsp&nbsp&nbsp&nbsp&nbsp請選擇作品名稱:&nbsp</label>
    <select name = "title" id = "">
        <?php
            for($i = 0; $i < count($after_search); $i++){
                echo '<option value = "', $after_search[$i], '">', $after_search[$i], '</option>';
            }
        ?>
    </select>
    <label>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <input type = "submit" value = "確定" style = "color: black; font-size: 20px; font-family:DFKai-sb;">
</form>