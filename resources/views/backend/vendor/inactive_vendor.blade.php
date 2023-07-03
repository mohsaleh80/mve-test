@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Inactive Vendor</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Inactive Vendor</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">

						</div>
					</div>
				</div>
				<!--end breadcrumb-->

				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
			<tr>
				<th>Sl</th>
				<th>Shop Name </th>
				<th>Vendor Username </th>
				<th>Join Date  </th>
				<th>Vendor Email </th>
				<th>Status </th>
				<th>Action</th> 
			</tr>
		</thead>
		<tbody>
	@foreach($inActiveVendor as $key => $item)		
			<tr>
				<td> {{ $key+1 }} </td>
				<td> {{ $item->name }}</td>
				<td> {{ $item->username }}</td>
				<td> {{ $item->created_at }}</td>
				<td> {{ $item->email }}  </td>
				<td> <span class="btn btn-secondary">{{ $item->status }}</span>   </td>

				<td>
<a href="{{ route('inactive.vendor.details',$item->id) }}" class="btn btn-info">Vendor Details</a>


				</td> 
			</tr>
			@endforeach


		</tbody>
		<tfoot>
			<tr>
				<th>Sl</th>
				<th>Shop Name </th>
				<th>Vendor Username </th>
				<th>Join Date  </th>
				<th>Vendor Email </th>
				<th>Status</th>
				<th>Action</th> 
			</tr>
		</tfoot>
	</table>
						</div>
					</div>
				</div>



			</div>


    <!-- Init Datatable and Export pdf,csv... and Search on field -->
    <script type="text/javascript">

        $(document).ready(function () {
            // Setup - add a text input to each footer cell
            $('#example tfoot tr th').each(function () {
                var title = $(this).text();
    
                if(title !== 'Sl' && title !== 'Action' && title !== 'Status')
                $(this).html('<input type="text" placeholder="' + title + '" />');
            });
        
            // DataTable
            var table = $('#example').DataTable({
                select: true,
                dom: 'Blfrtip',
                lengthChange: true,
                                    
                buttons: [ 'copy', 'csv','excel', 'pdf', 'print'],
    
                initComplete: function () {
                    // Apply the search
                    this.api()
                        .columns()
                        .every(function () {
                            var that = this;
        
                            $('input', this.footer()).on('keyup change clear', function () {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                },
            });
    
    
            table.buttons().container()
                    .appendTo( '#example_wrapper .col-md-6:eq(0)' );
        });
    </script>

@endsection