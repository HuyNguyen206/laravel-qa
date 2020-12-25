<div class="media">
    <div class="question-info d-flex flex-column counters mr-5">
        <div class="votes">
            <b>
                {{$question->votes}}
            </b>
            {{ str_plural('vote', $question->votes )}}
        </div>
        <div class="answer mt-3 {{ $question->status}} ">
            <b>
                {{$question->answers_count}}
            </b>
            {{str_plural('answer', $question->answers_count )}}
        </div>
        <div class="view mt-2">
            {{$question->views . ' '. str_plural('view', $question->views )}}
        </div>

    </div>

    <div class="question media-body">
        <div class="question-title d-flex align-items-center justify-content-between">
            <h5>
                <a href="{{$question->url}}">{{$question->title}}</a>
            </h5>
            <div class="btn-group">
                @can('update', $question)
                    <a href="{{route('questions.edit', $question->id)}}" class="btn btn-outline-info btn-sm d-inline-block"> <i title="Edit question" class="far fa-edit"></i> </a>
                @endcan
                @can('delete', $question)
                    <form action="{{route('questions.destroy', $question->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-outline-danger d-inline-block btn-sm" onclick="return confirm('Are you sure?')"><i title="Delete question" class="fas fa-trash-alt"></i></button>
                    </form>
                @endcan
            </div>

        </div>

        <span>Asked by <b> <a
                    href="{{ $question->user->url }}">{{ $question->user->name  }}</a></b></span>
        <small class="text-muted">
            {{$question->date_created}}
        </small>
        <div class="mt-4">
            {!! str_limit($question->body_html, 250) !!}
        </div>
    </div>
</div>
