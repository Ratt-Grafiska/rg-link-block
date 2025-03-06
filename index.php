<?php

/**
 * Plugin Name: RG Link Block
 * Description: A custom block for creating a link to current or another page with optional URL.
 * Version: 0.2.2
 * Author: Ratt Grafiska
 * Plugin URI: https://github.com/Ratt-Grafiska/rg-link-block
 * Update URI: https://github.com/Ratt-Grafiska/rg-link-block
 */

if (!defined("ABSPATH")) {
  exit(); // Skyddar mot direkt åtkomst
}

require_once plugin_dir_path(__FILE__) . "blocks/link-block/rg-link-block.php";


// Initiera uppdateraren
if (!class_exists("RgGitUpdater")) {
  require_once plugin_dir_path(__FILE__) . "rg-git-updater.php";
}