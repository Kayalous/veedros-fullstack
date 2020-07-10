@inject('markdown', 'Parsedown')
@php($markdown->setSafeMode(true))

@if(isset($reply) && $reply === true)
  <div id="comment-{{ $comment->getKey() }}" class="media">
@else
  <li id="comment-{{ $comment->getKey() }}" class="media">
@endif
      <div class="tip-instructor-avatar align-items-start col-2">
          <img src="{{$comment->commenter->img}}" alt="comment avatar" class="round round-sm" />
      </div>
    <div class="media-body">
        <div class="col-12 d-flex align-items-center w-100">
            <div class="card card-comment border-0">
                <div class="card-body row">
                    <div class="col-9">
                        <a href="{{asset('profile') . '/' . $comment->commenter->id}}">{{$comment->commenter->name}}</a>
                        <p class="mt-2">{!! $markdown->line($comment->comment) !!}</p>
                    </div>
                    <div class="col-3 d-flex flex-column justify-content-start">
{{--                        <div class="likes d-flex justify-content-center align-items-center">--}}
{{--                            <button class="btn btn-secondary-veedros like-btn more {{Auth::user() ?  $comment->isLikedBy(Auth::user()) ? 'liked' : '' : ''}}" id="{{$comment->id}}"><i--}}
{{--                                    data-feather="heart"></i>--}}
{{--                                <span class="ml-2 text-muted">{{$comment->likes()->count()}}</span>--}}
{{--                            </button>--}}

{{--                        </div>--}}
                        <h6 class="mb-0 d-flex justify-content-end align-items-center"><i data-feather="globe" class="mr-1"></i>{{ $comment->created_at->diffForHumans() }}</h6>
                    </div>
                    @can('reply-to-comment', $comment)
                        <button data-toggle="modal"
                                data-target="#reply-modal-{{ $comment->getKey() }}"
                                class="btn btn-veedros-sm btn-veedros-alt-white text-uppercase mt-3 ml-auto mr-3">Reply</button>
                    @endcan

                    @can('edit-comment', $comment)
                        <button data-toggle="modal"
                                data-target="#comment-modal-{{ $comment->getKey() }}"
                                class="btn btn-veedros-sm btn-veedros-alt-white text-uppercase mt-3 ml-auto">Edit</button>
                    @endcan

                    @can('delete-comment', $comment)
                        <a href="{{ route('comments.destroy', $comment->getKey()) }}" onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->getKey() }}').submit();"
                           class="btn btn-veedros-sm btn-veedros-alt-white text-uppercase mt-3 mx-3" style="background-color: #D36565 !important; color: white !important;">Delete</a>
                        <form id="comment-delete-form-{{ $comment->getKey() }}" action="{{ route('comments.destroy', $comment->getKey()) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endcan

                </div>
            </div>

        </div>

        @can('edit-comment', $comment)
            <div class="modal fade" id="comment-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content login-body">
                        <div class="modal-body px-5">
                            <form method="POST" action="{{ route('comments.update', $comment->getKey()) }}">
                                @method('PUT')
                                @csrf
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title">Edit Comment</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="message">Update your message here:</label>
                                        <textarea required class="form-control" name="message" rows="3">{{ $comment->comment }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0">
                                    <button type="submit" class="btn btn-veedros-new btn-veedros-md mx-auto border-0">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        @can('reply-to-comment', $comment)
            <div class="modal fade" id="reply-modal-{{ $comment->getKey() }}" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content login-body">
                        <div class="modal-body px-5">
                            <form method="POST" action="{{ route('comments.reply', $comment->getKey()) }}">
                                @csrf
                                <div class="modal-header border-bottom-0">
                                    <h5 class="modal-title">Reply to {{$comment->commenter->name}}</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="message">Enter your message here:</label>
                                        <textarea required class="form-control" name="message" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-top-0">
                                    <button type="submit" class="btn btn-veedros-new btn-veedros-md mx-auto border-0">Reply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        <br />{{-- Margin bottom --}}

        {{-- Recursion for children --}}
        @if($grouped_comments->has($comment->getKey()))
            @foreach($grouped_comments[$comment->getKey()] as $child)
                @include('comments::_comment', [
                    'comment' => $child,
                    'reply' => true,
                    'grouped_comments' => $grouped_comments
                ])
            @endforeach
        @endif

    </div>
@if(isset($reply) && $reply === true)
  </div>
@else
  </li>
@endif
