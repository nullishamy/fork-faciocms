const fs = require("fs")
const mix = require('laravel-mix')
const minifier = require('minifier');
const UglifyJS = require("uglify-js");

mix.sass("resources/scss/cms.scss", "public/core/styles/cms.css").sourceMaps()
mix.sass("versions/3.0.0/styles/admin.scss", "versions/3.0.0/styles/admin.css").sourceMaps()
mix.js("versions/3.0.0/scripts/admin.js", "versions/3.0.0/scripts/dist/admin.js").vue().sourceMaps()
mix.disableNotifications()

mix.then(() => {
    minifier.minify('public/core/styles/cms.css')
    minifier.minify('versions/3.0.0/styles/admin.css')

    const result = UglifyJS.minify(fs.readFileSync("versions/3.0.0/scripts/dist/admin.js", "utf8"), {
        compress: {
            dead_code: true,
            global_defs: {
                DEBUG: false
            }
        }
    });

    fs.writeFileSync("versions/3.0.0/scripts/dist/admin.js", result.code)
})