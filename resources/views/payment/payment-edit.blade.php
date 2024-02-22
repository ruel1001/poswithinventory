@extends('template.main')
@section('title', 'Edit Payment')
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
                        <li class="breadcrumb-item"><a href="/payment">Payment</a></li>

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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <a href="/payment" class="btn btn-warning btn-sm"><i
                                        class="fa-solid fa-arrow-rotate-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="needs-validation" novalidate action="/payment/{{ $payment->payment_id}}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">

                                <div class="col-lg-7">
                            <div class="form-group">
                                <div class="card-body">
                                    {!! QrCode::size(150)->generate($payment->payment_id) !!}
                                </div>
                                @error('account_name')
                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="account_number">Account Number</label>
                                            <input type="text"  name="account_number" readonly
                                                class="form-control @error('account_number')) is-invalid @enderror"
                                                id="account_number" placeholder="Account number"
                                                value="{{old('account_number', $payment->account_number)}}" required>
                                            @error('account_number')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="account_name">Full Name</label>
                                            <input type="text" name="account_name" readonly
                                                class="form-control @error('account_name')) is-invalid @enderror"
                                                id="account_name" placeholder="Full Name"
                                                value="{{old('account_name', $payment->account_name)}}" required>
                                            @error('account_name')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="account_balance">Amount Balance</label>
                                            <input type="text" name="account_balance" readonly
                                                class="form-control @error('account_number')) is-invalid @enderror"
                                                id="account_balance" placeholder="Account number"
                                                value="{{old('account_balance', $customer->account_balance)}}" >
                                            @error('account_balance')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="arrears_month">Arrears Month</label>
                                            <input type="text" name="arrears_month" readonly
                                                class="form-control @error('arrears_month') is-invalid @enderror" id="arrears_month"
                                                placeholder="arrears_month" value="{{old('arrears_month', $customer->arrears)}}"
                                                required>
                                            @error('arrears_month')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="amount_paid">Amount Paid</label>
                                            <input type="number" name="amount_paid"
                                                class="form-control @error('amount_paid') is-invalid @enderror" id="amount_paid"
                                                placeholder="Amount Paid" value="{{old('amount_paid' ,$payment->amount_paid)}}"
                                                required>
                                            @error('amount_paid')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="collectors_name">Collector's Name</label>
                                            <input type="text" name="collectors_name" readonly
                                                class="form-control @error('collectors_name') is-invalid @enderror" id="collectors_name"
                                                placeholder="collectors_name" value="{{ auth()->user()->user_name }}"
                                                required>
                                            @error('collectors_name')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="billing_month">Billing Month</label>
                                            <input type="date" name="billing_month"
                                                class="form-control @error('billing_month') is-invalid @enderror"
                                                id="billing_month" placeholder="Billing Month"
                                                value="{{old('billing_month',$payment->billing_month)}}" required>
                                            @error('billing_month')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>




                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="plan_subscribed">Plan Subscribed</label>
                                            <input type="number" name="plan_subscribed" readonly
                                                class="form-control @error('plan_subscribed') is-invalid @enderror"
                                                id="plan_subscribed" placeholder="Plan Subscribed"
                                                value="{{old('plan_subscribed', $customer->plan_subscribed)}}" required>
                                            @error('plan_subscribed')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <button class="btn btn-dark mr-1" type="reset"><i class="fa-solid fa-arrows-rotate"></i>
                                    Reset</button>
                                <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk"></i>
                                    Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.content -->
            </div>
        </div>
    </div>
</div>






@endsection
