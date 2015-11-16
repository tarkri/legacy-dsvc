<a class="monthly-sponsor" href="<?= $node->field_sponsor_url['und'][0]['safe_value'] ?>">
<?= theme_image_style(array('style_name' => 'sponsored_by_image', 'path' => $node->field_sponsor_image['und'][0]['uri'], 'width' => NULL, 'height' => NULL)); ?>
<em><?= $node->title ?></em>
</a><!-- /#monthly-sponsor -->
