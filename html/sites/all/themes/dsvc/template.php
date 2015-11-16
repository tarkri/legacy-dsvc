<?php

/**
 * Modify theme variables
 */
function dsvc_preprocess(&$vars) {
  global $user;                                            // Get the current user
  $vars['is_admin'] = in_array('admin', $user->roles);     // Check for Admin, logged in
  $vars['is_member'] = in_array('dsvc_member', $user->roles);
  $vars['logged_in'] = ($user->uid > 0) ? TRUE : FALSE;
  $vars['account'] = ($user->uid > 0) ? user_load($user->uid) : NULL;
  ctools_include('modal');
  ctools_modal_add_js();
}

function dsvc_preprocess_page(&$vars) {
}

function dsvc_preprocess_node(&$variables) {
  $node = $variables['node'];

  // Build array of handy node classes
  $node_classes = array();
  $node_classes[] = $variables['zebra'];                                      // Node is odd or even
  $node_classes[] = (!$node->status) ? 'node-unpublished' : '';  // Node is unpublished
  $node_classes[] = ($variables['sticky']) ? 'sticky' : '';                   // Node is sticky
  $node_classes[] = (isset($node->teaser)) ? 'teaser' : 'full-node';    // Node is teaser or full-node
  $node_classes[] = 'node-type-'. $node->type;                   // Node is type-x, e.g., node-type-page
  $node_classes = array_filter($node_classes);                           // Remove empty elements
  $variables['node_classes'] = implode(' ', $node_classes);                   // Implode class list with spaces

  if ($node->type == "event" || $node->type == "monthly_meeting" || $node->type == "dsvc_news" || $node->type == "working_lunch" || $node->type == "webform") {
  	$variables['nq_pos'] = nodequeue_queue_position(1, $node->nid);
  }

  if ($node->type == "monthly_meeting") {
  	$meeting_time = $node->field_meeting_date[LANGUAGE_NONE][0];
		$variables['meeting'] = new DateObject($meeting_time["value"], "UTC");
		$variables['reception'] = new DateObject($meeting_time["value"], "UTC");
		$variables['meeting']->setTimezone(new DateTimeZone($meeting_time["timezone"]));
		$variables['reception']->setTimezone(new DateTimeZone($meeting_time["timezone"]))->modify('-1 hour');
  }

  if ($node->type == "working_lunch") {
  	$meeting_time = $node->field_date_and_time[LANGUAGE_NONE][0];
		$variables['date_from'] = new DateObject($meeting_time["value"], 'UTC');
		$variables['date_to'] = new DateObject($meeting_time["value2"], 'UTC');
		$variables['date_from']->setTimezone(new DateTimeZone($meeting_time["timezone"]));
		$variables['date_to']->setTimeZone(new DateTimeZone($meeting_time["timezone"]));
  }

  if ($node->type == "event") {
  	$meeting_time = $node->field_event_time[LANGUAGE_NONE][0];
   	$variables['event_date'] = new DateObject($meeting_time["value"], 'UTC');
    $variables['event_date']->setTimeZone(timezone_open($meeting_time["timezone"]));
  }

  if ($node->type =="award") {
    $show_year = $node->field_show_year[LANGUAGE_NONE][0];
    $variables['show_year'] = new DateObject($show_year["value"], 'UTC');
  }
}

function dsvc_preprocess_comment(&$variables) {
  $comment = $variables['elements']['#comment'];
  $node = $variables['elements']['#node'];
  $variables['comment']   = $comment;
  $variables['node']      = $node;
  $variables['author']    = theme('username', array('account' => $comment));
  $variables['created']   = format_date($comment->created, 'custom', 'M. j, Y');
  $variables['changed']   = format_date($comment->changed);

  $variables['new']       = !empty($comment->new) ? t('new') : '';
  $variables['picture']   = theme_get_setting('toggle_comment_user_picture') ? theme('user_picture', array('account' => $comment)) : '';
  $variables['signature'] = $comment->signature;

  $uri = entity_uri('comment', $comment);
  $uri['options'] += array('attributes' => array(
      'class' => 'permalink',
      'rel' => 'bookmark',
    ));

  $variables['title']     = l($comment->subject, $uri['path'], $uri['options']);
  $variables['permalink'] = l(t('Permalink'), $uri['path'], $uri['options']);
  $variables['submitted'] = t('on !datetime', array('!datetime' => $variables['created']));

  // Preprocess fields.
  field_attach_preprocess('comment', $comment, $variables['elements'], $variables);

  // Helpful $content variable for templates.
  foreach (element_children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }

  // Set status to a string representation of comment->status.
  if (isset($comment->in_preview)) {
    $variables['status'] = 'comment-preview';
  }
  else {
    $variables['status'] = ($comment->status == COMMENT_NOT_PUBLISHED) ? 'comment-unpublished' : 'comment-published';
  }
  // Gather comment classes.
  if ($comment->uid == 0) {
    $variables['classes_array'][] = 'comment-by-anonymous';
  }
  else {
    // Published class is not needed. It is either 'comment-preview' or 'comment-unpublished'.
    if ($variables['status'] != 'comment-published') {
      $variables['classes_array'][] = $variables['status'];
    }
    if ($comment->uid === $variables['node']->uid) {
      $variables['classes_array'][] = 'comment-by-node-author';
    }
    if ($comment->uid === $variables['user']->uid) {
      $variables['classes_array'][] = 'comment-by-viewer';
    }
    if ($variables['new']) {
      $variables['classes_array'][] = 'comment-new';
    }
  }
}

