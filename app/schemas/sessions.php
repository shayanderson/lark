<?php
/**
 * Schema file for "sessions"
 *
 * WARNING: this file is auto-generated by Lark Console. Do not modify.
 * Any modifications should be made in the schema template file:
 * "templates/schema.sessions.json"
 */
return array (
  '$index' => 
  (object) array(
     'access' => 1,
     '$name' => 'idxAccess',
  ),
  '_id' => 
  array (
    0 => 'string',
    1 => 'id',
  ),
  'data' => NULL,
  'access' => 
  array (
    0 => 'dbdatetime',
    1 => 'notNull',
  ),
);
