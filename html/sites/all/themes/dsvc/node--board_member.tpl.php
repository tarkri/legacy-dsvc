<h3 class="org"><?= $node->title ?></h3>
<span class="fn"><?= $node->field_contact_name['und'][0]["value"] ?></span><br />
<a class="email" href="mailto:<?= $node->field_contact_email['und'][0]["value"] ?>"><?= $node->field_contact_email['und'][0]["value"] ?></a>
