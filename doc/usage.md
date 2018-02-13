## Usage

### CRUD Command

```
php artisan crud:generate Posts --fields='title#string; content#text; category#select#options={"technology": "Technology", "tips": "Tips", "health": "Health"}' --view-path=admin --controller-namespace=Admin --route-group=admin --form-helper=html
```

#### CRUD fields from a JSON file:

```json
{
    "fields": [
        {
            "name": "title",
            "type": "string"
        },
        {
            "name": "content",
            "type": "text"
        },
        {
            "name": "category",
            "type": "select",
            "options": {
                "technology": "Technology",
                "tips": "Tips",
                "health": "Health"
            }
        },
        {
            "name": "user_id",
            "type": "integer#unsigned"
        }
    ],
    "foreign_keys": [
        {
            "column": "user_id",
            "references": "id",
            "on": "users",
            "onDelete": "cascade"
        }
    ],
    "relationships": [
        {
            "name": "user",
            "type": "belongsTo",
            "class": "App\\User"
        }
    ],
    "validations": [
        {
            "field": "title",
            "rules": "required|max:10"
        }
    ]
}
```

```
php artisan crud:generate Posts --fields_from_file="/path/to/fields.json" --view-path=admin --controller-namespace=Admin --route-group=admin --form-helper=html
```

### Other Commands

For controller:

```
php artisan crud:controller PostsController --crud-name=posts --model-name=Post --view-path="directory" --route-group=admin
```

For model:

```
php artisan crud:model Post --fillable="['title', 'body']"
```

For migration:

```
php artisan crud:migration posts --schema="title#string; body#text"
```

For view:

```
php artisan crud:view posts --fields="title#string; body#text" --view-path="directory" --route-group=admin --form-helper=html
```

By default, the generator will attempt to append the crud route to your ```Route``` file. If you don't want the route added, you can use this option ```--route=no```.

After creating all resources, run migrate command. *If necessary, include the route for your crud as well.*

```
php artisan migrate
```

If you chose not to add the crud route in automatically (see above), you will need to include the route manually.
```php
Route::resource('posts', 'PostsController');
```

### ACL (note: requires `uncgits/ccps-core` package)
If you wish to include ACL elements (Roles / Permissions, etc.) for your CRUD automatically, then you can just run `crud:generate` as-is and then `php artisan migrate`. 

The CCPS Core package is required at present because of the how the view and seeder stubs are set up. You may override these and try to use this in your own app if you want, but the `santigarcor/laratrust` is a requirement for any ACL items.

#### Recommended - use when generating new CRUD sets

It is recommended to simply allow `php artisan crud:generate` - your ACL items will be generated automatically, without any additional flags or options necessary.

It is also recommended, however, to use the `--acl-package` option to specify the name of your package (this helps identify the roles/permissions that belong to your package in the database).

#### Generating ACL items for existing models

If you wish to try and scaffold ACL items for an existing model, you may try to run:
```
php artisan crud:acl Posts my/package-name
```

This will run all three of the below commands to give you everything you need to apply ACL items, but you will miss out on the Controller and View generation based on the ACL (e.g. you will need to add `@permission` directives in your views, and you will need to add controller middleware to control access). 

To independently generate a Role seeder:
```
php artisan crud:role Posts my/package-name
```

To independently generate a Permission seeder:
```
php artisan crud:permission Posts my/package-name
```

To independently generate a Role seeder:
```
php artisan crud:role Posts my/package-name
```

#### Generating a CRUD set without ACL items

If you wish to skip the ACL items when generating your CRUD set, simply add `--acl=no` to the artisan command:

```
php artisan crud:generate Posts --fields='title#string; content#text; category#select#options={"technology": "Technology", "tips": "Tips", "health": "Health"}' --view-path=admin --controller-namespace=Admin --route-group=admin --form-helper=html --acl=no
```

### API Commands

For api crud:

```
php artisan crud:api Posts --fields='title#string; content#text' --controller-namespace=Api
```

For api controller:

```
php artisan crud:api-controller Api\\PostsController --crud-name=posts --model-name=Post
```

[&larr; Back to index](README.md)
