<div class="pagination-centered">
    {!! $paginate->appends(Input::except('page'))->render(Foundation::paginate($paginate)) !!}
</div>