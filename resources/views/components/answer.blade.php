<answer :answer="{{$answer}}" inline-template>
    <div class="media horizon-except-last">
        <div class="vote-info d-flex flex-column align-items-center mr-4">
            <x-vote voteUpTitle="This answer is useful" voteDownTitle="This answer is not useful"
                    lowerModel="answer" upperModel="Answer" :model="$answer"></x-vote>
            @can('acceptBestAnswer', $question)
                <a href="#" title="Mark this answer as best answer" class="{{$answer->status}}"
                   onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit()"><i
                        class="fas fa-check fa-2x"></i></a>
                <form action="{{route('answer.accept', $answer->id)}}" method="post" class="d-none"
                      id="accept-answer-{{$answer->id}}">
                    @csrf
                </form>
            @else
                @if($answer->is_best)
                    <a href="#" title="This answer is best answer" class="{{$answer->status}}"
                       onclick="event.preventDefault();"><i
                            class="fas fa-check fa-2x"></i></a>
                @endif
            @endcan
        </div>
        <div class="media-body">
            <form action="" v-if="editing" @submit.prevent="update">
                <div class="form-group">
                    <label for="answer-body">Content</label>
                    <textarea required v-model="body" name="body" id="answer-body" rows="5" class="form-control @error('body') is-invalid @enderror"></textarea>
                </div>

                <button class="btn btn-outline-primary" type="submit" :disabled="body.length == 0">Update</button>
                <button class="btn btn-outline-primary" type="button" @click="editing = false">Cancel</button>
            </form>
            <div v-else>
                <div v-html="body_html"></div>
{{--                {!! $answer->body_html !!}--}}
                <div class="row">
                    <div class="col-4">
                        <div class="d-flex align-items-center">
                            @can('update', $answer)
                                <a @click.prevent="editing = true, body = body_html" href="{{route('questions.answers.edit', [$question->id, $answer->id])}}"> <i
                                        title="Edit question" class="far fa-edit fa-2x"></i></a>
                            @endcan
                            @can('delete', $answer)
                                    <button class="btn delete-answer-button" @click="destroy">
                                        <i class="fas fa-trash-alt fa-2x"></i>
                                    </button>
                            @endcan
                        </div>

                    </div>
                    <div class="col-4"></div>
                    <div class="col-4">
                        {{--                <x-author :model="$answer" label="Answered by"></x-author>--}}
                        <user-info :model="{{$answer}}" label="Answered by"></user-info>
                    </div>
                </div>
            </div>


        </div>
    </div>
</answer>

