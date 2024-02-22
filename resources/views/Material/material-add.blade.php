@extends('template.main')
@section('title', 'Add Material')
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
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/material">Home</a></li>
                
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
                                <a href="/material" class="btn btn-warning btn-sm"><i
                                        material="fa-solid fa-arrow-rotate-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="needs-validation" novalidate action="/material" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">






                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="material_name">Material Name</label>
                                            <input type="text" name="material_name"
                                                class="form-control @error('material_name') is-invalid @enderror" id="material_name"
                                                placeholder="Material Name" value="{{old('material_name')}}" required>
                                            @error('material_name')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="quantity">Quantity</label>
                                            <input type="number" name="quantity"
                                                class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                                placeholder="Quantity" value="{{old('quantity')}}" required>
                                            @error('quantity')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="item">Item</label>
                                            <input type="text" name="item"
                                                class="form-control @error('item') is-invalid @enderror" id="item"
                                                placeholder="item" value="{{old('item')}}" required>
                                            @error('item')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="number" name="amount"
                                                class="form-control @error('amount') is-invalid @enderror" id="amount"
                                                placeholder="Amount" value="{{old('amount')}}" required>
                                            @error('amount')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="sale_amount">Sale Amount</label>
                                            <input type="number" name="sale_amount"
                                                class="form-control @error('sale_amount') is-invalid @enderror" id="sale_amount"
                                                placeholder="Sale Amount" value="{{old('sale_amount')}}" required>
                                            @error('sale_amount')
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
