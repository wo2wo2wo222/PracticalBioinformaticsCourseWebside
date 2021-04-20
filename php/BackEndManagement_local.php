<?php

/* Connect to an ODBC database using driver invocation */

//set the localhost parameter 设置本地参数
$dsn = 'mysql:dbname=homework1_test;host=127.0.0.1';
$user = 'root';
$password = '123456';

echo '<meta http-equiv="refresh" content="3; url=..\Management.html">';
echo '3秒后自动返回Home页。<br><br>没有自动返回请点击：<a href="../Management.html">返回Mangement页</a><br>';

//初始化变量名
$FIle_acc = $File_assembly = $Experiment_acc = $Biosample_term = $Biosample_type = $Biosample_organism = $Experiment_target = $Experiment_data_released = $Project = $Download_URL = "";

//get user input 得到用户输入
function getUserInput($FIle_acc, $File_assembly, $Experiment_acc, $Biosample_term, $Biosample_type, $Biosample_organism, $Experiment_target, $Experiment_data_released, $Project, $Download_URL){

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        global $FIle_acc, $File_assembly, $Experiment_acc, $Biosample_term, $Biosample_type, $Biosample_organism, $Experiment_target, $Experiment_data_released, $Project, $Download_URL;
        $FIle_acc = trim($_POST['File_acc']);
        $File_assembly= trim($_POST['File_assembly']);
        $Experiment_acc = trim($_POST['Experiment_acc']);
        $Biosample_term = trim($_POST['Biosample_term']);
        $Biosample_type = trim($_POST['Biosample_type']);
        $Biosample_organism = trim($_POST['Biosample_organism']);
        $Experiment_target = trim($_POST['Experiment_target']);
        $Experiment_data_released = trim($_POST['Experiment_data_released']);
        $Project = trim($_POST['Project']);
        $Download_URL = trim($_POST['Download_URL']);
        echo "php成功获取用户输入<br>";
        return true;
    }
}

//像数据库中插入数据
function getInsertData($dbh,$FIle_acc, $File_assembly, $Experiment_acc, $Biosample_term, $Biosample_type,
                       $Biosample_organism, $Experiment_target, $Experiment_data_released, $Project, $Download_URL){
    $sth = $dbh->prepare('INSERT INTO experiment_meta_final VALUES (?,?,?,?,?,?,?,?,?,?)');
    $sth->execute(array($FIle_acc, $File_assembly, $Experiment_acc, $Biosample_term, $Biosample_type,
        $Biosample_organism, $Experiment_target, $Experiment_data_released, $Project, $Download_URL));
    echo "数据库成功插入数据<br>";
    return true;
}

//向数据库中插入数据
function checkUserInput($FIle_acc, $File_assembly, $Experiment_acc, $Biosample_term, $Biosample_type,
                       $Biosample_organism, $Experiment_target, $Experiment_data_released, $Project, $Download_URL){
    $missItem = '';
    $array =array("FIle_acc"=>"0","File_assembly"=>"0","Experiment_acc"=>"0","Biosample_term"=>"0",
        "Biosample_type"=>"0","Biosample_organism"=>"0","Experiment_target"=>"0","Experiment_data_released"=>"0",
        "Project"=>"0","Download_URL"=>"0");
    if ($FIle_acc != null) $array['FIle_acc'] = 1;
    if ($File_assembly != null) $array['File_assembly'] = 1;
    if ($Experiment_acc != null) $array['Experiment_acc'] = 1;
    if ($Biosample_term != null) $array['Biosample_term'] = 1;
    if ($Biosample_type != null) $array['Biosample_type'] = 1;
    if ($Biosample_organism != null) $array['Biosample_organism'] = 1;
    if ($Experiment_target != null) $array['Experiment_target'] = 1;
    if ($Experiment_data_released != null) $array['Experiment_data_released'] = 1;
    if ($Project != null) $array['Project'] = 1;
    if ($Download_URL != null) $array['Download_URL'] = 1;

    foreach($array as $x=>$x_value){
        if ($x_value == 0){
            if ($missItem == null) $missItem = $missItem .$x;
            else  $missItem = $missItem . "、" . $x;;
        }
    }
    if ($missItem == null) {
        echo "用户输入数据完整，可以进行数据插入。<br>";
        return true;
    }else{
        echo "用户输入 " . $missItem . "项目缺失值，请检查输入！<br>";
        return false;
    }
}

//connect database 连接数据库 获取数据 向数据库插入
try {
    $dbh = new PDO($dsn, $user, $password);
    echo "连接数据库成功！<br/>";

    global $dbh,$FIle_acc, $File_assembly, $Experiment_acc, $Biosample_term, $Biosample_type,
           $Biosample_organism, $Experiment_target, $Experiment_data_released, $Project, $Download_URL;

    getUserInput($dbh,$FIle_acc, $File_assembly, $Experiment_acc, $Biosample_term, $Biosample_type,
        $Biosample_organism, $Experiment_target, $Experiment_data_released, $Project, $Download_URL);

//    echo "1";
    if (checkUserInput($dbh,$FIle_acc, $File_assembly, $Experiment_acc, $Biosample_term, $Biosample_type,
        $Biosample_organism, $Experiment_target, $Experiment_data_released, $Project, $Download_URL)){
//        echo "2";
        getInsertData($dbh,$FIle_acc, $File_assembly, $Experiment_acc, $Biosample_term, $Biosample_type,
            $Biosample_organism, $Experiment_target, $Experiment_data_released, $Project, $Download_URL);
    }

//    echo "3";

} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    echo "连接失败！<br/>";
} catch(Exception $e){
    echo $e->getMessage() . "获取用户输入报错";
}

//关闭数据库连接
$dbh = null;

?>

