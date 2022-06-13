$(document).ready(function(){
    // starting parameters
    $('input[name="dates"]').daterangepicker({
    timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'DD-MMM-YYYY HH:mm'
    }
  });
});

