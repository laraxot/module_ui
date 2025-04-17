@php
//*
xdebug_set_filter(
    XDEBUG_FILTER_TRACING,
    XDEBUG_PATH_EXCLUDE,
    [ __DIR__ . "/vendor/" ]
);
xdebug_print_function_stack();
//*/
@endphp