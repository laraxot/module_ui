<?php

declare(strict_types=1);

return [
    // 'Getting Started' => [
    //     'url' => 'docs/getting-started',
    //     'children' => [
    //         'Customizing Your Site' => 'docs/customizing-your-site',
    //         'Navigation' => 'docs/navigation',
    //         'Algolia DocSearch' => 'docs/algolia-docsearch',
    //         'Custom 404 Page' => 'docs/custom-404-page',
    //         'Other Page' => 'docs/other-page',
    //         'Other Page 2' => 'docs/other-page-2',
    //     ],
    // ],
    // 'Other Section' => [
    //     'url' => 'docs/other-section',
    // ],
    // 'Jigsaw Docs' => 'https://jigsaw.tighten.co/docs/installation',
    'Introduction' => [
        'url' => 'docs/introduction',
    ],
    'Getting Started' => [
        'url' => 'docs/installation',
        'children' => [
            'Installation' => 'docs/installation',
            'Basic Theme Installation' => 'docs/basic-theme-installation',
        ],
    ],
    'Utilizzo base' => [
        'url' => 'docs/basic-usage',
    ],

    'Input Group vs Input' => [
        'url' => 'docs/input-group-vs-input',
    ],

    'Componenti Input Group' => [
        'url' => 'docs/components-input-group',
        'children' => [
            'Text' => 'docs/components/text',
            'Textarea' => 'docs/components/textarea',
            'Integer' => 'docs/components/integer',
            'Select' => 'docs/components/select',
            'Checkbox' => 'docs/components/checkbox',
            'Radio' => 'docs/components/radio',
            'Email' => 'docs/components/email',
            'Password' => 'docs/components/password',
        ],
    ],
    'Componenti Blade' => [
        'url' => 'docs/blade-components',
        'children' => [
            'Accordion' => 'docs/blade_components/accordion',
            'Card' => 'docs/blade_components/card',
            'Button' => 'docs/blade_components/button',
            'Breadcrumb' => 'docs/blade_components/breadcrumb',
        ],
    ],
    'Componenti Livewire' => [
        'url' => 'docs/livewire_components',
        'children' => [
            'Calendar' => [
                'url' => '#',
                'children' => [
                    'V2' => 'docs/livewire_components/calendar/v2',
                ],
            ],
            'Card' => [
                'url' => '#',
                'children' => [
                    'poster' => [
                        'url' => '#',
                        'children' => [
                            'result' => [
                                'url' => '#',
                                'children' => [
                                    'txt' => 'docs/livewire_components/card/poster/result/txt',
                                ],
                            ],
                        ],
                    ],
                    'result' => [
                        'url' => '#',
                        'children' => [
                            'panel' => 'docs/livewire_components/card/result/panel',
                        ],
                    ],
                ],
            ],
            'Crud' => [
                'url' => '#',
                'children' => [
                    'Create' => 'docs/livewire_components/crud/create',
                ],
            ],
            'Datagrid' => [
                'url' => '#',
                'children' => [
                    'Intro' => 'docs/livewire_components/datagrid/intro',
                    'Head' => 'docs/livewire_components/datagrid/head',
                    'Row' => 'docs/livewire_components/datagrid/row',
                    'V1' => 'docs/livewire_components/datagrid/v1',
                ],
            ],
            'Elastic' => [
                'url' => '#',
                'children' => [
                    'Filter' => 'docs/livewire_components/elastic/filter',
                ],
            ],
            'Form' => [
                'url' => '#',
                'children' => [
                    'Builder' => 'docs/livewire_components/form/builder',
                    'Get' => 'docs/livewire_components/form/get',
                ],
            ],
            'FullCalendar' => [
                'url' => '#',
                'children' => [
                    'BaseV2' => 'docs/livewire_components/full_calendar/base_v2',
                    'Event' => 'docs/livewire_components/full_calendar/event',
                    'V1' => 'docs/livewire_components/full_calendar/v1',
                    'V2' => 'docs/livewire_components/full_calendar/v2',
                ],
            ],
            'Import' => [
                'url' => '#',
                'children' => [
                    'Xls' => [
                        'url' => '#',
                        'children' => [
                            'Model' => 'docs/livewire_components/import/xls/model',
                        ],
                    ],
                ],
            ],
            'Input' => [
                'url' => '#',
                'children' => [
                    'Group' => [
                        'url' => '#',
                        'children' => [
                            'Arr' => 'docs/livewire_components/input/group/arr',
                        ],
                    ],
                    'Status' => [
                        'url' => '#',
                        'children' => [
                            'Select' => [
                                'url' => '#',
                                'children' => [
                                    'Single' => 'docs/livewire_components/input/status/select/single',
                                ],
                            ],
                        ],
                    ],
                    'StringList' => [
                        'url' => '#',
                        'children' => [
                            'Color' => 'docs/livewire_components/string_list/color',
                        ],
                    ],
                    'Arr' => 'docs/livewire_components/input/arr',
                    'ArrTwo' => 'docs/livewire_components/input/arr_two',
                    'Slider' => 'docs/livewire_components/input/slider',
                    'ToggleDate' => 'docs/livewire_components/input/toggle-date',
                ],
            ],
            'Menu' => [
                'url' => '#',
                'children' => [
                    'Builder' => 'docs/livewire_components/menu/builder',
                ],
            ],
        ],
    ],
];
