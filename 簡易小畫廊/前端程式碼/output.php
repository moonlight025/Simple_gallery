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
    body{background:url(bg_output.jpg), url(bg_output2.jpg); background-size: 483px 644px, 939px 644px; background-position:right center, left center; background-repeat: no-repeat, no-repeat;}
</style>

<?php
    for($i = 0; $i < count($arr_title); $i++){
        if (strlen($arr_descripition[$i]) == 0){
            $arr_descripition[$i] = "本網站無此作品之描述。";
        }

        if ($_GET['title'] == $arr_title[$i]){
            echo '<span style = "color: black; font-size: 18px; font-family:DFKai-sb; position:absolute; top:65px; left:110px; display: inline-block; max-width: 650px; word-wrap:break-word;"> '."作品名稱:", "<br>", $arr_title[$i], "<br>";

            echo "<br>";

            echo '<span style = "color: black; font-size: 18px; font-family:DFKai-sb;"> '."作者:", "<br>", $arr_author[$i], "<br>";

            echo "<br>";

            echo '<span style = "color: black; font-size: 18px; font-family:DFKai-sb;"> '."年份:", "<br>", $arr_year[$i], "<br>";

            echo "<br>";

            echo '<span style = "color: black; font-size: 18px; font-family:DFKai-sb;"> '."屬性:", "<br>", $arr_attribute[$i], "<br>";

            echo "<br>";

            echo '<span style = "color: black; font-size: 18px; font-family:DFKai-sb;"> '."描述:", "<br>", $arr_descripition[$i], "<br>";

            break;
        }
    }
?>

<?php
    for($i = 0; $i < count($arr_title); $i++){
        if ($_GET['title'] == $arr_title[$i]){
            $change_type = str_replace("jpg", "webp", $arr_picture[$i]);
            $url = $change_type;
            $pic = file_get_contents($url); //讀取圖片
            $type = getimagesize($url); //取得圖片資訊
            $file_content = base64_encode($pic); //base64編碼
            switch($type[2]){ //判斷圖片的類型
                case 1:
                    $img_type = "gif";
                    break;
                case 2:
                    $img_type = "jpg";
                    break;
                case 3:
                    $img_type = "png";
                    break;
                case 18:
                    $img_type = "webp";
                    break;
            }
            $img = 'data:image/'.$img_type.';base64,'.$file_content; //data url 格式
            echo '<span style = "position:absolute; top:63px; left:991.5px;">'.'<img src = "'.$img.'"width="160"; height="211.5"; />';//顯示在網頁上

            break;
        }
    }
?>

<input type = "button" onclick = 'javascript:location.href = "http://localhost/database/index.php"' value = "首頁" style = "color: black; font-size: 18px; font-family:DFKai-sb; position:absolute; top:270px; left:55px;"></input>