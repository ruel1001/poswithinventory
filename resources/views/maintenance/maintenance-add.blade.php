@extends('template.main')
@section('title', 'Add Maintenance')
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
                        <li class="breadcrumb-item"><a href="/maintenance">Home</a></li>

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
                                <a href="/maintenance" class="btn btn-warning btn-sm"><i
                                        class="fa-solid fa-arrow-rotate-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="needs-validation" novalidate action="/maintenance/newmaintenance" method="POST">
                            @csrf
                            @method('Post')
                            <div class="card-body">
                                <div class="row">

                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="account_number">Account Number</label>
                                            <input type="text"  name="account_number" readonly
                                                class="form-control @error('account_number')) is-invalid @enderror"
                                                id="account_number" placeholder="Account number"
                                                value="{{old('account_number', $customer->account_number)}}" required>
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
                                                value="{{old('account_name', $customer->account_name)}}" required>
                                            @error('account_name')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" readonly
                                                class="form-control @error('address')) is-invalid @enderror"
                                                id="address" placeholder="Address"
                                                value="{{old('address', $customer->address)}}" >
                                            @error('address')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="area">Area</label>
                                            <input type="text" name="area" readonly
                                                class="form-control @error('area')) is-invalid @enderror"
                                                id="area" placeholder="Area"
                                                value="{{old('area', $customer->area)}}" >
                                            @error('area')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="material_uses">Material Used</label>
                                            <select name="material_uses" id="material_uses"
                                                class="form-control @error('material_uses') is-invalid @enderror"
                                                required>
                                                <option value="">Select Material Used</option>
                                            </select>
                                            @error('material_uses')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>




                                    <script>
                                    $(document).ready(function() {
                                        // Make AJAX request to fetch document types
                                        $.ajax({
                                            url: '/material-list',
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function(data) {
                                                // Log the response
                                                console.log(data);

                                                // Populate select options with received data
                                                $.each(data, function(key, value) {
                                                    $('#material_uses').append(
                                                        '<option value="' + value
                                                        .material_id +
                                                        '">' + value
                                                        .material_name +
                                                        '</option>');
                                                });
                                            },
                                            error: function(xhr, status, error) {
                                                console.error(xhr.responseText);
                                            }
                                        });
                                                        // Add event listener to material_used select
                                        $('#material_uses').on('change', function() {
                                            // Get the selected material ID
                                            var materialId = $(this).val();
                                            var materialName = $(this).find('option:selected').text();


                                            // Set the selected material ID to the material_id input field
                                            $('#material_id').val(materialId);
                                            $('#material_used').val(materialName);
                                        });
                                    });
                                    </script>


                                                <input type="hidden" name="material_used"   id="material_used" value="{{old('material_used')}}">




                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="material_id">Material ID</label>
                                            <input type="text" name="material_id" readonly
                                                class="form-control @error('material_id') is-invalid @enderror" id="material_id"
                                                placeholder="Material ID" value="{{old('material_id')}}"
                                                required>
                                            @error('material_id')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>




                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="amount_paid">Amount Paid</label>
                                            <input type="number" name="amount_paid"
                                                class="form-control @error('amount_paid') is-invalid @enderror" id="amount_paid"
                                                placeholder="Amount Paid" value="{{old('amount_paid')}}"
                                                required>
                                            @error('amount_paid')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="material_quantity_used">Quantity Used</label>
                                            <input type="number" name="material_quantity_used"
                                                class="form-control @error('material_quantity_used') is-invalid @enderror" id="material_quantity_used"
                                                placeholder="Quantity Used"  value="{{old('material_quantity_used')}}"
                                                required>
                                            @error('material_quantity_used')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nature_of_repair">Nature of Repair</label> required
                                            <textarea name="nature_of_repair" id="nature_of_repair"
                                                class="form-control @error('nature_of_repair') is-invalid @enderror"
                                                cols="10" rows="5"
                                                placeholder="Nature of Repair">{{old('nature_of_repair' )}}</textarea>
                                            @error('nature_of_repair')
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
