## Options

### CRUD Options:

| Option    | Description |
| ---       | ---     |
| `--fields` | The field names for the form. e.g. ```--fields='title#string; content#text; category#select#options={"technology": "Technology", "tips": "Tips", "health": "Health"}; user_id#integer#unsigned'``` |
| `--fields_from_file` | Fields from a JSON file. e.g. `--fields_from_file="/path/to/fields.json"` |
| `--validations` | Validation rules for the fields "col_name#rules_set" e.g. ` "title#min:10|max:30|required" ` - See https://laravel.com/docs/master/validation#available-validation-rules |
| `--controller-namespace` | The namespace of the controller - sub directories will be created |
| `--model-namespace` | The namespace that the model will be placed in - directories will be created |
| `--pk` | The name of the primary key |
| `--pagination` | The amount of models per page for index pages |
| `--indexes` | The fields to add an index to. append "#unique" to a field name to add a unique index. Create composite fields by separating fieldnames with a pipe (` --indexes="title,field1|field2#unique" ` will create normal index on title, and unique composite on fld1 and fld2) |
| `--foreign-keys` | Any foreign keys for the table. e.g. `--foreign-keys="user_id#id#users#cascade"` where user_id is the column name, id is the name of the field on the foreign table, users is the name of the foreign table, and cascade is the operation 'ON DELETE' together with 'ON UPDATE' |
| `--relationships` | The relationships for the model. e.g. `--relationships="comments#hasMany#App\Comment"` in the format |
| `--route` | Include Crud route to routes.php? yes or no |
| `--route-group` | Prefix of the route group |
| `--view-path` | The name of the view path |
| `--form-helper` | Helper for the form. eg. `--form-helper=html`, `--form-helper=laravelcollective` |
| `--localize` | Allow to localize. e.g. localize=yes  |
| `--locales`  | Locales language type. e.g. locals=en |
| `--soft-deletes` | Include soft deletes fields. eg. `--soft-deletes=yes` |
| `--acl` | Include ACL elements (Roles / Permissions). Default 'yes' - change to 'no' to exclude, eg. `--acl=no` |
| `--acl-package` | If generating ACL elements, inserts this name into DB with associated roles/permissions. e.g. `--acl-package=my/pkg` |
| `--acl-admin-role` | Default 'yes'. Change if you do not use a Role with key 'admin' in your app, e.g. `--acl-admin-role=no` |
| `--roles` | Supply your own Roles for the Seeder. Supply an array of arrays: `[['name'=>'products.viewer, 'display_name'=>'Products - Viewer', 'description'=>'Can view Products']]` |
| `--permissions` | Supply your own Permissions for the Seeder. Supply an array of arrays: `[['name'=>'products.create, 'display_name'=>'Products - Create', 'description'=>'Create Products']]`
| `--auditing` | Implement Model Auditing (`owen-it/laravel-auditing` package) eg. `--soft-deletes=yes` - default is yes |


### Controller Options:

| Option    | Description |
| ---       | ---     |
| `--crud-name` | The name of the crud. e.g. ```--crud-name="post"``` |
| `--model-name` | The name of the model. e.g. ```--model-name="Post"``` |
| `--model-namespace` | The namespace of the model. e.g. ```--model-namespace="Custom\Namespace\Post"``` |
| `--controller-namespace` | The namespace of the controller. e.g. ```--controller-namespace="Http\Controllers\Client"``` |
| `--view-path` | The name of the view path |
| `--fields` | The field names for the form. e.g. ```--fields='title#string; content#text; category#select#options={"technology": "Technology", "tips": "Tips", "health": "Health"}; user_id#integer#unsigned'``` |
| `--validations` | Validation rules for the fields "col_name#rules_set" e.g. ``` "title#min:10|max:30|required" ``` - See https://laravel.com/docs/master/validation#available-validation-rules |
| `--route-group` | Prefix of the route group |
| `--pagination` | The amount of models per page for index pages |
| `--acl` | Include ACL middleware in the constructor. Default 'yes' - change to 'no' to exclude, eg. `--acl=no` |
| `--force` | Overwrite already existing controller. |

### View Options:

| Option    | Description |
| ---       | ---     |
| `--fields` | The field names for the form. e.g. ```--fields='title#string; content#text; category#select#options={"technology": "Technology", "tips": "Tips", "health": "Health"}; user_id#integer#unsigned'``` |
| `--view-path` | The name of the view path |
| `--route-group` | Prefix of the route group |
| `--pk` | The name of the primary key |
| `--validations` | Validation rules for the form "col_name#rules_set" e.g. ``` "title#min:10|max:30|required" ``` - See https://laravel.com/docs/master/validation#available-validation-rules |
| `--form-helper` | Helper for the form. eg. `--form-helper=html`, `--form-helper=laravelcollective` |
| `--custom-data` | Some additional values to use in the crud. |
| `--localize` | Allow to localize. e.g. localize=yes  |
| `--acl` | Include ACL Blade directives - wraps buttons in `@permission()` directives to conform to ACL. Default 'yes' - change to 'no' to exclude, eg. `--acl=no` |

### Model Options:

| Option    | Description |
| ---       | ---     |
| `--table` | The name of the table |
| `--fillable` | The name of the view path |
| `--relationships` | The relationships for the model. e.g. `--relationships="comments#hasMany#App\Comment"` in the format |
| `--pk` | The name of the primary key |
| `--soft-deletes` | Include soft deletes fields. eg. `--soft-deletes=yes` |
| `--auditing` | Implement Model Auditing (`owen-it/laravel-auditing` package) eg. `--soft-deletes=yes` - default is yes |

