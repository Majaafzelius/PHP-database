<?php
$page_title = 'Admin';
include ('includes/header.php');

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('location: login.php');
}

echo '<main>';
echo '<a href="logout.php">Logga ut</a>';
echo '<div id="cont">';
include ('includes/sidebar.php');
$title = isset($_POST['title']) ? $_POST['title'] : '';
$content = isset($_POST['content']) ? $_POST['content'] : '';

?>

<form method="post">
    <label for="title">Titel</label><br>
    <input type="text" id="title" name="title"><br>
    <br>
    <label for="content">Innehåll:</label><br>
    <textarea name="content" id="content" rows="10"></textarea>
    <input type="submit" value="Lägg upp">
</form>
</div>
<?php
$postobj = new Post();
$posts = $postobj->get_data_admin();

if ($title!=null & $content!=null) {
    $postobj->save_data($title, $content, date("Y-m-d H:i:s"));
}
else {
    echo 'Vänligen fyll i en titel och innehåll på ditt inlägg. ';
}
foreach ($posts as $post) {
    ?>
        <article class="post" id="<?php echo $post['id']; ?>">
            <h2><?php echo $post['title']; ?></h2>
            <p class="content"><?php echo $post['content']; ?></p>
            <div class="meta">
                <span class="date"><?php echo $post['date']; ?></span>
                <form method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                    <input type="submit" name="submit" value="Ta bort inlägg">
                </form>
            </div>
        </article>
    <?php
    }

include ('includes/footer.php');