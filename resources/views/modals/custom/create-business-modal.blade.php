    <div id="createBusinessModal" class="sm-modal autoscroll" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="hide-sm-modal pull-right btn btn-default" data-dismiss="modal">cancel</button>
                    <h4 class="modal-title">Create Business</h4>
                </div>
                <form method="post" action="/business/create" class="form-group-md">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <input type="text" name="name" class="form-control" placeholder="Business Name">
                        <input type="email" name="email" class="form-control" placeholder="Business Email">
                        <input type="tel" name="phone" class="form-control" placeholder="Business Phone">
                        <textarea type="text" name="description" class="form-control" placeholder="Business Description here..."></textarea>
                        <hr>
                        <h4><u>Address</u></h4>
                        <div class="card-body">
                            <input id="autocomplete" placeholder="Enter your address"
                                   onFocus="geolocate()" class="form-control" type="text">
                        </div>
                        <input type="hidden" class="field" id="address" name="address">
                        <input type="hidden" class="field" id="locality" name="city">
                        <input type="hidden" class="field" id="administrative_area_level_1" name="state">
                        <input type="hidden" class="field" id="postal_code" name="zip">
                        <input type="hidden" class="field" id="country" name="country">
                        <input type="hidden" class="field" id="lat" name="lat">
                        <input type="hidden" class="field" id="lng" name="lng">

                        <hr>
                        <h4><u>Business hours</u>
                            <label class=" pull-right checkbox-inline"><input type="checkbox" class="has-business-hours">Check to add hours</label>
                        </h4>
                        <div class="business-hours">
                            @foreach($days as $day)
                                <div style="width: 30%; display: inline-block">
                                    <label>{{ucfirst($day)}}</label>
                                </div>
                                <div style="width: 68%; display: inline-block">
                                    <input type="text" name="{{$day}}" class="" placeholder="ex: 10am - 8pm ">
                                </div>

                            @endforeach
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-default pull-left hide-sm-modal" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>