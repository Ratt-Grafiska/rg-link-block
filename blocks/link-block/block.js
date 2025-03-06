const { registerBlockType, createBlock } = wp.blocks;
const { InnerBlocks, InspectorControls } = wp.blockEditor;
const { PanelBody, TextControl } = wp.components;
const { __ } = wp.i18n;
const {__experimentalLinkControl: LinkControl} = wp.blockEditor;


registerBlockType("link/group-block", {
  title: __("Link Group Block", "link-group-block"),
  icon: "admin-links",
  category: "layout",
  attributes: {
    link: { type: "string", default: "" }
  },
  edit: function (props) {
    const { attributes, setAttributes } = props;

    return wp.element.createElement(
      "div",
      { className: "link-group-block-editor" },
      wp.element.createElement(
        InspectorControls,
        {},
        wp.element.createElement(
          PanelBody,
          { title: __("Link Settings", "link-group-block") },
          wp.element.createElement(TextControl, {
            label: __("URL", "link-group-block"),
            value: attributes.link,
            onChange: (newValue) => setAttributes({ link: newValue })
          })
        )
      ),
      wp.element.createElement(InnerBlocks)
    );
  },
  save: function () {
    return wp.element.createElement(InnerBlocks.Content);
  }
});