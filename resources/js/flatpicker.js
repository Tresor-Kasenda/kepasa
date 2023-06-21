import flatpickr from 'flatpickr';

flatpickr('#event_date', {
    minDate: 'today',
    dateFormat: 'Y-m-d',
});

flatpickr('#start_date', {
    enableTime: true,
    noCalendar: true,
    dateFormat: 'H:i',
    defaultDate: '00:00'
});

flatpickr('#end_date', {
    enableTime: true,
    noCalendar: true,
    dateFormat: 'H:i',
    defaultDate: '00:00'
});
