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
                                <a href="" title="This question is useful" class="vote-up on"><i><i class="fas fa-caret-up fa-3x"></i></i></a>
                                <span class="votes-count">1234</span>
                                <a href="" title="This question is not useful" class="vote-down"><i class="fas fa-caret-down fa-3x"></i></a>
                                @if(Auth::check())
                                    <a href="" title="CLick to mark as favorite question (Click again to undo)"  onclick="event.preventDefault(); document.getElementById('question-{{$question->id}}').submit()" class="favorite {{$question->status_favorite}}"><i class="fas fa-star fa-2x"></i></a>
                                    <span class="favorite-count {{$question->status_favorite}}">{{ $question->favorite_counts }}</span>
                                            <form action="/question/{{$question->id}}/favorite" method="post" id="question-{{$question->id}}">
                                                @csrf
                                                @if($question->is_favorite)
                                                    @method('delete')
                                                @endif
                                            </form>
                                    @else
                                    <a href="" style="pointer-events: none" class="favorite"><i class="fas fa-star fa-2x"></i></a>
                                    <span class="favorite-count">{{ $question->favorite_counts }}</span>
                                @endif
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

