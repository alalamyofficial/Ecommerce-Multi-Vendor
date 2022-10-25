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
                        <span class="mdi mdi-arrow-top-right icon-item"></span>
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
                        <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Products</h6>
                </div>
                </div>
            </div>
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
                        <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Customers</h6>
                </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">$ {{$totalrevenue}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                        <span class="mdi mdi-arrow-top-right icon-item"></span>
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
                        <h3 class="mb-0">{{count($total_delivered_order)}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                        <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Delivered Order</h6>
                </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                        <h3 class="mb-0">{{count($total_processing_order)}}</h3>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success ">
                        <span class="mdi mdi-arrow-top-right icon-item"></span>
                        </div>
                    </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Processing Order</h6>
                </div>
                </div>
            </div>

            </div>

        </div>    
    </div>
</div>            

@endsection