### Migration Options:

| Option    | Description |
| ---       | ---     |
| `--schema` | The name of the schema |
| `--indexes` | The fields to add an index to. append "#unique" to a field name to add a unique index. Create composite fields by separating fieldnames with a pipe (` --indexes="title,field1|field2#unique" ` will create normal index on title, and unique composite on fld1 and fld2) |
| `--foreign-keys` | Any foreign keys for the table. e.g. `--foreign-keys="user_id#id#users#cascade"` where user_id is the column name, id is the name of the field on the foreign table, users is the name of the foreign table, and cascade is the operation 'ON DELETE' together with 'ON UPDATE' |
| `--pk` | The name of the primary key |
| `--soft-deletes` | Include soft deletes fields. eg. `--soft-deletes=yes` |

### Lang Options:

| Option    | Description |
| ---       | ---     |
| `--fields` | The field names for the form. e.g. ```--fields='title#string; content#text``` |
| `--locales`  | Locales language type. e.g. locals=en |

### API CRUD Options:

| Option    | Description |
| ---       | ---     |
| `--fields` | The field names for the form. e.g. ```--fields='title#string; content#text; category#select#options={"technology": "Technology", "tips": "Tips", "health": "Health"}; user_id#integer#unsigned'``` |
| `--fields_from_file` | Fields from a JSON file. e.g. `--fields_from_file="/path/to/fields.json"` |
| `--validations` | Validation rules for the fields "col_name#rules_set" e.g. ` "title#min:10|max:30|required" ` - See https://laravel.com/docs/master/validation#available-validation-rules |
| `--controller-namespace` | The namespace of the controller - sub directories will be created |
| `--model-namespace` | The namespace that the model will be placed in - directories will be created |
| `--pk` | The name of the primary key |
| `--pagination` | The amount of models per page for index pages |
| `--indexes` | The fields to add an index to. append "#unique" to a field name to add a unique index. Create composite fields by separating fieldnames with a pipe (` --indexes="title,field1|field2#unique" ` will create normal index on title, and unique composite on fld1 and fld2) |
| `--foreign-keys` | Any foreign keys for the table. e.g. `--foreign-keys="user_id#id#users#cascade"` where user_id is the column name, id is the name of the field on the foreign table, users is the name of the foreign table, and cascade is the operation 'ON DELETE' together with 'ON UPDATE' |
| `--relationships` | The relationships for the model. e.g. `--relationships="comments#hasMany#App\Comment"` in the format |
| `--route` | Include Crud route to routes.php? yes or no |
| `--route-group` | Prefix of the route group |
| `--soft-deletes` | Include soft deletes fields. eg. `--soft-deletes=yes` |

### API Controller Options:

| Option    | Description |
| ---       | ---     |
| `--crud-name` | The name of the crud. e.g. ```--crud-name="post"``` |
| `--model-name` | The name of the model. e.g. ```--model-name="Post"``` |
| `--model-namespace` | The namespace of the model. e.g. ```--model-namespace="Custom\Namespace\Post"``` |
| `--controller-namespace` | The namespace of the controller. e.g. ```--controller-namespace="Http\Controllers\Client"``` |
| `--validations` | Validation rules for the fields "col_name#rules_set" e.g. ``` "title#min:10|max:30|required" ``` - See https://laravel.com/docs/master/validation#available-validation-rules |
| `--pagination` | The amount of models per page for index pages |
| `--force` | Overwrite already existing controller. |

### ACL Options:

`php artisan crud:acl` - a wrapper for `crud:role`, `crud:permission`, and `crud:acl-migration`

| Option    | Description |
| ---       | ---     |
| `--roles` | Supply your own Roles for the Seeder. Supply an array of arrays: `[['name'=>'products.viewer, 'display_name'=>'Products - Viewer', 'description'=>'Can view Products']]` |
| `--permissions` | Supply your own Permissions for the Seeder. Supply an array of arrays: `[['name'=>'products.create, 'display_name'=>'Products - Create', 'description'=>'Create Products']]`
| `--admin-role` | Default 'yes'. Change if you do not use a Role with key 'admin' in your app, e.g. `--acl-admin-role=no` |

### Role Options:

`php artisan crud:role` - Generates a Role Seeder

| Option    | Description |
| ---       | ---     |
| `--roles` | Supply your own Roles for the Seeder. Supply an array of arrays: `[['name'=>'products.viewer, 'display_name'=>'Products - Viewer', 'description'=>'Can view Products']]` |

### Permission Options:

`php artisan crud:permission` - Generates a Permission Seeder

| Option    | Description |
| ---       | ---     |
| `--permissions` | Supply your own Permissions for the Seeder. Supply an array of arrays: `[['name'=>'products.create, 'display_name'=>'Products - Create', 'description'=>'Create Products']]`

### ACL Migration Options:

`php artisan crud:acl-migration` - creates a database migration that applies the Role and Permission seeders and associates Permissions to Roles according to the bindings specified.

| Option    | Description |
| ---       | ---     |
| `--bindings` | Supply your own Bindings for the Seeder. Supply an array of permissions keyed by role: `['admin'=>['products.create','products.read','products.update','products.delete']]`
| `--admin-role` | Default 'yes'. Applies Permissions from the seeder class to the 'admin' role automatically. Change to 'no' if you do not use a Role with key 'admin' in your app, e.g. `--acl-admin-role=no` |

[&larr; Back to index](README.md)