<div id="business-details-{{$business->id}}" class="modal fade" role="dialog" tabindex="-1" aria-hidden="true">
    <form method="post" action="/business/update/{{$business->id}}" class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Business Details</h4>
            </div>
            <div class="modal-body">
                <h3>{{$business->name}}</h3>
                <div class="edit-label-div">
                    <label>Email: </label>
                </div>
                <div class="edit-input-div">
                    <input type="text" name="email" class="form-control" value="{{$business->email}}">
                </div>

                <div class="edit-label-div">
                    <label>Phone: </label>
                </div>
                <div class="edit-input-div">
                    <input type="text" name="tel" class="form-control" value="{{$business->phone}}">
                </div>

                <div class="edit-label-div">
                    <label>Address:</label>
                </div>
                <div class="edit-input-div">
                    <input type="text" name="address" class="form-control" value="{{$business->address}}">
                </div>

                <div class="edit-label-div">
                    <label>Business Description:</label>
                </div>
                <div class="edit-input-div">
                    <textarea name="description" class="form-control">{{$business->description}}</textarea>
                </div>

                <hr>
                <h5><b><a data-toggle="collapse" data-target="hours">Click to view business hours</a></b></h5>
                <div class="business-hours hours" style="display: block">
                    @foreach($days as $day)
                        <div class="edit-label-div">
                            <label>{{ucfirst($day)}}</label>
                        </div>
                        <div class="edit-input-div">
                            <input type="text" name="{{$day}}" class="form-control" value="{{$business->$day}}">
                        </div>

                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="_method" value="put" />
                <button type="submit" class="btn btn-primary pull-left">Save Changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>

    </form>
</div>