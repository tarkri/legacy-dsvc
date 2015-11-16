<?php

/**
 * @file
 * Default print module template
 *
 * @ingroup print
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $print['language']; ?>" xml:lang="<?php print $print['language']; ?>">
  <head>
    <?php print $print['head']; ?>
    <?php print $print['base_href']; ?>
    <title><?php print $print['title']; ?></title>
    <?php print $print['scripts']; ?>
    <?php print $print['sendtoprinter']; ?>
    <?php print $print['robots_meta']; ?>
    <?php print $print['favicon']; ?>
    <?php print $print['css']; ?>
  </head>
  <body>

     <div>
      <?php if (!empty($node->field_show_category)) : ?>
        <?php
          $term = taxonomy_term_load($node->field_show_category['und'][0]['tid']);
          $parent_terms = taxonomy_get_parents($node->field_show_category['und'][0]['tid']);
          $parents = '';

          foreach ($parent_terms as $pTerm) {
            $parents .= $pTerm->name . " &gt; ";
          }
        ?>
        <h1>Category: <?php print $parents . $term->name; ?></h1>
        <h2><strong>Title:</strong> <?php print $node->title_field['und'][0]['value']; ?></h2>
      <?php endif; ?>
    </div>

    <hr class="print-hr" />

    <div>
      <img src="http://chart.apis.google.com/chart?chs=150x150&cht=qr&chl=<?php print $node->nid ?>" width="150" height="150" />

      <h3>Primary Contact Information</h3>
      <p>
        <strong>Name:</strong> <?php print $node->field_receipt_name['und'][0]['value']; ?><br />

        <strong>Email:</strong> <?php print $node->field_rec_primary_contact_email['und'][0]['value']; ?>
      </p>
    </div>

    <hr class="print-hr" />

    <div>
      <h3>Agency Information</h3>

      <p>
        <strong>Agency Name:</strong> <?php print $node->field_receipt_agency_information['und'][0]['organisation_name']; ?><br />

        <strong>Agency Address:</strong><br />
        <?php print $node->field_receipt_agency_information['und'][0]['thoroughfare']; ?><br />
        <?php if (!empty($node->field_receipt_agency_information['und'][0]['premise'])) : ?>
          <?php print $node->field_receipt_agency_information['und'][0]['premise']; ?><br />
        <?php endif; ?>
        <?php print $node->field_receipt_agency_information['und'][0]['locality']; ?>,&nbsp;<?php print $node->field_receipt_agency_information['und'][0]['administrative_area']; ?>&nbsp;<?php print $node->field_receipt_agency_information['und'][0]['postal_code']; ?>
      </p>
    </div>

    <hr class="print-hr" />

    <h4>Order ID: <?php print $node->field_order_id['und'][0]['value']; ?></h4>
    <h4>Tracking ID: <?php print $node->nid; ?></h4>

    <?php print $print['footer_scripts']; ?>
  </body>
</html>
