const { registerBlockType, createBlock } = wp.blocks;
const { createElement } = wp.element;
const { InnerBlocks } = wp.blockEditor;
const { __ } = wp.i18n;

registerBlockType("link/group-block", {
  title: __("Link Group Block", "link-group-block"),
  icon: "admin-links",
  category: "layout",
  attributes: {
    className: {
      type: "string",
      default: "",
    },
    extraClass: {
      type: "string",
      default: "",
    },
  },
  supports: {
    align: ["wide", "full"],
    anchor: true,
    html: false,
    color: {
      background: true,
      text: true,
      gradients: true,
    },
    spacing: {
      margin: true,
      padding: true,
    },
  },
  transforms: {
    from: [
      {
        type: "block",
        blocks: ["core/group"],
        transform: (attributes, innerBlocks) => {
          return createBlock("link/group-block", attributes, innerBlocks);
        },
      },
    ],
    to: [
      {
        type: "block",
        blocks: ["link/group-block"],
        transform: (attributes, innerBlocks) => {
          return createBlock("core/group", attributes, innerBlocks);
        },
      },
    ],
  },
  edit: function (props) {
    return createElement(
      "div",
      { className: props.className || "link-group-block-editor" },
      createElement(InnerBlocks)
    );
  },
  save: function () {
    return createElement(InnerBlocks.Content);
  },
});
