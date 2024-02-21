<?php

	


$con = new mysqli('localhost', 'root', '', 'employees');


$surname = $_POST['fsurname'];
$name = $_POST['fname'];

$gender = $_POST['fgender'];

$birth_date = $_POST['fbirthdate'];
$hire_date = $_POST['fhiredate'];


$query = "SELECT max(emp_no) FROM employees";
   $res = mysqli_query($con, $query);
$hello = mysqli_fetch_array($res);
$h = $hello[0]  +  1;

	
$query = "INSERT INTO employees (emp_no, first_name, last_name, birth_date, hire_date, gender) VALUES ('".$h."', '".$name."','".$surname."','".$birth_date."','".$hire_date."','".$gender."')";

$res = mysqli_query($con, $query);
 

echo $query;
echo $res;




?>
