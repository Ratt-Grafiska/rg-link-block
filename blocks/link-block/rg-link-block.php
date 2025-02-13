<?php

function register_custom_group_block() {
    wp_register_script(
        'custom-group-block-editor',
        plugins_url('block.js', __FILE__),
        array('wp-blocks', 'wp-editor', 'wp-element', 'wp-components', 'wp-i18n'),
        filemtime(plugin_dir_path(__FILE__) . 'block.js')
    );

    wp_register_style(
        'custom-group-block-editor-style',
        plugins_url('editor.css', __FILE__),
        array('wp-edit-blocks'),
        filemtime(plugin_dir_path(__FILE__) . 'editor.css')
    );

    wp_register_style(
        'custom-group-block-style',
        plugins_url('style.css', __FILE__),
        array(),
        filemtime(plugin_dir_path(__FILE__) . 'style.css')
    );

    register_block_type('custom/group-block', array(
        'editor_script' => 'custom-group-block-editor',
        'editor_style' => 'custom-group-block-editor-style',
        'style' => 'custom-group-block-style',
        'render_callback' => 'render_custom_group_block',
        'attributes' => array(
            'className' => array('type' => 'string', 'default' => ''),
            'extraClass' => array('type' => 'string', 'default' => 'wp-block-group'),
            'align' => array('type' => 'string'),
            'anchor' => array('type' => 'string'),
            'backgroundColor' => array('type' => 'string'),
            'textColor' => array('type' => 'string'),
            'gradient' => array('type' => 'string'),
            'style' => array('type' => 'object'),
        ),
        'supports' => array(
            'align' => ['wide', 'full'],
            'anchor' => true,
            'html' => false,
            'color' => array(
                'background' => true,
                'text' => true,
                'gradients' => true
            ),
            'spacing' => array(
                'margin' => true,
                'padding' => true
            ),
        ),
    ));
}
add_action('init', 'register_custom_group_block');

function render_custom_group_block($attributes, $content) {
    $extra_class = !empty($attributes['extraClass']) ? esc_attr($attributes['extraClass']) : '';
    $wrapper_attributes = get_block_wrapper_attributes(['class' => trim($extra_class)]);
    
    return '<a href="' . get_the_permalink(get_the_ID()) . '" ' . $wrapper_attributes . '>' . $content . '</a>';
}

function remove_html_links($innercontent) {
    return preg_replace('/<a[^>]*>(.*?)<\/a>/is', '$1', $innercontent);
}
