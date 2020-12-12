   @php
   $formId = "{$lowerModel}-{$model->id}";
   @endphp
    <a href="" title="{{$voteUpTitle}}" class="vote-up {{$model->vote_up_status}}"
       onclick="event.preventDefault(); @can($canVoteUp, $model) document.getElementById("vote-up-{{$formId}}").submit()@endcan "><i><i class="fas fa-caret-up fa-3x"></i></i></a>
    @can($canVoteUp, $model)
        <form action="{{route($lowerModel.'.vote', $model)}}" method="post" class="d-none"  id="vote-up-{{$formId}}">
            @csrf
            <input type="hidden" name="vote" value="1">
        </form>
    @endcan

    <span class="votes-count">{{$voteCount}}</span>

    <a href="" title="{{$voteDownTitle}}" class="vote-down {{$model->vote_down_status}}"
       onclick="event.preventDefault(); @can($canVoteDown, $model) document.getElementById('vote-down-{{$formId}}').submit() @endcan"><i class="fas fa-caret-down fa-3x"></i></a>
    @can($canVoteDown, $model)
        <form action="{{route($lowerModel.'.vote', $model)}}" method="post" class="d-none" id="vote-down-{{$formId}}">
            @csrf
            <input type="hidden" name="vote" value="-1">
        </form>
    @endcan

