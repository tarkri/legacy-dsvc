<a id="logo" href="/" class="url" rel="home" title="Home">
	<img src="<?= file_create_url($node->field_custom_logo['und'][0]['uri']); ?>" alt="Dallas Society of Visual Communications" class="logo fn org" />
</a>
<a href="<?= url("node/".$node->field_meeting_reference['und'][0]['nid']) ?>" id="upcoming-meeting"><?php print $title; ?></a>
