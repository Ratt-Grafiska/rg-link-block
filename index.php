<?php

/**
 * Plugin Name: RG Link Group Block
 * Description: A custom block for creating a linked group of innerblocks.
 * Version: 0.1.9
 * Author: Ratt Grafiska
 * Plugin URI: https://github.com/Ratt-Grafiska/rg-link-group-block
 * Update URI: https://github.com/Ratt-Grafiska/rg-link-group-block
 */

if (!defined("ABSPATH")) {
  exit(); // Skyddar mot direkt åtkomst
}

require_once plugin_dir_path(__FILE__) . "blocks/link-block/rg-link-block.php";
// require_once plugin_dir_path(__FILE__) . 'rg-git-updater.php';
