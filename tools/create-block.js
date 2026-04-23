const fs = require('fs-extra');
const path = require('path');

const blockName = process.argv[2];

if (!blockName) {
    console.log('❌ Please provide a block name');
    process.exit(1);
}

const basePath = path.join(__dirname, '..', 'blocks', blockName);

console.log(`🚀 Creating block: ${blockName}`);

// Create folder
fs.ensureDirSync(basePath);

// ---------------- block.json ----------------
const blockJson = {
    apiVersion: 2,
    name: `chha/${blockName}`,
    title: `CHHA ${blockName}`,
    category: "widgets",
    icon: "screenoptions",
    attributes: {
        items: {
            type: "array",
            default: []
        }
    }
};

fs.writeFileSync(
    path.join(basePath, 'block.json'),
    JSON.stringify(blockJson, null, 2)
);

// ---------------- index.js ----------------
const indexJs = `
(function (blocks, element, blockEditor, components) {

    const el = element.createElement;
    const RichText = blockEditor.RichText;
    const Button = components.Button;

    blocks.registerBlockType('chha/${blockName}', {

        title: 'CHHA ${blockName}',
        icon: 'list-view',
        category: 'widgets',

        attributes: {
            items: {
                type: 'array',
                default: []
            }
        },

        edit: function (props) {

            const items = props.attributes.items || [];

            function update(i, key, value) {
                const copy = [...items];
                if (!copy[i]) copy[i] = {};
                copy[i][key] = value;
                props.setAttributes({ items: copy });
            }

            function add() {
                props.setAttributes({
                    items: [...items, { title: '', content: '' }]
                });
            }

            function remove(i) {
                const copy = [...items];
                copy.splice(i, 1);
                props.setAttributes({ items: copy });
            }

            return el('div', {},

                items.map((item, i) =>
                    el('div', { key: i },

                        el(RichText, {
                            tagName: 'h4',
                            placeholder: 'Title',
                            value: item.title,
                            onChange: (v) => update(i, 'title', v)
                        }),

                        el(RichText, {
                            tagName: 'p',
                            placeholder: 'Content',
                            value: item.content,
                            onChange: (v) => update(i, 'content', v)
                        }),

                        el(Button, {
                            isDestructive: true,
                            onClick: () => remove(i)
                        }, 'Remove')
                    )
                ),

                el(Button, {
                    variant: 'primary',
                    onClick: add
                }, 'Add Item')
            );
        },

        save: () => null
    });

})(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor,
    window.wp.components
);
`;

fs.writeFileSync(path.join(basePath, 'index.js'), indexJs.trim());

// ---------------- render.php ----------------
const renderPhp = `<?php

$items = $attributes['items'] ?? [];

if (empty($items)) return;
?>

<div class="chha-${blockName}">
<?php foreach ($items as $item): ?>
    <div class="item">
        <h4><?php echo esc_html($item['title'] ?? ''); ?></h4>
        <p><?php echo esc_html($item['content'] ?? ''); ?></p>
    </div>
<?php endforeach; ?>
</div>
`;

fs.writeFileSync(path.join(basePath, 'render.php'), renderPhp);

console.log(`✅ Block "${blockName}" created`);