const fs = require("fs")
const mix = require('laravel-mix')
const minifier = require('minifier');
const UglifyJS = require("uglify-js");
const VERSION = "3.0.1"

mix.sass("resources/scss/cms.scss", "public/core/styles/cms.css").sourceMaps()
mix.sass("versions/" + VERSION + "/styles/admin.scss", "versions/" + VERSION + "/styles/admin.css").sourceMaps()
mix.js("versions/" + VERSION + "/scripts/admin.js", "versions/" + VERSION + "/scripts/dist/admin.js").vue().sourceMaps()
mix.disableNotifications()

mix.then(() => {
    minifier.minify('public/core/styles/cms.css')
    minifier.minify("versions/" + VERSION + "/styles/admin.css")

    const result = UglifyJS.minify(fs.readFileSync("versions/" + VERSION + "/scripts/dist/admin.js", "utf8"), {
        compress: {
            dead_code: true,
            global_defs: {
                DEBUG: false
            }
        }
    });

    fs.writeFileSync("versions/" + VERSION + "/scripts/dist/admin.js", result.code)
})