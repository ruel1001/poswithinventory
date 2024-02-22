@extends('template.main')
@section('title', 'Add Customer')
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <a href="/customer" class="btn btn-warning btn-sm"><i
                                        class="fa-solid fa-arrow-rotate-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="needs-validation" novalidate action="/customer" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="row">


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="account_name">Full Name</label>
                                            <input type="text" name="account_name"
                                                class="form-control @error('account_name') is-invalid @enderror"
                                                id="account_name" placeholder="Full Name"
                                                value="{{old('account_name')}}" required>
                                            @error('account_name')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" name="address"
                                                class="form-control @error('address') is-invalid @enderror" id="address"
                                                placeholder="Address" value="{{old('address')}}" required>
                                            @error('address')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="date_plan">Date Plan</label>
                                            <input type="date" name="date_plan"
                                                class="form-control @error('date_plan') is-invalid @enderror"
                                                id="date_plan" placeholder="Last name" value="{{old('date_plan')}}"
                                                required>
                                            @error('date_plan')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="amount_of_installation">Amount of Installation</label>
                                            <input type="number" name="amount_of_installation"
                                                class="form-control @error('amount_of_installation') is-invalid @enderror"
                                                id="amount_of_installation" placeholder="Amount of Installation"
                                                value="{{old('amount_of_installation')}}" required>
                                            @error('amount_of_installation')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>




                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="due_date_month">Due Date Month</label>
                                            <input type="date" name="due_date_month"
                                                class="form-control @error('due_date_month') is-invalid @enderror"
                                                id="due_date_month" placeholder="Due Date Month"
                                                value="{{old('due_date_month')}}" required>
                                            @error('due_date_month')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="arrears">Arrears</label>
                                            <input type="text" name="arrears"
                                                class="form-control @error('arrears') is-invalid @enderror" id="arrears"
                                                placeholder="Arrears" value="{{old('arrears')}}" required>
                                            @error('arrears')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="foc">FOC</label>
                                            <input type="text" name="foc"
                                                class="form-control @error('foc') is-invalid @enderror" id="foc"
                                                placeholder="foc" value="{{old('foc')}}" required>
                                            @error('foc')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="modem">Modem</label>
                                            <input type="text" name="modem"
                                                class="form-control @error('modem') is-invalid @enderror" id="modem"
                                                placeholder="Modem" value="{{old('modem')}}" required>
                                            @error('modem')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="connector">Connector</label>
                                            <input type="text" name="connector"
                                                class="form-control @error('modem') is-invalid @enderror" id="connector"
                                                placeholder="Connector" value="{{old('connector')}}" required>
                                            @error('connector')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="ficamp">FICAMP</label>
                                            <input type="text" name="ficamp"
                                                class="form-control @error('ficamp') is-invalid @enderror" id="ficamp"
                                                placeholder="FICAMP" value="{{old('ficamp')}}" required>
                                            @error('ficamp')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="others">Others</label>
                                            <input type="text" name="others"
                                                class="form-control @error('others') is-invalid @enderror" id="others"
                                                placeholder="Others" value="{{old('others')}}" required>
                                            @error('others')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="messenger">Messenger</label>
                                            <input type="text" name="messenger"
                                                class="form-control @error('messenger') is-invalid @enderror"
                                                id="messenger" placeholder="Messenger" value="{{old('messenger')}}"
                                                required>
                                            @error('messenger')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="contact_number">Contact Number</label>
                                            <input type="number" name="contact_number"
                                                class="form-control @error('contact_number') is-invalid @enderror"
                                                id="contact_number" placeholder="Contact Number"
                                                value="{{old('contact_number')}}" required>
                                            @error('contact_number')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="area">Area</label>
                                            <input type="text" name="area"
                                                class="form-control @error('area') is-invalid @enderror" id="area"
                                                placeholder="Area" value="{{old('area')}}" required>
                                            @error('area')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="plan_subscribed">Plan Subscribed</label>
                                            <input type="number" name="plan_subscribed"
                                                class="form-control @error('plan_subscribed') is-invalid @enderror"
                                                id="plan_subscribed" placeholder="Plan Subscribed"
                                                value="{{old('plan_subscribed')}}" required>
                                            @error('plan_subscribed')
                                            <span class="invalid-feedback text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>








                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-dark mr-1" id="clearButton"><i class="fa-solid fa-arrows-rotate"></i>
                                    Reset</button>
                                <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk"></i>
                                    Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
document.addEventListener("DOMContentLoaded", function() {
    const clearButton = document.getElementById('clearButton');

    clearButton.addEventListener('click', function() {
        // Get all input fields within the form
        const inputFields = document.querySelectorAll('input');

        // Loop through each input field and set its value to an empty string
        inputFields.forEach(function(input) {
            input.value = '';
        });

        // Optionally, you can also clear any select elements
        const selectFields = document.querySelectorAll('select');
        selectFields.forEach(function(select) {
            select.selectedIndex = 0; // Reset to the first option
        });

        // Optionally, you can also clear any textarea elements
        const textareaFields = document.querySelectorAll('textarea');
        textareaFields.forEach(function(textarea) {
            textarea.value = '';
        });

        // Optionally, you can also clear any other specific elements

    });
});
</script>
                <!-- /.content -->
            </div>
        </div>
    </div>
</div>



@endsection
