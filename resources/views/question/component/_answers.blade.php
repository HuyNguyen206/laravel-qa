<div class="row justify-content-center mt-2" v-cloak>
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
{{--                    @include('question.component._answer')--}}
                    <x-answer :question="$question" :answer="$a"></x-answer>
                @endforeach

            </div>
        </div>
    </div>

</div>
