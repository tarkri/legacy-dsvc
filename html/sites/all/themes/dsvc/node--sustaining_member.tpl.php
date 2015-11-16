<h3 class="org"><?= $node->title ?></h3>
<span class="fn"><?= $node->field_contact_name['und'][0]["value"] ?></span><br />
<span class="title"><?= $node->field_contact_job_title['und'][0]["value"] ?></span>
<div class="adr">
	<span class="street-address"><?= $node->field_location['und'][0]["street"] ?></span><br />
	<span class="locality"><?= $node->field_location['und'][0]["city"] ?></span>, <span class="region"><?= $node->field_location['und'][0]["province"] ?></span> <span class="postal-code"><?= $node->field_location['und'][0]["postal_code"] ?></span>
</div>
<span class="tel"><?= $node->field_location['und'][0]["phone"] ?></span><br />
<a class="email" href="mailto:<?= $node->field_contact_email['und'][0]["value"] ?>"><?= $node->field_contact_email['und'][0]["value"] ?></a>
