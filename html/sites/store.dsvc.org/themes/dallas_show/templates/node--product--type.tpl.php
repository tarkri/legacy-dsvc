

<article<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php if (!$page && $title): ?>
  <header>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url ?>" title="<?php print $title ?>"><?php print $title ?></a></h2>
  </header>
  <?php endif; ?>
  <?php print render($title_suffix); ?>
  <?php if ($display_submitted): ?>
  <footer class="submitted"><?php print $date; ?> -- <?php print $name; ?></footer>
  <?php endif; ?>

  <div class="alpha grid-10" <?php print $content_attributes; ?>>
    <?php
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
    ?>
  </div>

  <div class="omega grid-8">
    <ul class="taxonomies">
      <?php foreach ($taxonomy as $term) : ?>
        <?php if (!empty($term->description)) : ?>
          <li id="<?php print $term->tid; ?>"><?php print $term->description; ?></li>
        <?php endif; ?>
      <?php endforeach; ?>
    </ul>
  </div>
</article>
