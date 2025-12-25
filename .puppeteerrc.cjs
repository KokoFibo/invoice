// .puppeteerrc.cjs
const { join } = require("path");

/**
 * @type {import("puppeteer").Configuration}
 */
module.exports = {
    // Simpan binari browser di folder .cache dalam proyek
    cacheDirectory: join(__dirname, ".cache", "puppeteer"),
};
