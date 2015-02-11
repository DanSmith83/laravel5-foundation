# laravel5-foundation
Zurb Foundation components for Laravel 5

At the moment, this just adds Foundation style pagination. I may add more at a later date.

##Installation

Add to composer.json:

`"dansmith/laravel5-foundation": "0.1.*"`

Add the service provider to the providers array in your config/app.php file:

`'Foundation\FoundationServiceProvider',`

Optionally, add the facade class to the aliases array in the same file:

`'Foundation' => 'Foundation\Facades\Foundation',`

## Pagination

Call the corresponding method on the facade depending on whether your collection is using simple or regular pagination.

```
{!! $users->render(Foundation::simplePaginate($users)) !!}
```

```
<div class="pagination-centered">
    {!! $users->render(Foundation::paginate($users)) !!}
</div>
```


