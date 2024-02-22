@extends('template.main')
@section('title', 'Payment')
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

                        <li class="breadcrumb-item active"><a href="/payment">Home</a></li>
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
                <!-- <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <a href="/payment/create" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add
                                    Payment</a>
                            </div>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover text-center "
                                style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Payment No</th>
                                        <th>Full Name</th>
                                        <th>Amount Paid</th>
                                        <th>Billing Month</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment as $data)
                                    <tr>
                                        <td>{{ $data->payment_id }}</td>
                                        <td>{{ $data->account_name }}</td>
                                        <td>{{ $data->amount_paid }}</td>
                                        <td> {{ $data->billing_month }}</td>
                                        <td>


                                                <form class="d-inline"
                                                    action="/payment/{{ $data->payment_id}}/edit" method="GET">
                                                    <button type="submit" class="btn btn-success btn-sm mr-1">
                                                        <i class="fa-solid fa-pen"></i> Edit
                                                    </button>
                                                </form>


                                                <form class="d-inline" action="/payment/{{ $data->payment_id }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        id="btn-delete"><i class="fa-solid fa-trash-can"></i> Delete
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
