@if(session()->has('message'))

    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">
        <i class="fa fa-times"></i>
    </button>	

        {{session()->get('message')}}
    </div>

@endif