(function (blocks, element, blockEditor, components) {

    var el = element.createElement;
    var RichText = blockEditor.RichText;
    var Button = components.Button;

    blocks.registerBlockType('chha/accordion', {

        title: 'CHHA Accordion',
        icon: 'list-view',
        category: 'widgets',

        attributes: {
            items: {
                type: 'array',
                default: []
            }
        },

        edit: function (props) {

            var items = props.attributes.items || [];

            function updateItem(index, field, value) {
                var newItems = items.slice();
                newItems[index][field] = value;
                props.setAttributes({ items: newItems });
            }

            function addItem() {
                props.setAttributes({
                    items: items.concat([{ title: '', content: '' }])
                });
            }

            function removeItem(index) {
                var newItems = items.slice();
                newItems.splice(index, 1);
                props.setAttributes({ items: newItems });
            }

            function moveItemUp(index) {
                if (index === 0) return;

                var newItems = items.slice();
                var temp = newItems[index - 1];
                newItems[index - 1] = newItems[index];
                newItems[index] = temp;

                props.setAttributes({ items: newItems });
            }

            function moveItemDown(index) {
                if (index === items.length - 1) return;

                var newItems = items.slice();
                var temp = newItems[index + 1];
                newItems[index + 1] = newItems[index];
                newItems[index] = temp;

                props.setAttributes({ items: newItems });
            }

            return el('div', {},

                items.map(function (item, index) {

                    return el('div', {
                        key: index,
                        style: {
                            border: '1px solid #ddd',
                            padding: '10px',
                            marginBottom: '10px'
                        }
                    },

                        // TITLE
                        el(RichText, {
                            tagName: 'h4',
                            placeholder: 'Accordion Title',
                            value: item.title,
                            onChange: function (val) {
                                updateItem(index, 'title', val);
                            }
                        }),

                        // CONTENT
                        el(RichText, {
                            tagName: 'p',
                            placeholder: 'Accordion Content',
                            value: item.content,
                            onChange: function (val) {
                                updateItem(index, 'content', val);
                            }
                        }),

                        // CONTROLS ROW
                        el('div', { style: { marginTop: '8px' } },

                            el(Button, {
                                onClick: function () { moveItemUp(index); },
                                style: { marginRight: '5px' }
                            }, '↑'),

                            el(Button, {
                                onClick: function () { moveItemDown(index); },
                                style: { marginRight: '5px' }
                            }, '↓'),

                            el(Button, {
                                isDestructive: true,
                                onClick: function () { removeItem(index); }
                            }, 'Remove')
                        )
                    );
                }),

                el(Button, {
                    variant: 'primary',
                    onClick: addItem
                }, 'Add Item')
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