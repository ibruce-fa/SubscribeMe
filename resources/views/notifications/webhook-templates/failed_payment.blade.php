<h4>
    Hi {{$user->first}},<br>
    we had to suspend your subscription to
    <span class="theme-color">{{$plan->stripe_plan_name}}</span>
    because your payment didn't go through
 </h4>
<h4>Please update your payment method</h4>
<hr>

<div class="text-center">
    <a href="/account/paymentMethod" class="btn btn-danger">
        Update Payment
    </a>
</div>


<p>Thank you for your business.</p>
