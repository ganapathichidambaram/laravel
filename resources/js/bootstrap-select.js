
try {
    
    window.$ = window.jQuery = require('jquery');
    window.bootstrap = require('bootstrap');

    require('bootstrap-select');
    $('select').selectpicker();
} catch (e) {}
