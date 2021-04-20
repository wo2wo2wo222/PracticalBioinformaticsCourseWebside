<?php

/* Connect to an ODBC database using driver invocation */

//set the localhost parameter 设置本地参数
$dsn = 'mysql:dbname=homework1_test;host=127.0.0.1';
$user = 'root';
$password = '123456';

//Transcription factors name 搜索转录因子名称
$TFName = '';

//get user input 得到用户输入
function getUserInput(){
    global $userInput;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $userInput = $_POST['userInput'];
        $userInput = trim($userInput);
    }
    return $userInput;
}

//format output 格式化输出查询到的信息
function outputRestul($arr){
    foreach ($arr as $row) {
        echo "<tr>";
        print "<td>" . $row['File_accession'] . "\t </td>";
        print "<td>" . $row['Experiment_accession'] . "\t </td>";
        print "<td>" . $row['Biosample_term_name'] . "\t </td>";
        print "<td>" . $row['Biosample_type'] . "\t </td>";
        print "<td>" . $row['Experiment_target'] . "\t </td>";
        print "<td>" . $row['Experiment_date_released'] . "\t </td>";
        print "<td>" . $row['Project'] . "\t </td>";
        print '<td><a href="' . $row['File_download_URL'] . '"target="blank">download</a></td>\"';
        echo "</tr>";
    }
}

//用户输入为空 展示前10条数据
function getData($conn){
    $sql = 'SELECT * FROM experiment_meta_final limit 10';
    $res = $conn->query($sql);
    outputRestul($res);
}

//用户输入非空 使用prepare 展示所有数据
function getDataPrepareUserInput($dbh, $UserInput){
    $sth = $dbh->prepare('SELECT * FROM experiment_meta_final WHERE Experiment_target = ?');
    $sth->execute(array($UserInput));
    $res = $sth->fetchAll();
    outputRestul($res);
}

//connect database 连接数据库 搜索数据 输出
try {
    $dbh = new PDO($dsn, $user, $password);
    global $TFName;
    $TFName = getUserInput();
    if ($TFName == ''){         //用户输入为空
        getData($dbh);
    }else{                     //用户输入非空
        getDataPrepareUserInput($dbh,$TFName);
    }
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    echo "连接失败！<br/>";
} catch(Exception $e){
    echo $e->getMessage() . "获取用户输入报错";
}

$dbh = null;

?>

