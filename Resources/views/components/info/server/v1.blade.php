Made with Laravel <b>{{ App()::VERSION }}</b>
php <b>{{ phpversion() }}</b>
Memory usage: <b>{{ $info->usage_nice }}</b> / <b>{{ $info->total_nice }}</b> <b>{{ $info->perc }}%</b>
@php
/*
xdebug_set_filter(
    XDEBUG_FILTER_TRACING, XDEBUG_PATH_EXCLUDE,
    [ __DIR__ . "/vendor/" ]
);
xdebug_print_function_stack();
*/
@endphp
