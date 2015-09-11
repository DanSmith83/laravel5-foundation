[![Build Status](https://travis-ci.org/DanSmith83/laravel5-foundation.svg)](https://travis-ci.org/DanSmith83/laravel5-foundation)

# laravel5-foundation

Create easy pagination and form elements based on the [Zurb Foundation](http://foundation.zurb.com) framework.

##Installation

Add to composer.json:

`"dansmith/laravel5-foundation": "0.3.*"`

This package comes with two service providers which should be added to the providers array in your config/app.php file:

* `'Foundation\FoundationServiceProvider',`
* `'Foundation\FoundationFormServiceProvider',`

Add the facade (Optional):

* `'Foundation' => 'Foundation\Facades\Foundation',`

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

## Forms

The form component extends the Illuminate Form Builder package, which means all of the regular methods are available as normal.

```
{!! Form::text('title', $page->title) !!}
```

The extension allows the creation of inputs which are nested inside of their labels, which removes the need to connect them using the for attribute.
The nested inputs follow the same naming conventions as the base inputs, with a prefix of 'wrapped'.
The only difference being that the label text is now specified as the second parameter.

```
{!! Form::wrappedText('title', 'Title', $page->title) !!}
```

If there are any validation errors which match the name of the specified input, an error class will be applied to both
the label and input elements and the first error found will be inserted into a small element (See the [Foundation documentation](http://foundation.zurb.com/docs/components/forms.html) for examples)


