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
                        @include('components._message-feedback')
                        <div class="media">
                            <div class="vote-info d-flex flex-column align-items-center mr-4">
                                <a href="" title="This question is useful" class="vote-up"><i><i class="fas fa-caret-up fa-3x"></i></i></a>
                                <span class="votes-count">1234</span>
                                <a href="" title="This question is not useful" class="vote-down off"><i class="fas fa-caret-down fa-3x"></i></a>
                                <a href="" title="CLick to mark as favorite question (Click again to undo)" class="favorite favorited"><i class="fas fa-star fa-2x"></i></a>
                                <span class="favorite-count">123</span>
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
                        <div class="d-flex flex-column mr-4 float-right">
                            <span class="text-muted"> Asked by {{ $question->date_created }}</span>
                            <div class="answer-info d-flex align-items-center mt-2">
                                <a href="{{ $question->user->url }}" class="d-inline-block mr-2"> <img src="{{ $question->user->avatar }}" alt=""> </a>
                                <a href="{{ $question->user->url }}"> {{ $question->user->name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @include('question.component._answers')
        @include('question.component._answers-input')
    </div>
@endsection

