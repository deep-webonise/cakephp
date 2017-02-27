<!-- File: /app/View/Posts/view.ctp -->
~~Strike through this text.~~
<h1><?php echo h($post['Post']['title']); ?></h1>

<h4><small>Created: <?php echo $post['Post']['created']; ?></small></h4>

<p><?php echo h($post['Post']['body']); ?></p>