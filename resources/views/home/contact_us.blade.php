@extends('home.userpage')
@section('site')

<section class="inner_page_head">
    <div class="container_fuild">
        <div class="row">
            <div class="col-md-12">
                <div class="full">
                    <h3>Contact us</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container p-5">
    <form action="{{route('send_email')}}" method="POST">
    @csrf
        <fieldset>
            <input type="text" placeholder="Enter your full name" 
                name="name" required=""
            >
            <input type="email" placeholder="Enter your email address" 
                name="email" required=""
            >
            <input type="text" placeholder="Enter subject" 
                name="subject" required=""
            >
            <textarea name="body" 
                placeholder="Enter your message" required="">
            </textarea>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
</div>


@endsection