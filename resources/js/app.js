require('./bootstrap');
require('bootstrap-datepicker');

$('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    startDate: '-3d'
});
