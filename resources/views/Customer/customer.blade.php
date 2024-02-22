@extends('template.main')
@section('title', 'Customer')
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
                        <li class="breadcrumb-item"><a href="/customer">Home</a></li>
                        <li class="breadcrumb-item active">@yield('title')</li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <a href="/customer/create" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add
                                    Customer</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover text-center"
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Account Number</th>
                                        <th>Full Name</th>
                                        <th>Account Balance</th>
                                        <th>Plan Subscribed</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customer as $data)
                                    <tr>
                                        <td>{{ $data->account_number }}</td>
                                        <td>{{ $data->account_name }}</td>
                                        <td>{{ $data->account_balance }}</td>
                                        <td> {{ $data->plan_subscribed }}</td>

                                        <td>
                                        <div class="d-flex justify-content-center">
                                                <a href="maintenance/{{$data->account_number}}/addmaintenance"
                                                    class="btn btn-success btn-sm mr-1 same-size-btn">
                                                    <i class="fa-solid fa-money-check-dollar"></i> Add Maintenance
                                                </a>

                                        <div class="d-flex justify-content-center">
                                                <a href="payment/{{$data->account_number}}/addpayment"
                                                    class="btn btn-success btn-sm mr-1 same-size-btn">
                                                    <i class="fa-solid fa-money-check-dollar"></i> Add Payment
                                                </a>


                                            <form class="d-inline" action="/customer/{{ $data->account_number}}/edit"
                                                method="GET">
                                                <button type="submit" class="btn btn-success btn-sm mr-1">
                                                    <i class="fa-solid fa-pen"></i> Edit
                                                </button>
                                            </form>


                                            <form class="d-inline" action="/customer/{{ $data->account_number }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm" id="btn-delete"><i
                                                        class="fa-solid fa-trash-can"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    </div>
</div>


@endsection
