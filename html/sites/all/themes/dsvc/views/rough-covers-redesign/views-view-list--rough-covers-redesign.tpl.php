<<?php print $options['type']; ?> id="rough-cover-gallery" class="item-list">
  <?php foreach ($rows as $id => $row): ?>
    <li id="cover-image-<?= $id ?>" class="cover-image"><?php print $row; ?></li>
  <?php endforeach; ?>
</<?php print $options['type']; ?>>