import $ from 'jquery';
global.$ = global.jQuery = $;
require('./delete-notification');
require('./button-click-back');
require('./validate');
const logoPath = require('../images/logo-esalaire.jpg');

let html = `<img src="${logoPath}" alt="ACME logo">`;

 
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');
require('../scss/app.scss');
// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});


 