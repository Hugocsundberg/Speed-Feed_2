<?php
require '../functions.php';

//Input data 
$data = json_decode(file_get_contents('php://input'));

$postId = intval($data->postId);
$body = $data->body;
$commentId = intval($data->commentId);
$time = time();
$user_id = intval($_SESSION['user']['id']);

//Connect to db
$database_host = 'ec2-34-251-118-151.eu-west-1.compute.amazonaws.com';
$database_name = 'd2m7cahbqat10u';
$database_user = 'ibmysphorhuxnp';
$database_port = '5432';
$database_password = '17d71d5877ce8f94d8d912acdc727e8dd69d290548b93a22d0bc8c0b9b07489f';

$db = new PDO("pgsql:host=$database_host;port=$database_port;dbname=$database_name;user=$database_user;password=$database_password");

$stmt = $db->prepare("UPDATE \"Comments\" SET \"user_id\" = :user_id, \"post_id\" = :post_id, \"body\" = :body, \"date\" = :date WHERE \"id\" = :id");
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':post_id', $postId);
$stmt->bindParam(':body', $body);
$stmt->bindParam(':date', $time);
$stmt->bindParam(':id', $commentId);
$stmt->execute();
