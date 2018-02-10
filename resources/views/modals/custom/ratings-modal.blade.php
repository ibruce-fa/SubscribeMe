<div id="review-{{$plan->id}}" class="sm-modal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close hide-sm-modal" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                <small class="text-muted">Posted by Anonymous on 3/1/17</small>
                <hr>
                <form method="post" action="///" class="form-group">
                    <textarea name="body" placeholder="write your review here" class="form-control-lg" id="review-body"></textarea><br>
                    <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
                    {{csrf_field()}}
                </form>
                <a href="#" class="btn btn-success" id="service-review-button">Leave a Review</a>
            </div>
        </div>
    </div>
</div>