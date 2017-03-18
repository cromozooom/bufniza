# grunt-sitebuilder
[![Build Status](https://travis-ci.org/sloyless/grunt-sitebuilder.svg?branch=master)](https://travis-ci.org/sloyless/grunt-sitebuilder)
[![devDependency Status](https://david-dm.org/sloyless/grunt-sitebuilder/dev-status.svg?theme=shields.io)](https://david-dm.org/sloyless/grunt-sitebuilder#info=devDependencies)

A Sass/Jade/Coffeescript/Bootstrap site builder for Grunt

After any file save, the task runner will look for changes, compile the file from various formats (Sass, Coffee, Jade), and export to the build folder.

Uses BrowserSync to generate a local server.

* Sass files go in `source/styles/` and on save will run autoprefixer. In build mode the stylesheet is minified.
* Coffeescript files go in `source/scripts/` and on save will run JSLint. Minify/Uglify is disabled for Angular apps. 
* Vendor scripts (like Angular, jQuery, etc) go in the `source/scripts/vendor/` folder. 
* Jade files go in `source/templates/`
* Assets (images/fonts/svg/json) go in `source/content/`

There is also a `source/components/` folder for Angular/React/Meteor development of modules. Put any related Sass or Coffeescript files in their module directories for proper organization. Coffeescript files put here will be concatenated into the main JS file, and Sass files will be added to the main stylesheet (when included).

The `build` folder will be cleaned and all of the files recompiled upon launch of the task runner. This ensures the most up-to-date versions of all the files. The `.gitignore` file will prevent build files and node modules from being checked into source control.

## Vendor Files Included
The Grunt Sitebuilder also includes several popular scripts built-in:
* Bootstrap 3 (Sass version) is included in the styles folder. Add any other Bootstrap elements manually rather than including the entire Bootstrap stylesheet to keep the file size small.
* Angular v1.4.6 is loaded from the Google CDN in the footer
* jQuery v2.2.2 is loaded from the Google CDN in the footer (also available in the vendor folder in `scripts`)

## Global Requirements:
* Node (5+ recommended)
* Grunt
* BrowserSync

## Dev Setup
* `npm install`
* `grunt` (for normal watch/build)
* `grunt build` (for building/exporting only. Will not generate sourcemaps.)

## Updates (4/4/2016)
* Removed Compass
* Updated all npm modules
* Switched from Ruby Sass to Libsass
* Added Grunt Sync
* Added robots.txt
* Added components folder and readme.md for it
* Removed cssmin and Uglify from task runner
* Updated to jQuery v2.2.2