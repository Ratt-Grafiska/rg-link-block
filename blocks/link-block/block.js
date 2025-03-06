const { registerBlockType, createBlock } = wp.blocks;
const { InnerBlocks, InspectorControls, PanelBody, TextControl, ToggleControl } = wp.blockEditor;
const { __ } = wp.i18n;
const { __experimentalLinkControl: LinkControl } = wp.blockEditor;

registerBlockType("link/group-block", {
  title: __("Link Group Block", "link-group-block"),
  icon: "admin-links",
  category: "layout",
  attributes: {
    link: { type: "string", default: "" },
    target: { type: "boolean", default: false } // Säkerställ att target alltid har ett standardvärde
  },
  edit: function (props) {
    const { attributes, setAttributes } = props;

    // Säkerställ att attributen alltid har ett giltigt värde
    const link = attributes.link || "";
    const target = typeof attributes.target === "boolean" ? attributes.target : false;

    console.log("Attributes debug:", attributes); // Debug-logg för att se om något är undefined

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
            value: link,
            onChange: (newValue) => setAttributes({ link: newValue })
          }),
          wp.element.createElement(ToggleControl, {
            label: __("Öppna i ny flik", "link-group-block"),
            checked: !!target, // Säkerställer att target aldrig blir undefined
            onChange: (newValue) => setAttributes({ target: newValue })
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