<head>
    <title>Link-Book: Message</title>
    <?php include("header.php");?>
</head>
<body>
<?php
include("checksession.php");
include("navbar.php");
?>
<a href="home.php">Home</a>
<a href="profile.php">Profile</a>
<a href="connections.php">Connections</a>
<a href="search.php">Search</a>
<a href="listings.php">Listings</a>
<a href="#" style="color: red">Messages</a>
<a href="logout.php">Log-Out</a>
<h1>Link-Book</h1>
<a href="profile.php?pid=example">Photo</a>
<p>Example Message</p>
<a href="profile.php?pid=you">Your Photo</a>
<p>Your Reply</p>
<p>Editable text field to reply</p>
<button>Send</button>
</body>