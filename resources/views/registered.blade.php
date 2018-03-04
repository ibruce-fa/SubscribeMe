@extends('layouts.app')

@section('body')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center">Thanks!</h3>
                    <h5 class="text-center">You've successfully registered. Please check the email we've sent you to confirm your account</h5>
                </div>
                <div class="card-footer">
                    <a href="/" class="btn theme-background">Done</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
<script>
    $('.footer-bottom').hide();
</script>
@endsection