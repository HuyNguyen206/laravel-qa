<div class="row justify-content-center mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>
                        {{$question->answers_count. ' '. str_plural('answer', $question->answers_count)}}
                    </h4>
                </div>
                <hr>
                @foreach ($question->answers->sortByDesc('votes_count') as $a)
                    <div class="media">
                        <div class="vote-info d-flex flex-column align-items-center mr-4">
                            <x-vote voteUpTitle="This answer is useful" voteDownTitle="This answer is not useful"
                                    lowerModel="answer" upperModel="Answer" :model="$a"></x-vote>
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
                          <div>
                              {!! $a->body_html !!}
                          </div>
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
                                    <x-author :model="$a" label="Answered by"></x-author>
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
