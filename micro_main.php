 <?php
//ȫ�ֱ���
$arrType=array('image/jpg','image/gif','image/png','image/bmp','image/pjpeg');
$max_size='500000';      // ����ļ����ƣ���λ��byte��?
$upfile='./'; //ͼƬĿ¼·��
$file=$_FILES['upfile'];
  
   if($_SERVER['REQUEST_METHOD']=='POST'){ //�ж��ύ��ʽ�Ƿ�ΪPOST
     if(!is_uploaded_file($file['tmp_name'])){ //�ж��ϴ��ļ��Ƿ����
    echo "<font color='#FF0000'>�ļ������ڣ�</font>";
    exit;
    }
   
  if($file['size']>$max_size){  
    echo "<font color='#FF0000'>�ϴ��ļ�̫��/font>";
    exit;
   } 

  if(!file_exists($upfile)){  
   mkdir($upfile,0777,true);
   } 
      $imageSize=getimagesize($file['tmp_name']);
   $img=$imageSize[0].'*'.$imageSize[1];
   $fname=$file['name'];
   $ftype=explode('.',$fname);
   $picName=$upfile."/cloudy".$fname;
   
   if(file_exists($picName)){
     $picName=$picName."1";
     }
   if(!move_uploaded_file($file['tmp_name'],$picName)){  
    echo "<font color='#FF0000'>�ƶ��ļ�����/font>";
    exit;
    }
      }
$host='172.18.33.223:3306';
$user_name='root';
$password='1234';
$conn=mysql_connect($host,$user_name,$password);
mysql_query("CREATE DATABASE book_information",$conn);
mysql_select_db("book_information",$conn);
mysql_query("SET CHARACTER SET utf8");
mysql_query("CREATE TABLE publisher_place(place_name varchar(30),publisher_name varchar(30), PRIMARY KEY  (`place_name`,`publisher_name`))",$conn);
mysql_query("CREATE TABLE book_information(book_name varchar(30),publisher_name varchar(30),year_id int(4),owner_name varchar(30),phone_number varchar(30),book_introduction varchar(400),book_image varchar(400) ,PRIMARY KEY  (`book_name`))",$conn);
mysql_query("CREATE TABLE book_type(book_name varchar(30),book_type varchar(30),PRIMARY KEY  (`book_name`))",$conn);
mysql_query("CREATE TABLE book_pages(book_name varchar(30),book_pages int(4), PRIMARY KEY  (`book_name`))",$conn);
$owner_name = $_COOKIE['login'];
$name=$_POST["name"];
$year=$_POST["year"];
$publisher=$_POST["publisher"];
$place=$_POST["place"];
$page_number=$_POST["page_number"];
$type=$_POST["type"];
$phone=$_POST["phone"];
$introduction = $_POST["introduction"];
$sql_1 = "INSERT INTO publisher_place (place_name,publisher_name) VALUES('$place','$publisher')";
$excu_1 = mysql_query($sql_1,$conn);
$sql_2 = "INSERT INTO book_information (book_name,publisher_name,year_id,owner_name,phone_number,book_introduction,book_image) VALUES('$name','$publisher','$year','$owner_name','$phone','$introduction','$picName')";
$excu_2 = mysql_query($sql_2,$conn);
$sql_3 = "INSERT INTO book_type (book_name,book_type) VALUES('$name','$type')";
$excu_3 = mysql_query($sql_3,$conn);
$sql_4 = "INSERT INTO book_pages (book_name,book_pages) VALUES('$name','$page_number')";
$excu_4 = mysql_query($sql_4,$conn);

mysql_close($conn);
echo "<script language=JavaScript> location.replace('micro_main.html');</script>";
?>