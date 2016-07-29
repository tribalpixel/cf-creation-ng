<p><a data-toggle="panel-<?php the_ID(); ?>">Toggle Panel</a></p>
<div class="callout large primary" data-toggler data-animate="hinge-in-from-top" id="panel-<?php the_ID(); ?>">
<?php the_title('<h4>','</h4>'); ?>
<?php the_content(); ?>
</div>

<hr />