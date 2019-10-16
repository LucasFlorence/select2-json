<?php
$con = new PDO("mysql:host=localhost;dbname=select2", "root", '',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
$page = $_GET['page'];
$resultCount = 15;
$end = ($page - 1) * $resultCount;       
$start = $end + $resultCount;
$stmt = $con->query("SELECT * FROM cidade WHERE nome LIKE '".$_GET['term']."%' LIMIT {$end},{$start}");
$stmt->execute();
$count = $stmt->rowCount();
$data = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $data[] = ['id' => $row['id'], 'col' => $row['nome'], 'total_count' => $count, 'start' => $start];
}
if(empty($data)){
    $empty[] = ['id' => '', 'col' => '', 'total_count' => '', 'start' => $start]; 
    echo json_encode($empty);
} else {
    echo json_encode($data);
}