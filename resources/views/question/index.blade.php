@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Questions</div>

                    <div class="card-body">
                    @foreach ($questions as $q)
                        <h5>
                            <a href="{{$q->url}}">{{$q->title}}</a>
                        </h5>
                        <span>Asked by <b> <a href="{{ $q->user->url }}">{{ $q->user->name  }}</a></b></span>
                        <small class="text-muted">
                            {{$q->date_created}}
                        </small>
                        <p>
                            {{ \Illuminate\Support\Str::limit($q->body, 250) }}
                        </p>
                            <hr>
                    @endforeach
                    </div>
                </div>
            </div>

            <div class="col-12 text-center">
                    {!! $questions->links() !!}
            </div>

        </div>

    </div>
@endsection
@section('css')
    <style>
        .pagination
        {
            justify-content: center;
            margin-top: 20px;
        }
    </style>
@endsection
