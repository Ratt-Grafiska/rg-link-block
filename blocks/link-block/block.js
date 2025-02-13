const { registerBlockType } = wp.blocks;
const { createElement } = wp.element;
const { InnerBlocks } = wp.blockEditor;
const { __ } = wp.i18n;

registerBlockType('custom/group-block', {
    title: __('Custom Group Block', 'custom-group-block'),
    icon: 'screenoptions',
    category: 'layout',
    attributes: {
        className: {
            type: 'string',
            default: ''
        }
    },
    supports: {
        align: ['wide', 'full'],
        anchor: true,
        html: false,
        color: {
            background: true,
            text: true,
            gradients: true
        },
        spacing: {
            margin: true,
            padding: true
        },
    },
    edit: function(props) {
        return createElement(
            'div',
            { className: props.className || 'custom-group-block-editor' },
            createElement(InnerBlocks)
        );
    },
    save: function() {
        return createElement(InnerBlocks.Content);
    }
});
