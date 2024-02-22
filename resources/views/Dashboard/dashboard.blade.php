@extends('template.main')
@section('title', ' Dashboard')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('title')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">@yield('title')</a></li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">

                <!-- ./col -->
                <!-- <div class="col-lg-3 col-6">
                   small box -->
                <!-- <div class="small-box bg-info">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Faculty</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/faculty" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div> -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$customer}}</h3>

                            <p>Customers</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="/customer" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$totalAmountgain}}</h3>

                            <p>Total Material Profit</p>
                        </div>
                        <div class="icon">
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                        </div>
                        <a href="/payment" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div> -->

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$totalAmount}}</h3>

                            <p>Total Payment</p>
                        </div>
                        <div class="icon">
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                        </div>
                        <a href="/payment" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$totalexpenses}}</h3>

                            <p>Total Expenses</p>
                        </div>
                        <div class="icon">
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                        </div>
                        <a href="/expenses" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$totalPaymentdebt}}</h3>

                            <p>Total Collectible</p>
                        </div>
                        <div class="icon">
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                        </div>
                        <a href="/expenses" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                {{-- <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> --}}
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>



@endsection
