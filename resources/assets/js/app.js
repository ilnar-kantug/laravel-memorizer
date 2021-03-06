
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Cookies = require("js-cookie/src/js.cookie");
require("jquery-ui/ui/widgets/progressbar");
require("jquery-ui/themes/base/progressbar.css");

require('font-awesome/scss/font-awesome.scss');

window.toastr = require("toastr/toastr");
toastr.options.closeButton = true;
require("toastr/build/toastr.min.css");

require('./custom');
