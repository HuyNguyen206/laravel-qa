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
@endsection

