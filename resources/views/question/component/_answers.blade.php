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
                        <div class="vote-info d-flex flex-column align-items-center mr-4">
                            <a href="" title="This answer is useful" class="vote-up {{$a->vote_up_status}}"
                               onclick="event.preventDefault(); @can('voteUpAnswer', $a) document.getElementById('vote-up-answer-{{$a->id}}').submit()@endcan "><i><i
                                        class="fas fa-caret-up fa-3x"></i></i></a>
                            @can('voteUpAnswer', $a)
                                <form action="{{route('answer.vote', $a->id)}}" method="post" class="d-none"  id="vote-up-answer-{{$a->id}}">
                                    @csrf
                                    <input type="hidden" name="vote" value="1">
                                </form>
                            @endcan

                            <span class="votes-count">{{$a->votes_count}}</span>

                            <a href="" title="This answer is not useful" class="vote-down {{$a->vote_down_status}}"
                               onclick="event.preventDefault(); @can('voteDownAnswer', $a) document.getElementById('vote-down-answer-{{$a->id}}').submit()@endcan "><i
                                    class="fas fa-caret-down fa-3x"></i></a>
                            @can('voteDownAnswer', $a)
                                <form action="{{route('answer.vote', $a->id)}}" method="post" class="d-none"  id="vote-down-answer-{{$a->id}}">
                                    @csrf
                                    <input type="hidden" name="vote" value="-1">
                                </form>
                            @endcan

                            @can('acceptBestAnswer', $question)
                                <a href="#" title="Mark this answer as best answer" class="{{$a->status}}"
                                   onclick="event.preventDefault(); document.getElementById('accept-answer-{{$a->id}}').submit()"><i
                                        class="fas fa-check fa-2x"></i></a>
                                <form action="{{route('answer.accept', $a->id)}}" method="post" class="d-none"
                                      id="accept-answer-{{$a->id}}">
                                    @csrf
                                </form>
                            @else
                                @if($a->is_best)
                                    <a href="#" title="This answer is best answer" class="{{$a->status}}"
                                       onclick="event.preventDefault();"><i
                                            class="fas fa-check fa-2x"></i></a>
                                @endif
                            @endcan
                        </div>
                        <div class="media-body">
                            <p>
                                {!!  $a->body_html !!}
                            </p>
                            <div class="row">
                                <div class="col-4">
                                    <div class="d-flex align-items-center">
                                        @can('update', $a)
                                            <a href="{{route('questions.answers.edit', [$question->id, $a->id])}}"> <i
                                                    title="Edit question" class="far fa-edit fa-2x"></i></a>
                                        @endcan
                                        @can('delete', $a)
                                            <form
                                                action="{{ route('questions.answers.destroy', [$question->id, $a->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn delete-answer-button"
                                                        onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash-alt fa-2x"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>

                                </div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    <div class="d-flex flex-column mr-4 float-right">
                                        <span class="text-muted"> Answered {{ $a->date_created }}</span>
                                        <div class="answer-info d-flex align-items-center mt-2">
                                            <a href="{{ $a->user->url }}" class="d-inline-block mr-2"> <img
                                                    src="{{ $a->user->avatar }}" alt=""> </a>
                                            <a href="{{ $a->user->url }}"> {{ $a->user->name }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr>
                @endforeach

            </div>
        </div>
    </div>


</div>
