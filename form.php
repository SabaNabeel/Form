Hello from form.php

<style> table, td, caption { border: 5px solid blue  ; padding: 10px; } </style>
<style> td                 { border: 3px solid pink ; }                </style>
<style> caption            { color: red ; }                             </style>
<style> table { margin:auto; } </style>

<?php

($_GET["password"]=="2qaz")or die ( "You have entered an invalid password. Please try again.<br><br>
												THANK YOU" );
include ("account.php");
( $dbh = mysql_connect ( $hostname, $username, $password ) )

			or die ( "Unable to connect to MySQL database" );
			
print "Connected to MySQL<br>";

mysql_select_db( $project );
$username  = $_GET [ "username"] ;
print "Transformed name is :$username<br>";

if ( isset ( $_GET["all"] ) )
	{$s = "select * from REGISTERED "; 
	$g = "select * from GRADES ";}
else
	{$s= "select * from REGISTERED where username='$username'" ; 
	$g= "select * from GRADES where username= '$username'";} 

	 
print "<br>$s<br><br>\n\r";

( $t = mysql_query ( $s  ) ) or die ( mysql_error() );
print "<table>\n\r";
print "<caption> REGISTERED Table : Number of rows is ".  mysql_num_rows ($t). "</caption>\n\r" ;
print "<tr> <td>Username</td> <td>Fullname</td> <td>Email</td> <td>Phone</td><td>Address</td><td>Registration_datetime</td><td>Major</td> </tr>\n\r";

while (   $r = mysql_fetch_array($t) )
{
    $username = $r["username"];
	$fullname  = $r["fullname"];
	$email = $r["email"];
	$phone = $r["phone"];
	$address = $r["address"];
	$major = $r["major"];
	$registration_datetime=$r["registration_datetime"];
		print "<tr> <td>$username</td> <td>$fullname</td> <td>$email</td> <td>$phone</td><td>$address</td><td>$registration_datetime</td><td>$major</td></tr>\n\r";
}
print "</table>\n\r";

print "<br>$g<br><br>\n\r";

( $d = mysql_query ( $g  ) ) or die ( mysql_error() );
print "<table>\n\r";
print "<caption> GRADES Table : Number of rows is ".  mysql_num_rows ($d). "</caption>\n\r" ;
print "<tr> <td>Username</td> <td>Course</td> <td>A1</td> <td>A1S</td><td>A2</td><td>A2S</td><td>PARTIC</td> <td>TOTAL</td><td>PERCENTof150</td></tr>\n\r";

while (   $v = mysql_fetch_array($d) )
{
	$username = $v["username"];
	$course = $v["course"];
	$A1 = $v["A1"];
	$A1S =$v["A1S"];
	$A2 = $v["A2"];
	$A2S =$v["A2S"];
	$PARTIC =$v["PARTIC"];
	$TOTAL =$v["TOTAL"];
	$PERCENTof150 =$v["PERCENTof150"];
	print "<tr> <td>$username</td><td>$course</td><td>$A1</td><td>$A1S</td><td>$A2</td><td>$A2S</td><td>$PARTIC</td><td>$TOTAL</td><td>$PERCENTof150</td> </tr>\n\r";
	
}
print "</table>\n\r";
print"<br><br>";

if (mysql_num_rows ($t)==1)
	{$to = $email;
	$subject="Registration Info & Gardes for $username";
	$message="Dear $fullname, 
	Username: $username 
	Address : $address  
	Email   : $email	
	Phone   : $phone	
	Major	: $major
						You successfully registered at $registration_datetime 
		Your current grades are:
	Course	: $course
	A1		: $A1
	A1S		: $A1S
	A2		: $A2
	A2S		: $A2S
	PARTIC	: $PARTIC
	TOTAL	: $TOTAL
	PERCENTof150: $PERCENTof150
		
						Good luck with your course of study !";
	
	mail ($to ,  $subject ,  $message);
	print "Email sent to $email ";
	};
print "<br><br>GOODBYE! GOAL HAS BEEN ACHIVIED";

?>