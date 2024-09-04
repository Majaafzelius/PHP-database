<?php
$page_title = 'Inlägg';
include ('includes/header.php');

echo '<main>';
include ('includes/sidebar.php');
echo '<section id="post">';

$i = $_GET['id'];
$post = new Post();
$post->fulltext($i);
echo '</section>';
include ("includes/footer.php");