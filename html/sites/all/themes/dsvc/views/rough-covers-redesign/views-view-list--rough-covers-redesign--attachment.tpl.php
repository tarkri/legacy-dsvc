<<?php print $options['type']; ?> id="gallery-navigation">
  <?php foreach ($rows as $id => $row): ?>
    <li id="cover-thumbnail-<?= $id ?>" class="cover-thumbnail"><?php print $row; ?></li>
  <?php endforeach; ?>
</<?php print $options['type']; ?>>