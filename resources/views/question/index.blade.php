@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <h2>Questions</h2>
                            @can('create', App\Question::class)
                            <a href="{{route('questions.create')}}" class="btn btn-outline-secondary"><i class="fas fa-plus-circle" title="Add Question"></i></a>
                            @endcan
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
                                        <div class="question-title d-flex align-items-center justify-content-between">
                                            <h5>
                                                <a href="{{$q->url}}">{{$q->title}}</a>
                                            </h5>
                                            <div class="btn-group">
                                                @can('update', $q)
                                                <a href="{{route('questions.edit', $q->id)}}" class="btn btn-outline-info btn-sm d-inline-block"> <i title="Edit question" class="far fa-edit"></i> </a>
                                                @endcan
                                                @can('delete', $q)
                                                    <form action="{{route('questions.destroy', $q->id)}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-danger d-inline-block btn-sm" onclick="return confirm('Are you sure?')"><i title="Delete question" class="fas fa-trash-alt"></i></button>
                                                </form>
                                                    @endcan
                                            </div>

                                        </div>

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

