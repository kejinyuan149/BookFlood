<?php
$host='172.18.33.223:3306';
$user_name='root';
$password='1234';
$conn=mysql_connect($host,$user_name,$password);
mysql_query("CREATE DATABASE user_information",$conn);
mysql_select_db("user_information",$conn);
mysql_query("SET CHARACTER SET utf8");
mysql_query("CREATE TABLE user(name varchar(30),password varchar(30),PRIMARY KEY  (`name`))",$conn);
$user_name = $_POST["name_2"];
$user_password = $_POST["password_2"];

if($user_name && $user_password) {
$sql_1 = "INSERT INTO user (name,password) VALUES('$user_name','$user_password')";
$excu_1 = mysql_query($sql_1,$conn);
}
if($excu_1) {
echo"<script>alert('ע��ɹ����¼');</script>";
echo"<script>location.href='login.html';</script>";
} else if($user_name != ''){
echo"<script>alert('������ͬ�û�����������ע��');</script>";
}
mysql_close($conn);
?>