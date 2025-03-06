<?php

function register_link_group_block()
{
  wp_register_script(
    "link-group-block-editor",
    plugins_url("block.js", __FILE__),
    ["wp-blocks", "wp-editor", "wp-element", "wp-components", "wp-i18n"],
    filemtime(plugin_dir_path(__FILE__) . "block.js")
  );

  wp_register_style(
    "link-group-block-editor-style",
    plugins_url("editor.css", __FILE__),
    ["wp-edit-blocks"],
    filemtime(plugin_dir_path(__FILE__) . "editor.css")
  );

  wp_register_style(
    "link-group-block-style",
    plugins_url("style.css", __FILE__),
    [],
    filemtime(plugin_dir_path(__FILE__) . "style.css")
  );

  register_block_type("link/group-block", [
    "editor_script" => "link-group-block-editor",
    "editor_style" => "link-group-block-editor-style",
    "style" => "link-group-block-style",
    "render_callback" => "render_link_group_block",
    "attributes" => [
      "className" => ["type" => "string", "default" => ""],
      "extraClass" => ["type" => "string", "default" => "wp-block-group"],
      "align" => ["type" => "string"],
      "anchor" => ["type" => "string"],
      "backgroundColor" => ["type" => "string"],
      "textColor" => ["type" => "string"],
      "gradient" => ["type" => "string"],
      "style" => ["type" => "object"],
      "link" => ["type" => "string", "default" => ""],
      "target" => ["type" => "boolean", "default" => false],
    ],
    "supports" => [
      "align" => ["wide", "full"],
      "anchor" => true,
      "html" => false,
      "color" => [
        "background" => true,
        "text" => true,
        "gradients" => true,
      ],
      "spacing" => [
        "margin" => true,
        "padding" => true,
      ],
    ],
  ]);
}
add_action("init", "register_link_group_block");

function render_link_group_block($attributes, $content)
{
  $content = remove_html_links($content);
  $extra_class = !empty($attributes["extraClass"])
    ? esc_attr($attributes["extraClass"])
    : "";
  $wrapper_attributes = get_block_wrapper_attributes([
    "class" => trim($extra_class) . " link-group ",
  ]);
  // Säkerställ att link-attributet är satt och är en sträng
  $link = isset($attributes["link"]) ? esc_url($attributes["link"]) : "";
  $target = isset($attributes["target"]) && $attributes["target"] ? ' target="_blank" rel="noopener noreferrer"' : '';
  
  // Om en länk är satt, gör hela blocket till en <a>-tagg
  if (!empty($link)) {
    return '<a href="' . $link . '" ' . $target . ' ' . $wrapper_attributes . '>' . $content . '</a>';
  } else {
    return '<a href="' . get_the_permalink(get_the_ID()) . '" ' . $target . ' ' . $wrapper_attributes . '>' . $content . '</a>';
  }
}

function remove_html_links($innercontent)
{
  return preg_replace("/<a[^>]*>(.*?)<\/a>/is", '$1', $innercontent);
}
