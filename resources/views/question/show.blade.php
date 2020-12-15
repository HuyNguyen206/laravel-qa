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
                                <vote type="question" vote-up-title="This question is useful" vote-down-title="This question is not useful" lower-model="question" upper-model="Question" :model="{{$question}}"></vote>

{{--                            <x-vote voteUpTitle="This question is useful" voteDownTitle="This question is not useful"--}}
{{--                            lowerModel="question" upperModel="Question" :model="$question"></x-vote>--}}

                                <favorite :question="{{ $question  }}"></favorite>
{{--                                @if(Auth::check())--}}
{{--                                    <a href="" title="CLick to mark as favorite question (Click again to undo)"  onclick="event.preventDefault(); document.getElementById('question-{{$question->id}}').submit()" class="favorite {{$question->status_favorite}}"><i class="fas fa-star fa-2x"></i></a>--}}
{{--                                    <span class="favorite-count {{$question->status_favorite}}">{{ $question->favorite_counts }}</span>--}}
{{--                                            <form action="/question/{{$question->id}}/favorite" method="post" id="question-{{$question->id}}">--}}
{{--                                                @csrf--}}
{{--                                                @if($question->is_favorite)--}}
{{--                                                    @method('delete')--}}
{{--                                                @endif--}}
{{--                                            </form>--}}
{{--                                    @else--}}
{{--                                    <a href="" style="pointer-events: none" class="favorite"><i class="fas fa-star fa-2x"></i></a>--}}
{{--                                    <span class="favorite-count">{{ $question->favorite_counts }}</span>--}}
{{--                                @endif--}}
                            </div>
                            <div class="media-body">
                                <h2>
                                    {{ $question->title }}
                                </h2>
                                <hr>
                                <div>
                                    {!! $question->body_html !!}
                                </div>
                            </div>
                        </div>
{{--                        <x-author :model="$question" label="Asked by"></x-author>--}}
                        <user-info :model="{{ $question }}" label="Asked by"></user-info>
                    </div>
                </div>
            </div>
        </div>
        @if($question->answers->count() > 0)
            <answers :question="{{$question}}"></answers>
{{--            @include('question.component._answers')--}}
        @endif
        @include('question.component._answers-input')
    </div>
@endsection

