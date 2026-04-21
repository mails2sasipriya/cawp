const fs = require("fs-extra");
const path = require("path");

// Theme root (current folder)
const root = __dirname;

// Source inside node_modules (theme-level install)
const src = path.join(root, "node_modules/@cagovweb/state-template/dist");

// Output assets folder
const dest = path.join(root, "assets");

async function build() {
  try {
    console.log("Theme Root:", root);
    console.log("Copying CA State Template assets...");

    await fs.ensureDir(dest + "/css");
    await fs.ensureDir(dest + "/js");
    await fs.ensureDir(dest + "/fonts");
    await fs.ensureDir(dest + "/images");

    await fs.copy(src + "/css", dest + "/css", { overwrite: true });
    await fs.copy(src + "/js", dest + "/js", { overwrite: true });
    await fs.copy(src + "/fonts", dest + "/fonts", { overwrite: true });

    console.log("✅ Assets copied into /assets");
  } catch (err) {
    console.error("❌ Copy failed:", err);
  }
}

build();