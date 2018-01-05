<div class="container">
    <div class="row">
        <a class="col-4 btn-dark text-center p-2 theme-background {{$active == 'home' ? 'active' : ''}}" href="/business/viewStore/{{$business->id}}"> store </a>
        <a class="col-4 btn-dark text-center p-2 theme-background {{$active == 'about' ? 'active' : ''}}" href="/business/viewStore/{{$business->id}}/about"> about </a>
        <a class="col-4 btn-dark text-center p-2 theme-background {{$active == 'contact' ? 'active' : ''}}" href="/business/viewStore/{{$business->id}}/contact"> contact </a>
    </div>
</div>

<style>
    .theme-background {
        background: red !important;
    }
</style>