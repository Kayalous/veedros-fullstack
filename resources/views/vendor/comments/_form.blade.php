
        @if($errors->has('commentable_type'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('commentable_type') }}
            </div>
        @endif
        @if($errors->has('commentable_id'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->first('commentable_id') }}
            </div>
        @endif
        <h2 class="mt-5 mb-4">Leave a comment</h2>
        <form method="POST" action="{{ route('comments.store') }}">
            @csrf
            @honeypot
            <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
            <input type="hidden" name="commentable_id" value="{{ $model->getKey() }}" />

            {{-- Guest commenting --}}
            @if(isset($guest_commenting) and $guest_commenting == true)
                <div class="form-group">
                    <label for="message">Enter your name here:</label>
                    <input type="text" class="form-control @if($errors->has('guest_name')) is-invalid @endif" name="guest_name" />
                    @error('guest_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="message">Enter your email here:</label>
                    <input type="email" class="form-control @if($errors->has('guest_email')) is-invalid @endif" name="guest_email" />
                    @error('guest_email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif


            <div class="col-12 profile-form-field  border-light border-radius-sm py-3 px-4">
                <div class="my-2 px-1 row">
                    <div class="col-12 m-0 pl-4 p-0">
                                    <textarea class="border-0 w-100 outline-0 text-muted @if($errors->has('message')) is-invalid @endif" rows="5" cols="50" id="comment-textarea"
                                              name="message"
                                              maxlength="1000" style="resize: none;"
                                              placeholder="Your comment on this session."></textarea>

                        <input class="d-none" id="session-id" name="session_id" value="{{$controllerSession->id}}">
                    </div>
                </div>
                @if($errors->has('message'))
                    <div class="invalid-feedback" style="display: block; text-align: left !important;">
                        Your message is required.
                    </div>
                @endif
                <div class="row">
                    <button class="btn btn-secondary-veedros ml-auto submit" id="comment-submit" type="submit"><i
                            data-feather="arrow-right"></i></button>
                </div>
            </div>
        </form>
<br />
<hr />
