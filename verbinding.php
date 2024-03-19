<?php
	$link =  new mysqli('localhost','root','','db_lockers');
	if ($link->connect_errno) 
	{
    	echo "Failed to connect to MySQL: (" . $link->connect_errno . ") " . $link->connect_error;
	}


// Template header --> komt uit webwinkelGOK
function template_header($title) {
// Get the amount of items in the shopping cart, this will be displayed in the header.
    $num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
//<<< duidt aan dat er een lange string  volgt
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="assets/css/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">

                <a class="navbar-brand" href="basis_index.html"><img src="assets/images/in%20T-rek.jpg" alt="" width="200px"></a>
                <div class="link-icons">
                    <a href="index.php?page=cart">
						<i class="fas fa-shopping-cart"></i>
                        <span>$num_items_in_cart</span>
					</a>
                </div>
            </div>
        </header>
        <main>
EOT; //einde lange string
}
?>