<?php
	session_start();
	if(!isset($_SESSION["check"])) {
		session_destroy();
		header("location: http://localhost/MyFiles/main_page.php");
	}
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$dbhost = 'localhost';
		$dbuser = 'root';
		$pass = '8241';
		$dbname = 'admin';
		$conn = mysqli_connect($dbhost, $dbuser, $pass, $dbname);
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		$sql="select id, book_name, author, quantity, price from books where id not in (select book_id from book_members)";
		$res=mysqli_query($conn, $sql);
		$store=array();
		if(mysqli_num_rows($res)>0) {
			while($row=mysqli_fetch_assoc($res)) {
				$store[$row["book_name"]]=$row["author"]."!".$row["id"]."!".$row["quantity"]."!".$row["price"]."!1!0";
			}
		}
		$sql="select id, book_name, author, quantity, price from books where id in (select book_id from book_members)";
		$res=mysqli_query($conn, $sql);
		if(mysqli_num_rows($res)>0) {
			while($row=mysqli_fetch_assoc($res)) {
				$sql="select count(mem_id) as c3 from book_members where book_id='$row[id]' group by book_id";
				$res1=mysqli_query($conn, $sql);
				$res1=mysqli_fetch_object($res1);
				$store[$row["book_name"]]=$row["author"]."!".$row["id"]."!".$row["quantity"]."!".$row["price"]."!".$res1->c3."!1";
			}
		}
		mysqli_close($conn);
		if (!empty($store)) {
			echo json_encode($store);
		}
	}
