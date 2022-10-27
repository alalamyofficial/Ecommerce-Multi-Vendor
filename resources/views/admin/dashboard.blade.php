@extends('admin.home')
@section('body')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="mb-3">
            <div class="row">
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-success">{{count($orders)}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                        <span class="mdi mdi-shopping icon-item"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Orders</h6>
                </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-success">{{count($products)}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                        <span class="mdi mdi-hanger"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Products</h6>
                </div>
                </div>
            </div>
            @if(Auth::user()->userType == 1)
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-success">{{count($users)}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                        <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Customers</h6>
                </div>
                </div>
            </div>
            @endif
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0 text-success">$ {{$totalrevenue}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                        <span class="mdi mdi-cash-usd"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Revenue</h6>
                </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-success">{{count($total_delivered_order)}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                        <span class="mdi mdi-car"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Delivered Orders</h6>
                </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-success">{{count($total_processing_order)}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                            <span class="mdi mdi-car-wash"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Processing Orders</h6>
                </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-success">{{count($total_processing_canceled)}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                            <span class="mdi mdi-car-connected"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Canceled Orders</h6>
                </div>
                </div>
            </div>
            @if(Auth::user()->userType == 1)
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-success">{{count($comments)}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                            <span class="mdi mdi-comment"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Comments</h6>
                </div>
                </div>
            </div>
            @endif

            @if(Auth::user()->userType == 1)
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0 text-success">{{count($mails)}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                            <span class="mdi mdi-email"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Mails</h6>
                </div>
                </div>
            </div>
            @endif

            </div>

        </div>    

        <br><hr><br>
        <img src="images/ecommerce.jpg" alt="ecommerce">
    </div>
</div>            

@endsection