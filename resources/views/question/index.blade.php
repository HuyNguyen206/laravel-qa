@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2>Questions</h2>
                            <a href="{{route('questions.create')}}" class="btn btn-outline-secondary"> Add question</a>
                        </div>

                    </div>

                    <div class="card-body">
                        @include('components._message-feedback')
                        @foreach ($questions as $q)
                            <div class="media ">
                                    <div class="question-info d-flex flex-column counters mr-5">
                                        <div class="votes">
                                            <b>
                                                {{$q->votes}}
                                            </b>
                                            {{ str_plural('vote', $q->votes )}}
                                        </div>
                                        <div class="answer mt-3 {{ $q->status}} ">
                                            <b>
                                                {{$q->answers}}
                                            </b>
                                            {{str_plural('answer', $q->answers )}}
                                        </div>
                                        <div class="view mt-2">
                                            {{$q->views . ' '. str_plural('view', $q->views )}}
                                        </div>

                                    </div>

                                    <div class="question media-body">
                                        <h5>
                                            <a href="{{$q->url}}">{{$q->title}}</a>
                                        </h5>
                                        <span>Asked by <b> <a
                                                    href="{{ $q->user->url }}">{{ $q->user->name  }}</a></b></span>
                                        <small class="text-muted">
                                            {{$q->date_created}}
                                        </small>
                                        <p class="mt-4">
                                            {{ \Illuminate\Support\Str::limit($q->body, 250) }}
                                        </p>
                                    </div>
                            </div>


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

