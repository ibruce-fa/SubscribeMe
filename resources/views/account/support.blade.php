@extends('layouts.app')
@section('body')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Customer Support</h4>
                </div>
                <div class="card-body">
                    <form class="form-group" action="/account/contactSupport">
                            <label for="subject">Subject</label>
                            <input type="text"  class="form-control" placeholder="what is this regarding?">


                            <label for="message">Message</label>
                            <textarea class="form-control" name="body" placeholder="How may we help you?" rows="5" cols="50"></textarea>
                            <input type="hidden" name="support" value=true>
                        <hr>
                        <button class="btn theme-background">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection