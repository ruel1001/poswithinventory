@extends('template.main')
@section('title', 'Edit Expenses')
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
                        <li class="breadcrumb-item"><a href="/expenses">Home</a></li>

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
                                <a href="/expenses" class="btn btn-warning btn-sm"><i
                                        class="fa-solid fa-arrow-rotate-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="needs-validation" novalidate action="/expenses/{{ $expenses->epenses_id}}"
                            method="POST">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                <div class="row">

                                <div class="col-lg-7">
                            <div class="form-group">
                                <div class="card-body">
                                    {!! QrCode::size(150)->generate($expenses->expenses_id) !!}

                                </div>


                                @error('account_name')
                                <span class="invalid-feedback text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>




                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nature_of_expenses">Nature of Expense</label> required
                                            <textarea name="nature_of_expenses" id="nature_of_expenses"
                                                class="form-control @error('nature_of_expenses') is-invalid @enderror"
                                                cols="10" rows="5"
                                                placeholder="Nature of Expense">{{old('nature_of_expenses',$expenses->nature_of_expenses )}}</textarea>
                                            @error('nature_of_expenses')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" name="amount"
                                                class="form-control @error('amount') is-invalid @enderror" id="amount"
                                                placeholder="amount" value="{{old('amount',$expenses->amount )}}" required>
                                            @error('amount')
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