function dsvc_pager($variables) {
  $tags = $variables['tags'];
  $element = $variables['element'];
  $parameters = $variables['parameters'];
  $quantity = $variables['quantity'];
  global $pager_page_array, $pager_total;

  // Calculate various markers within this pager piece:
  // Middle is used to "center" pages around the current page.
  $pager_middle = ceil($quantity / 2);
  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // first is the first page listed by this pager piece (re quantity)
  $pager_first = $pager_current - $pager_middle + 1;
  // last is the last page listed by this pager piece (re quantity)
  $pager_last = $pager_current + $quantity - $pager_middle;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  // Prepare for generation loop.
  $i = $pager_first;
  if ($pager_last > $pager_max) {
    // Adjust "center" if at end of query.
    $i = $i + ($pager_max - $pager_last);
    $pager_last = $pager_max;
  }
  if ($i <= 0) {
    // Adjust "center" if at start of query.
    $pager_last = $pager_last + (1 - $i);
    $i = 1;
  }
  // End of generation loop preparation.

  $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
  $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next ›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
  $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));

  if ($pager_total[$element] > 1) {
    if ($li_previous) {
      $items[] = array(
        'class' => array('pager-previous'),
        'data' => $li_previous,
      );
    }
    else {
			$items[] = array(
        'class' => array('pager-previous'),
        'data' => '<span class="disabled">previous</span>',
			);
    }


    // When there is more than one page, create the pager list.
    if ($i != $pager_max) {
      if ($i > 1) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
      // Now generate the actual pager piece.
      for (; $i <= $pager_last && $i <= $pager_max; $i++) {
        if ($i < $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
          );
        }
        if ($i == $pager_current) {
          $items[] = array(
            'class' => array('pager-current'),
            'data' => $i,
          );
        }
        if ($i > $pager_current) {
          $items[] = array(
            'class' => array('pager-item'),
            'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
          );
        }
      }
      if ($i < $pager_max) {
        $items[] = array(
          'class' => array('pager-ellipsis'),
          'data' => '…',
        );
      }
    }
    // End generation.
    if ($li_next) {
      $items[] = array(
        'class' => array('pager-next'),
        'data' => $li_next,
      );
    }
    else {
			$items[] = array(
				'class' => array('pager-next'),
				'data' => '<span class="disabled">next</span>',
      );
    }

    return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
      'items' => $items,
      'attributes' => array('class' => array('pager')),
    ));
  }
}

function dsvc_preprocess_user_profile(&$variables) {
  global $user;

  $account = $variables['elements']['#account'];
  if ($user->uid == $account->uid) {
    $variables['own_profile'] = true;
  }
  else {
    $variables['own_profile'] = false;
  }

  $field_types = array("field_email", "field_job_title", "field_employer", "field_primary_address", "field_primary_phone");

  foreach ($field_types as $field) {
    $field_info = field_info_field($field);

    // drupal_set_message(_user_field_privacy_value($field_info['id'], $account->uid));

    if (_user_field_privacy_value($field_info['id'], $account->uid)) {
      $variables[$field][0]['field_is_private']['value'] = true;
      $variables[$field][0]['field_is_private']['display'] = "Private";
    }
    else {
     $variables[$field][0]['field_is_private']['value'] = false;
     $variables[$field][0]['field_is_private']['display'] = "Public";
    }
  }

}

function dsvc_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  switch ($element['#title']):
    case "Dallas Show Winners":
    case "50 Years of Posters":
      $output = $element['#title'];
      break;

    default:
      $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  endswitch;

  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";
}

function dsvc_user_form() {
	global $user;

	$output = '';
	if (!$user->uid) {
		$output .= drupal_render(drupal_get_form('user_login'));
	}
	$output = '<div id="login-form">'.$output.'</div>';
	return $output;
}


function dsvc_token_truncate($string, $your_desired_width) {
  $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
  $parts_count = count($parts);

  $length = 0;
  $last_part = 0;
  for (; $last_part < $parts_count; ++$last_part) {
    $length += strlen($parts[$last_part]);
    if ($length > $your_desired_width) { break; }
  }

  return implode(array_slice($parts, 0, $last_part))."&hellip;";
}

?>
