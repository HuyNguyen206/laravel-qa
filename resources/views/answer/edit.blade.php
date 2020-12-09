@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2>Edit Question</h2>
                            <a href="{{route('questions.index')}}" class="btn btn-outline-secondary"> Back to all questions</a>
                        </div>

                    </div>

                    <div class="card-body">
                        <form action="{{route('questions.answers.update', [$question->id, $answer->id])}}" method="post">
                            {{ method_field('patch') }}
                            @csrf
                            <div class="form-group">
                                <div>
                                    <span class="text-md-left"> Edit answer for question:</span>
                                    <span class="text-md-left"><b>{{$question->title}}</b></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="question-body">Content</label>
                                <textarea name="body" id="question-body" rows="5" class="form-control @error('body') is-invalid @enderror">{{old('body', $answer->body)}}</textarea>
                                @error('body')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-outline-primary btn-lg d-inline-block"> Update this answer</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection

