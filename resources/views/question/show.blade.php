@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2>Question detail</h2>
                            <a href="{{route('questions.index')}}" class="btn btn-outline-secondary"> Back to all questions</a>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="media">
                            <div class="d-flex flex-column mr-4">
                                <span class="text-muted"> Asked by {{ $question->date_created }}</span>
                                <div class="answer-info d-flex align-items-center mt-2">
                                    <a href="{{ $question->user->url }}" class="d-inline-block mr-2"> <img src="{{ $question->user->avatar }}" alt=""> </a>
                                    <a href="{{ $question->user->url }}"> {{ $question->user->name }}</a>
                                </div>
                            </div>
                            <div class="media-body">
                                <h2>
                                    {{ $question->title }}
                                </h2>
                                <hr>
                                <p>
                                    {!! $question->body_html !!}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <hr>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>
                                {{$question->answers_count. ' '. str_plural('answer', $question->answers_count)}}
                            </h4>
                        </div>
                        <hr>
                        @foreach ($question->answers as $a)
                            <div class="media">
                                <div class="d-flex flex-column mr-4">
                                    <span class="text-muted"> Answered {{ $a->date_created }}</span>
                                    <div class="answer-info d-flex align-items-center mt-2">
                                        <a href="{{ $a->user->url }}" class="d-inline-block mr-2"> <img src="{{ $a->user->avatar }}" alt=""> </a>
                                        <a href="{{ $a->user->url }}"> {{ $a->user->name }}</a>
                                    </div>
                                </div>

                                <div class="media-body">
                                    <p>
                                        {!!  $a->body_html !!}
                                    </p>
                                </div>
                            </div>

                            <hr>
                        @endforeach

                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection

