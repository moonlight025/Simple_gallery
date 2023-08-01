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

<form action = "keyword.php" method = "get">
    <label style = "color: white; font-size: 20px; font-family:DFKai-sb;">請輸入作品關鍵字:&nbsp</label>
    <input type = "text" name = "search" style = "color: black; font-size: 20px; font-family:DFKai-sb;">
    <label>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <input type = "submit" value = "搜尋" style = "color: black; font-size: 20px; font-family:DFKai-sb;">
</form>

<br>

<?php
    $tmp_arr = array();
    for($i = 0; $i < count($arr_year); $i++){
        array_push($tmp_arr, substr($arr_year[$i], 0, 4));
    }

    // bubble sort
    $len = count($tmp_arr); 
    for ($i = 0; $i < $len - 1; $i++) { 
      for ($j = 0; $j < $len - 1; $j++) { 
          if ($tmp_arr[$j] > $tmp_arr[$j + 1]) { 
            // 只是個跳板
            $tmp = $tmp_arr[$j + 1]; 
            $tmp_arr[$j + 1] = $tmp_arr[$j]; 
            $tmp_arr[$j] = $tmp;

            // 主要要改的year
            $tmp2 = $arr_year[$j + 1]; 
            $arr_year[$j + 1] = $arr_year[$j]; 
            $arr_year[$j] = $tmp2;
          } 
      } 
    }     
?>
<form action = "year.php" method = "get">
    <label style = "color: white; font-size: 20px; font-family:DFKai-sb;">請選擇年份:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <select name = "year" id = "">
        <?php
        $tmp = array();
        for($i = 0; $i < count($arr_year); $i++){
            if (!in_array($arr_year[$i], $tmp)){
                echo '<span style = "color: black; font-size: 20px; font-family:DFKai-sb;"> '.'<option value = "', $arr_year[$i], '">', $arr_year[$i], '</option>';
                array_push($tmp, $arr_year[$i]);
            }
        }
        ?>
    </select>
    <label>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <input type = "submit" value = "確定" style = "color: black; font-size: 20px; font-family:DFKai-sb;">
</form>

<form action = "author.php" method = "get">
    <label style = "color: white; font-size: 20px; font-family:DFKai-sb;">請選擇作者:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <select name = "author" id = "">
        <?php
        $tmp = array();
        for($i = 0; $i < count($arr_author); $i++){
            if (!in_array($arr_author[$i], $tmp)){
                echo '<span style = "color: black; font-size: 20px; font-family:DFKai-sb;"> '.'<option value = "', $arr_author[$i], '">', $arr_author[$i], '</option>';
                array_push($tmp, $arr_author[$i]);
            }
        }
        ?>
    </select>
    <label>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <input type = "submit" value = "確定" style = "color: black; font-size: 20px; font-family:DFKai-sb;">
</form>

<form action = "attribute.php" method = "get">
    <label style = "color: white; font-size: 20px; font-family:DFKai-sb;">請選擇屬性:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <select name = "attribute" id = "">
        <?php
        $tmp = array();
        for($i = 0; $i < count($arr_attribute); $i++){
            if (!in_array($arr_attribute[$i], $tmp)){
                echo '<span style = "color: black; font-size: 20px; font-family:DFKai-sb;"> '.'<option value = "', $arr_attribute[$i], '">', $arr_attribute[$i], '</option>';
                array_push($tmp, $arr_attribute[$i]);
            }
        }
        ?>
    </select>
    <label>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <input type = "submit" value = "確定" style = "color: black; font-size: 20px; font-family:DFKai-sb;">
</form>

<form action = "output.php" method = "get">
    <label style = "color: white; font-size: 20px; font-family:DFKai-sb;">請選擇作品名稱:&nbsp&nbsp&nbsp</label>
    <select name = "title" id = "">
        <?php
        for($i = 0; $i < count($arr_title); $i++){
            echo '<span style = "color: black; font-size: 20px; font-family:DFKai-sb;"> '.'<option value = "', $arr_title[$i], '">', $arr_title[$i], '</option>';
        }
        ?>
    </select>
    <label>&nbsp&nbsp&nbsp&nbsp&nbsp</label>
    <input type = "submit" value = "確定" style = "color: black; font-size: 20px; font-family:DFKai-sb;">
</form>