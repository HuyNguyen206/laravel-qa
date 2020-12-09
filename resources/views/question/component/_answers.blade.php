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
                            <a href="" title="This answer is useful" class="vote-up"><i><i class="fas fa-caret-up fa-3x"></i></i></a>
                            <span class="votes-count">1234</span>
                            <a href="" title="This answer is not useful" class="vote-down off"><i class="fas fa-caret-down fa-3x"></i></a>
                            <a href="" title="Mark this answer as best answer" class="vote-accepted"><i class="fas fa-check fa-2x"></i></a>
                        </div>
                        <div class="media-body">
                            <p>
                                {!!  $a->body_html !!}
                            </p>
                            <div class="d-flex flex-column mr-4 float-right">
                                <span class="text-muted"> Answered {{ $a->date_created }}</span>
                                <div class="answer-info d-flex align-items-center mt-2">
                                    <a href="{{ $a->user->url }}" class="d-inline-block mr-2"> <img src="{{ $a->user->avatar }}" alt=""> </a>
                                    <a href="{{ $a->user->url }}"> {{ $a->user->name }}</a>
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
