<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>
                     Answer
                    </h4>
                </div>
                <hr>
                    <div class="media">
                        <div class="media-body">
                            <form action="{{route('questions.answers.store', $question->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="answer-body">Content</label>
                                    <textarea name="body" id="answer-body" rows="5" class="form-control @error('body') is-invalid @enderror"></textarea>
                                    @error('body')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-outline-primary btn-lg">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>


</div>
