try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
    require('bigslide');
    require('owl.carousel');
    require('@fancyapps/fancybox');
    require('jquery-mask-plugin');
    require('lodash');
} catch (e) {}
