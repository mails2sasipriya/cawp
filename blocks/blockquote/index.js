(function (blocks, element, blockEditor, components) {

    const el = element.createElement;
    const RichText = blockEditor.RichText;
    const SelectControl = components.SelectControl;

    blocks.registerBlockType('chha/blockquote', {

        title: 'CHHA Blockquote',
        icon: 'format-quote',
        category: 'widgets',

        attributes: {
            content: { type: 'string' },
            author: { type: 'string' },
            variant: { type: 'string', default: 'graphic' }
        },

        edit: function (props) {

            const { content, author, variant } = props.attributes;

            return el('div', {},

                el(SelectControl, {
                    label: 'Style',
                    value: variant,
                    options: [
                        { label: 'With Graphic', value: 'graphic' },
                        { label: 'No Graphic', value: 'no-graphic' }
                    ],
                    onChange: (val) => props.setAttributes({ variant: val })
                }),

                el(RichText, {
                    tagName: 'p',
                    placeholder: 'Quote text...',
                    value: content,
                    onChange: (val) => props.setAttributes({ content: val })
                }),

                el(RichText, {
                    tagName: 'footer',
                    placeholder: 'Author name...',
                    value: author,
                    onChange: (val) => props.setAttributes({ author: val })
                })
            );
        },

        save: function () {
            return null;
        }
    });

})(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor,
    window.wp.components
);