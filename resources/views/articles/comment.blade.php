<div class="container mt-5 mb-5">
    <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-7">
            <div class="card">
                <div class="p-3">
                    <h6>Comments</h6>
                </div>
                <div class="col-auto align-items-center p-3 form-color">
                    <div class="row">
                        <div class="col-auto">
                            <img src="https://i.imgur.com/oOCvj8U.jpeg" width="50" class="rounded-circle">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="submit_comment" placeholder="Enter your comment...">
                        </div>
                    </div>
                </div>
                @if (false == empty($comment_data))
                    @foreach ($comment_data AS $comment)
                        <div class="mt-2">
                            <div class="col-auto p-3">
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="col-auto align-items-center inline-items">
                                            <img src="https://i.imgur.com/oOCvj8Ujpeg" width="40" height="40" class="rounded-circle mr-3">
                                            <span class="mr-2">{{ $comment->user->name }}</span> <small class="c-badge">Top Comment</small>
                                        </div>
                                        <small>{{ $comment->diffTime }} ago</small>
                                    </div>
                                    <p class="text-justify comment-text mb-0">{{ $comment->content }}</p>
                                    <div class="col-auto user-feed"> <span class="wish"><i class="fa fa-heartbeat mr-2"></i>{{ $comment->like }}</span> <span class="ml-3"><i class="fa fa-comments-o mr-2"></i>Reply</span> </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
