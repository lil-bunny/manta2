
function: php_syntax_check
docstring: This function checks the syntax of a PHP file and returns an error if there are any syntax errors.
purpose: The purpose of this functionality in software development is to ensure that PHP code is written correctly and does not contain any syntax errors, which can cause the code to malfunction or not run at all. This is an important step in the development process, as it helps to catch errors and bugs early on and ensures that the code is of high quality. It is especially useful for larger projects where multiple developers may be working on the same codebase. <?php
 function: sortable
  docstring: This function generates sortable links for specified columns in a table.
  purpose: The purpose of this functionality is to provide an easy way for developers to add sortable columns to their tables without having to write the code manually. This saves time and effort and improves the user experience for sorting data in a table.return [

    /*
    spec columns
    */
    'columns'                       => [
        'alpha'   => [
            'rows'  => ['description', 'email', 'name', 'slug'],
            'class' => 'fa fa-sort-alpha',
        ],
        'amount'  => [
            'rows'  => ['amount', 'price'],
            'class' => 'fa fa-sort-amount',
        ],
        'numeric' => [
            'rows'  => ['created_at', 'updated_at', 'level', 'id', 'phone_number'],
            'class' => 'fa fa-sort-numeric',
        ],
    ],

    /*
    whether icons should be enabled
     */
    'enable_icons'                  => true,

    /*
    defines icon set to use when sorted data is none above (alpha nor amount nor numeric)
     */
    'default_icon_set'              => 'fa fa-sort',

    /*
    icon that shows when generating sortable link while column is not sorted
     */
    'sortable_icon'                 => 'fa fa-sort',

    /*
    generated icon is clickable non-clickable (default)
     */
    'clickable_icon'                => false,

    /*
    icon and text separator (any string)
    in case of 'clickable_icon' => true; separator creates possibility to style icon and anchor-text properly
     */
    'icon_text_separator'           => ' ',

    /*
    suffix class that is appended when ascending direction is applied
     */
    'asc_suffix'                    => '-asc',

    /*
    suffix class that is appended when descending direction is applied
     */
    'desc_suffix'                   => '-desc',

    /*
    default anchor class, if value is null none is added
     */
    'anchor_class'                  => null,

    /*
    default active anchor class, if value is null none is added
     */
    'active_anchor_class'           => null,

    /*
    default sort direction anchor class, if value is null none is added
     */
    'direction_anchor_class_prefix' => null,

    /*
    relation - column separator ex: detail.phone_number means relation "detail" and column "phone_number"
     */
    'uri_relation_column_separator' => '.',

    /*
    formatting function applied to name of column, use null to turn formatting off
     */
    'formatting_function'           => 'ucfirst',

    /*
    apply formatting function to custom titles as well as column names
     */
    'format_custom_titles'          => true,

    /*
    inject title parameter in query strings, use null to turn injection off
    example: 'inject_title' => 't' will result in ..user/?t="formatted title of sorted column"
     */
    'inject_title_as'               => null,

    /*
    allow request modification, when default sorting is set but is not in URI (first load)
     */
    'allow_request_modification'    => true,

    /*
    default direction for: $user->sortable('id') usage
     */
    'default_direction'             => 'asc',

    /*
    default direction for non-sorted columns
     */
    'default_direction_unsorted'    => 'asc',

    /*
    use the first defined sortable column (Model::$sortable) as default
    also applies if sorting parameters are invalid for example: 'sort' => 'name', 'direction' => ''
     */
    'default_first_column'          => false,

    /*
    join type: join vs leftJoin (default leftJoin)
    for more information see https://github.com/Kyslik/column-sortable/issues/59
    */
    'join_type'                     => 'leftJoin',
];
