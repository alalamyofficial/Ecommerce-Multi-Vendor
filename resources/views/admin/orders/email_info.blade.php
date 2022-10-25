@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="mb-3">
            <label for="order" class="form-label">
                <div class="d-flex">
                    <span class="mr-2">Send Mail To 
                        <b class="text-success">
                            {{$order->email}}
                        </b>
                        </span>
                    <i class="mdi mdi-sort-variant"></i>
                </div>
            </label>
            <form action="{{route('send_user_email',$order->id)}}" method="post">
                @csrf
                
                <div class="mb-3">
                    <label for="greeting">Email Greetings</label>
                    <input type="text" 
                        name="greeting" 
                        class="form-control" 
                        placeholder="Greetings"
                    >
                </div>

                <div class="mb-3">
                    <label for="greeting">Email FirstLine</label>
                    <input type="text" 
                        name="firstline" 
                        class="form-control" 
                        placeholder="Firstline"
                    >
                </div>

                <div class="mb-3">
                    <label for="greeting">Email Body</label>
                    <input type="text" 
                        name="body" 
                        class="form-control" 
                        placeholder="Body"
                    >
                </div>

                <div class="mb-3">
                    <label for="greeting">Email Button Name</label>
                    <input type="text" 
                        name="button" 
                        class="form-control" 
                        placeholder="Button"
                    >
                </div>

                <div class="mb-3">
                    <label for="greeting">Email Url</label>
                    <input type="text" 
                        name="url" 
                        class="form-control" 
                        placeholder="Url"
                    >
                </div>

                <div class="mb-3">
                    <label for="greeting">Email LastLine</label>
                    <input type="text" 
                        name="lastline" 
                        class="form-control" 
                        placeholder="Lastline"
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    <div class="d-flex">
                        <i class="mdi mdi-gmail ml-1" title="Send"></i>
                    </div>
                </button>
            </form>
        </div>
    </div>
</div>

@endsection