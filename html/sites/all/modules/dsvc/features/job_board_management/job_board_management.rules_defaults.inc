<?php
/**
 * @file
 * job_board_management.rules_defaults.inc
 */

/**
 * Implements hook_default_rules_configuration().
 */
function job_board_management_default_rules_configuration() {
  $items = array();
  $items['rules_delete_node'] = entity_import('rules_config', '{ "rules_delete_node" : {
      "LABEL" : "Delete Node",
      "PLUGIN" : "action set",
      "TAGS" : [ "content management" ],
      "REQUIRES" : [ "rules" ],
      "USES VARIABLES" : { "node" : { "label" : "Node", "type" : "node" } },
      "ACTION SET" : [ { "entity_delete" : { "data" : [ "node" ] } } ]
    }
  }');
  $items['rules_schedule_job_post_actions'] = entity_import('rules_config', '{ "rules_schedule_job_post_actions" : {
      "LABEL" : "Schedule Job Post actions",
      "PLUGIN" : "reaction rule",
      "TAGS" : [ "content management" ],
      "REQUIRES" : [ "rules", "rules_scheduler" ],
      "ON" : [ "node_insert" ],
      "IF" : [
        { "node_is_of_type" : {
            "node" : [ "node" ],
            "type" : { "value" : { "job_posting" : "job_posting" } }
          }
        }
      ],
      "DO" : [
        { "schedule" : {
            "component" : "rules_unpublish_node",
            "date" : { "select" : "node:created", "date_offset" : { "value" : 7776000 } },
            "identifier" : "Unpublish Job Post [node:nid] after 90 days.",
            "param_node" : [ "node" ]
          }
        },
        { "schedule" : {
            "component" : "rules_delete_node",
            "date" : { "select" : "node:created", "date_offset" : { "value" : 8640000 } },
            "identifier" : "Delete Job Post [node:nid] after 100 days.",
            "param_node" : [ "node" ]
          }
        }
      ]
    }
  }');
  $items['rules_unpublish_node'] = entity_import('rules_config', '{ "rules_unpublish_node" : {
      "LABEL" : "Unpublish Node",
      "PLUGIN" : "action set",
      "TAGS" : [ "content management" ],
      "REQUIRES" : [ "rules" ],
      "USES VARIABLES" : { "node" : { "label" : "Node", "type" : "node" } },
      "ACTION SET" : [ { "node_unpublish" : { "node" : [ "node" ] } } ]
    }
  }');
  return $items;
}
