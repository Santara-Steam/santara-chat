"use strict";

$('.start-time').datetimepicker({
    format:'YYYY-MM-DD h:mm A',
    useCurrent: false,
    icons: {
        previous: 'icon-arrow-left icons',
        next: 'icon-arrow-right icons'
    },
    sideBySide: true,
    minDate: moment().subtract(1, 'days'),
    widgetPositioning: {
        horizontal: 'left',
        vertical: 'bottom'
    }
});

$('.members').select2({
    minimumResultsForSearch: -1,
    placeholder: "Select Members",
});

$('.time-zone').select2({
    placeholder: "Select Timezone",
});

$('#meetingForm').on('submit', function (event) {
    event.preventDefault();
    let loadingButton = jQuery(this).find('#btnSave');
    loadingButton.button('loading');

    $('#meetingForm')[0].submit();

    return true;
});
