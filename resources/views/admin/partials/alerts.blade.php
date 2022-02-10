
@if (\Illuminate\Support\Facades\Session::has('created'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{session('created')}}
    </div>
@elseif(\Illuminate\Support\Facades\Session::has('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{session('error')}}
    </div>
@elseif(\Illuminate\Support\Facades\Session::has('info'))
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{session('info')}}
    </div>
@endif
