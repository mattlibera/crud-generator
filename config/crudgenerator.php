<?php

return [

    'custom_template' => false,

    /*
    |--------------------------------------------------------------------------
    | Crud Generator Template Stubs Storage Path
    |--------------------------------------------------------------------------
    |
    | Here you can specify your custom template path for the generator.
    |
     */

    'path' => base_path('resources/crud-generator/'),

    /**
     * Columns number to show in view's table.
     */
    'view_columns_number' => 9999,

    /**
     * Delimiter for template vars
     */
    'custom_delimiter' => ['%%', '%%'],

    /**
     * (optional) Hash work factor options array (will be passed as second argument to the Hash:: facade for password items).
     * Example (for argon2):
     * [
     *   'memory' => 1024,
     *   'time' => 2,
     *   'threads' => 2,
     * ]
     */
    'hash_work_factor' => null,

    /*
    |--------------------------------------------------------------------------
    | Dynamic templating
    |--------------------------------------------------------------------------
    |
    | Here you can specify your customs templates for the generator.
    | You can set new templates or delete some templates if you do not want them.
    | You can also choose which values are passed to the views and you can specify a custom delimiter for all templates
    |
    | Those values are available :
    |
    | formFields
    | formFieldsHtml
    | varName
    | crudName
    | crudNameCap
    | crudNameSingular
    | primaryKey
    | modelName
    | modelNameCap
    | viewName
    | routePrefix
    | routePrefixCap
    | routeGroup
    | routeNamePrefix
    | formHeadingHtml
    | formBodyHtml
    | aclPermissionCreate
    | aclPermissionRead
    | aclPermissionUpdate
    | aclPermissionDelete
    | aclEndPermission
    |
    |
     */
    'dynamic_view_template' => [
        'index' => ['formHeadingHtml', 'formBodyHtml', 'crudName', 'crudNameCap', 'modelName', 'viewName', 'routeGroup', 'routeNamePrefix', 'primaryKey', 'aclPermissionCreate', 'aclPermissionRead', 'aclPermissionUpdate', 'aclPermissionDelete', 'aclEndPermission'],
        'form' => ['formFieldsHtml'],
        'create' => ['crudName', 'crudNameCap', 'modelName', 'modelNameCap', 'viewName', 'routeGroup', 'routeNamePrefix', 'viewTemplateDir'],
        'edit' => ['crudName', 'crudNameSingular', 'crudNameCap', 'modelNameCap', 'modelName', 'viewName', 'routeGroup', 'routeNamePrefix', 'primaryKey', 'viewTemplateDir'],
        'show' => ['formHeadingHtml', 'formBodyHtml', 'formBodyHtmlForShowView', 'crudName', 'crudNameSingular', 'crudNameCap', 'modelName', 'viewName', 'routeGroup', 'routeNamePrefix', 'primaryKey', 'aclPermissionCreate', 'aclPermissionRead', 'aclPermissionUpdate', 'aclPermissionDelete', 'aclEndPermission'],
        /*
         * Add new stubs templates here if you need to, like action, datatable...
         * custom_template needs to be activated for this to work
         */
    ]


];
