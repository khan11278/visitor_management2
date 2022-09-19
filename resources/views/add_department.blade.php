@extends('dashboard')

@section('content')
    <h2 class="mt-5">Department Management</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/information">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/department">Department Management</a></li>
            <li class="breadcrumb-item active">Add New Department</li>
        </ol>
    </nav>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add New Department</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('department.add_validation') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label><b>Department Name *</b></label>
                            <input type="text" name="department_name" class="form-control"
                                value="{{ old('department_name') }}" />
                            @if ($errors->has('department_name'))
                                <span class="text-danger">{{ $errors->first('department_name') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">

                            <label><b>Department Status *</b></label>
                            <br>
                            <p fontsize="10px;">Enable
                                <input name="dept_status" class="dept_status" type="checkbox" value="Enable"><br>
                                Disable
                                <input name="dept_status" class="dept_status" type="checkbox" value="Disable"><br>
                                @if ($errors->has('dept_status'))
                                    <span class="text-danger">{{ $errors->first('dept_status') }}</span>
                                @endif
                            </p>

                        </div>
                        {{-- <div class="form-group mb-3">
		        		<label><b>Contact Person</b></label>
		        		<div class="row">
		        			<div class="col col-md-10">
		        				<input type="text" name="contact_person[]" class="form-control" />
		        			</div>
		        			<div class="col col-md-2">
		        				<button type="button" name="add_person" id="add_person" class="btn btn-success btn-sm">+</button>
		        			</div>
		        		</div>
		        		<div id="append_person"></div>
		        	</div> --}}
                        <div class="form-group mb-3">
                            <input type="submit" class="btn btn-sm btn-primary" value="Add" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

                    $('.dept_status').on('change', function() {
                        $('.dept_status').not(this).prop('checked', false);

                    });
                        // var count_person = 0;

                        // $(document).on('click', '#add_person', function(){

                        // 	count_person++;

                        // 	var html = `
                    // 	<div class="row mt-2" id="person_`+count_person+`">
                    // 		<div class="col-md-10">
                    // 			<input type="text" name="contact_person[]" class="form-control department_contact_person" />
                    // 		</div>
                    // 		<div class="col-md-2">
                    // 			<button type="button" name="remove_person" class="btn btn-danger btn-sm remove_person" data-id="`+count_person+`">-</button>
                    // 		</div>
                    // 	</div>
                    // 	`;

                        // 	$('#append_person').append(html);

                        // });

                        // $(document).on('click', '.remove_person', function(){

                        // 	var button_id = $(this).data('id');

                        // 	$('#person_'+button_id).remove();

                        // });
                    });
    </script>
@endsection
