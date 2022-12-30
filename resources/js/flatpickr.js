
$(".datetime_flatpickr").flatpickr(
    {
        wrap: true,
        locale: 'it',
        //altInput: true,
        //altFormat: "F j, Y",
        dateFormat: "d/m/Y H:i",
        enableTime: true,
        time_24hr: true,

    }
);

$(".date_flatpickr").flatpickr(
    {
        wrap: true,
        locale: 'it',
        //altInput: true,
        //altFormat: "F j, Y",
        dateFormat: "d/m/Y",
        //enableTime: true,
        time_24hr: true,
    }
);

$(".time_flatpickr").flatpickr(
    {
        wrap: true,
        locale: 'it',
        //altInput: true,
        //altFormat: "F j, Y",
        dateFormat: "H:i",
        noCalendar: true,
        enableTime: true,
        time_24hr: true,
    }
);