@extends('layouts.app')
@section('content')
    <div class="jumbotron">
        <h1 class="display-4">Laravel Couchbase Demo</h1>
        <p class="lead">Want to use Couchbase with Laravel? This project demonstrates an approach to getting it done.</p>
        <hr class="my-4">
        <p>This project is open source. Find it on GitHub.</p>
        <a class="btn btn-primary btn-lg" href="https://github.com/fieldstonesoftware/laravel-couchbase-demo" role="button">GitHub</a>

        @if(null !== $systemKeyspaces)
            <div class="alert alert-success my-3 text-center">
                <p>Connected to Couchbase Successfully!</p>
                <h5>Buckets</h5>
                <ul style="list-style:none;">
                    @foreach($systemKeyspaces as $keyspace)
                        <li><b>Name:</b> {!! $keyspace['keyspaces']['name'] !!}
                            <b>Datastore ID:</b> <a target="_blank" href="{!! $keyspace['keyspaces']['datastore_id'] !!}">{!! $keyspace['keyspaces']['datastore_id'] !!}</a></li>
                    @endforeach
                </ul>
            </div>
        @else
            <p class="alert alert-danger my-3 text-center">Could NOT connect to Couchbase!</p>
        @endif
    </div>

    <h2 class="text-center">External Resources</h2>
    <div class="d-flex justify-content-center">
        <a class="d-inline-block ml-3" target="_blank" href="https://www.couchbase.com/">Couchbase</a>
        <a class="d-inline-block ml-3" target="_blank" href="https://laravel.com/">Laravel</a>
        <a class="d-inline-block ml-3" target="_blank" href="https://github.com/fieldstonesoftware/laravel-couchbase">Laravel Couchbase Extension</a>
        <a class="d-inline-block ml-3" target="_blank" href="https://getbootstrap.com/">Bootstrap (optional)</a>
    </div>

    <h2 class="text-center mt-4">Contributors</h2>
    <div class="d-flex justify-content-center">
        <span class="d-inline-block ml-3">JR Lawhorne <i>jr@fieldstone.io</i></span>
    </div>
    <p class="text-center"><a target="_blank" href="https://github.com/fieldstonesoftware/laravel-couchbase-demo">See GitHub</a> for a full list of contributors.</p>
@endsection
