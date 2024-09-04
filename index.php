<?php
$page_title = 'Startsida';
include ('includes/header.php');

echo '<main>';
echo '<div id="cont">';
include ('includes/sidebar.php');
echo '</div>';
echo '<h2>Senaste Nytt</h2>';
$postobj = new Post();
$posts = $postobj->get_data_index();
foreach ($posts as $post) {
    ?>
        <article class="post" id="<?php echo $post['id']; ?>">
            <h2><?php echo $post['title']; ?></h2>
            <div class="meta">
                <span class="date"><i><?php echo $post['date']; ?></i></span>
            </div>
            <p class="content"><?php echo $post['content']; ?></p>
            <a href="fulltext.php?id=<?php echo $post['id']?>">Läs mer</a>
        </article>
    <?php
    }
include ("includes/footer.php");