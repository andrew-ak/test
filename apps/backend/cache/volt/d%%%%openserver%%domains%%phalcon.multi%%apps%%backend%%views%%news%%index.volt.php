<h1>News backend</h1>

<?php $v17328506241iterated = false; ?><?php foreach ($news as $new) { ?><?php $v17328506241iterated = true; ?>
    News id: <?php echo $this->escaper->escapeHtml($new->id); ?> title: <?php echo $this->escaper->escapeHtml($new->title); ?> <br />
    <?php } if (!$v17328506241iterated) { ?>
    There are no news to show
<?php } ?>