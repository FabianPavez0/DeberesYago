<?php

	


$con = new mysqli('localhost', 'root', '', 'employees');


if($_SERVER['REQUEST_METHOD'] == "POST"){

$post = 'y';	




if( isset($_POST['fsurname']) && !empty($_POST['fsurname']))
{$surname = $_POST['fsurname'];}
else{
$error = 1;
}


if( isset($_POST['fname']) && !empty($_POST['fname']))
{$name = $_POST['fname'];}
else{
$error = 1;
}

if( isset($_POST['gender']) && !empty($_POST['gender']))
{$gender = $_POST['gender'];}
else{
$error = 1;
}

if( isset($_POST['birth_date']) && !empty($_POST['birth_date']))
{$birth_date = $_POST['birth_date'];}
else{
$error = 1;
}

if( isset($_POST['hire_date']) && !empty($_POST['hire_date']))
{$hire_date = $_POST['hire_date'];}
else{
$error = 1;
}

}else{

$post = 'n';
}



print(
"
<form action \"?\" method=\"post\" id=\"submitForm\">
<label for=\"fname\">Nombre</label>

<input type=text name = \"fname\" value = \"yago\">
<label for=\"fsurname\">Apellido</label>
<input type=text name = \"fsurname\" value = \"casasnovas\">
<label for=\"birth_date\">Fecha Nacimiento</label>

<input type=date name = \"birth_date\">
<label for=\"gender\">Género</label>

<select name= \"gender\" id=\"gender\">
  <option value=\"M\">Masculino</option>
  <option value=\"F\">Femenino</option>
  
</select>



<label for=\"hire_date\">Contratación</label>
<input type=date name = \"hire_date\">

<input type=\"submit\">
</form>
"
);

if($post == 'y'){
	
$query = "SELECT max(emp_no) FROM employees";
   $res = mysqli_query($con, $query);
$hello = mysqli_fetch_array($res);
$h = $hello[0]  +  1;

	
	
	
$query = "INSERT INTO employees (emp_no, first_name, last_name, birth_date, hire_date, gender) VALUES ('".$h."', '".$name."','".$surname."','".$birth_date."','".$hire_date."','".$gender."')";

   $res = mysqli_query($con, $query);
 


}

?>
