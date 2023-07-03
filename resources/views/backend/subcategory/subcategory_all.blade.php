@extends('admin.admin_dashboard')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">All SubCategories</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All SubCategories</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
              <a href="{{ route('subcategory.add')}}" class="btn btn-primary">Add SubCategory</a>


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
                                <th>Category Name </th>
                                <th>SubCategory Name </th>
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategories as $key => $subcategory)		
                                <tr>
                                    <td> {{ $key+1 }} </td>
                                    <td> {{ $subcategory['category']['category_name'] }}</td>
                                    <td> {{ $subcategory->subcategory_name }}  </td>

                                    <td>
                                        <a href="{{route('subcategory.edit',$subcategory->id)}}" class="btn btn-info sm" title="Edit Data"> 
                                            <i class="fas fa-edit" ></i> 
                                        </a>
                                        

                                         <a href="{{route('subcategory.delete',$subcategory->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete"> 
                                            <i class="fas fa-trash-alt"></i>
                                        </a> 

                                    </td> 
                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Sl</th>
                                <th>Category Name</th>
                                <th>SubCategory Name</th>
                                <th>Action</th> 
                            </tr>
                        </tfoot>
                        
                           
                         
                    </table>
                  
            </div>
        </div>
    </div>

       <!-- Init Datatable and Export pdf,csv... and Search on field -->
<script type="text/javascript">

    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#example tfoot tr th').each(function () {
            var title = $(this).text();

            if(title !== 'Sl' && title !== 'Action')
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