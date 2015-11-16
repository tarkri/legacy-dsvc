<?php

// Grabs the firsts image path and sets $imagePath.
$imagePath = $node->field_image_cache['0']['filepath'];
?>
<div id="node">
<?php // product title  ?>
<h2><?php print $title ?></h2>
<?php // product description  ?>
<?php print $node->content['body']['#value'];  ?>
<?php  // list price and sell price display  ?>
<div id="price">
<p>Price: <?php print uc_currency_format($node->sell_price); ?></p>
</div>

<div id="image"><img src="/files/imagecache/product/<?php print $imagePath; ?>" alt="Title"></div>
<p>Sub Images</p>

<div id="cartButtons">
<?php // add to cart buttons ?>
<?php print $node->content['add_to_cart']["#value"]; ?>
</div>
</div>