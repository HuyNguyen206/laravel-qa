    <div class="d-flex flex-column mr-4 float-right">
        <span class="text-muted"> {{$label}} {{ $model->date_created }}</span>
        <div class="answer-info d-flex align-items-center mt-2">
            <a href="{{ $model->user->url }}" class="d-inline-block mr-2"> <img src="{{ $model->user->avatar }}" alt=""> </a>
            <a href="{{ $model->user->url }}"> {{ $model->user->name }}</a>
        </div>
    </div>
