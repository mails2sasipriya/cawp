const fs = require("fs-extra");
const path = require("path");

const root = __dirname;

// CA template source
const caSrc = path.join(root, "node_modules/@cagovweb/state-template/dist");

// Your custom source (IMPORTANT ADDITION)
const customSrc = path.join(root, "src/images");

// Output
const dest = path.join(root, "assets");

async function build() {
  try {
    console.log("Theme Root:", root);
    console.log("Copying CA State Template assets...");

    // Ensure folders exist
    await fs.ensureDir(dest + "/css");
    await fs.ensureDir(dest + "/js");
    await fs.ensureDir(dest + "/fonts");
    await fs.ensureDir(dest + "/images");

    // -----------------------------
    // 1. Copy CA template assets
    // -----------------------------
    await fs.copy(caSrc + "/css", dest + "/css", { overwrite: true });
    await fs.copy(caSrc + "/js", dest + "/js", { overwrite: true });
    await fs.copy(caSrc + "/fonts", dest + "/fonts", { overwrite: true });

    // -----------------------------
    // 2. Copy YOUR custom images
    // -----------------------------
    if (fs.existsSync(customSrc)) {
      console.log("Copying custom images from src/images → assets/images...");
      await fs.copy(customSrc, dest + "/images", { overwrite: true });
    } else {
      console.log("No custom src/images folder found");
    }

    console.log("✅ Assets copied into /assets");

  } catch (err) {
    console.error("❌ Copy failed:", err);
  }
}

build();