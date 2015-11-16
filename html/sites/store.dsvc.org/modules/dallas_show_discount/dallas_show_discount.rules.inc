<?php

function dallas_show_discount_rules_action_info() {
  $actions = array();

  $actions['dallas_show_discount_entries'] = array(
    'label' => t('Set order to set amount'),
    'parameter' => array(
      'commerce_order' => array(
        'type' => 'commerce_order',
        'label' => t('Order'),
        'description' => t('The order whose line items should be checked for the specified product. If the specified order does not exist, the comparison will act as if it is against a quantity of 0.'),
      ),
      'discount_amount' => array(
        'type' => 'decimal',
        'label' => t('Set order amount'),
        'description' => t('Set the order amount to this value.'),
      ),
      'user' => array(
        'type' => 'user',
        'label' => t('User'),
        'description' => t('Specify the user whose shopping cart order the product will be added to, typically <em>site:current-user</em>.'),
      ),
    ),
    'group' => t('Commerce Order'),
  );

  return $actions;
}

/**
 * Condition callback: checks to see if a particular product exists on an order
 * in the specified quantity.
 */
function dallas_show_discount_entries($order, $discount, $user) {
  // If we actually received a valid order...
  if (!empty($order)) {
    $wrapper = entity_metadata_wrapper('commerce_order', $order);
    $total = $wrapper->commerce_order_total->amount->value();

    $discount_amount = array(
      'amount' => -($total - $discount),
      'currency_code' => $wrapper->commerce_order_total->currency_code->value(),
    );

    dallas_show_discount_add_line_item($wrapper, 'Bulk Item Discount', $discount_amount);

    commerce_order_calculate_total($order);
  }
}

/**
 * Creates a discount line item on the provided order.
 *
 * @param $order_wrapper
 *   The wrapped order entity.
 * @param $discount_name
 *   The name of the discount being applied.
 * @param $dicount_amount
 *   The discount amount price array (amount, currency_code).
 */
function dallas_show_discount_add_line_item($order_wrapper, $discount_name, $discount_amount) {
  // Create a new line item.
  $discount_line_item = entity_create('commerce_line_item', array(
    'type' => 'commerce_discount',
    'order_id' => $order_wrapper->order_id->value(),
    'quantity' => 1,
  ));
  $discount_line_item_wrapper = entity_metadata_wrapper('commerce_line_item', $discount_line_item);

  // Initialize the line item unit price.
  $discount_line_item_wrapper->commerce_unit_price->amount = 0;
  $discount_line_item_wrapper->commerce_unit_price->currency_code = $discount_amount['currency_code'];

  // Reset the data array of the line item total field to only include a
  // base price component, set the currency code from the order.
  $base_price = array(
    'amount' => 0,
    'currency_code' => $discount_amount['currency_code'],
    'data' => array(),
  );
  $discount_line_item_wrapper->commerce_unit_price->data = commerce_price_component_add($base_price, 'base_price', $base_price, TRUE);

  // Add the actual discount price component.
  dallas_show_discount_add_price_component($discount_line_item_wrapper, $discount_name, $discount_amount);

  // Save the line item and add it to the order.
  $discount_line_item_wrapper->save();
  $order_wrapper->commerce_line_items[] = $discount_line_item_wrapper;
}

/**
 * Adds a discount price component to the provided line item.
 *
 * @param $line_item_wrapper
 *   The wrapped line item entity.
 * @param $discount_name
 *   The name of the discount being applied.
 * @param $dicount_amount
 *   The discount amount price array (amount, currency_code).
 */
function dallas_show_discount_add_price_component($line_item_wrapper, $discount_name, $discount_amount) {
  $unit_price = commerce_price_wrapper_value($line_item_wrapper, 'commerce_unit_price', TRUE);
  $current_amount = $unit_price['amount'];
  // Currencies don't match, abort.
  if ($discount_amount['currency_code'] != $unit_price['currency_code']) {
    return;
  }

  // Calculate the updated amount and create a price array representing the
  // difference between it and the current amount.
  $updated_amount = commerce_round(COMMERCE_ROUND_HALF_UP, $current_amount + $discount_amount['amount']);

  $difference = array(
    'amount' => $discount_amount['amount'],
    'currency_code' => $discount_amount['currency_code'],
    'data' => array('discount_name' => $discount_name),
  );

  // Set the amount of the unit price and add the difference as a component.
  $line_item_wrapper->commerce_unit_price->amount = $updated_amount;

  $line_item_wrapper->commerce_unit_price->data = commerce_price_component_add(
    $line_item_wrapper->commerce_unit_price->value(),
    'discount',
    $difference,
    TRUE
  );
}
