@include('user_template/css')
@include('user_template/topbar')
@include('user_template/sidebar')

 <!-- partial -->
 <div class="main-panel">
        <div class="content-wrapper">
        <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <a href="{{url('Add_Student')}}" class="btn btn-success ">Add Student</a>
                                    
                                 </div>
                              </div>
                              <br/>
<div class="col-md-12">@if(session()->has('message'))

<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
{{session()->get('message')}}
</div>
@endif
</div>


<!-- Way 1: Display All Error Messages -->
<div class="col-md-12">
           @if ($errors->any())
               <div class="alert alert-danger">
                   
                   <ul>
                       @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                       @endforeach
                   </ul>
               </div>
           @endif
         </div>

        <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="table-responsive pt-3">
                  <table class="table table-striped project-orders-table table_student">
                    <thead>
                      <tr>
                        <th class="ml-5">S/N</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Gender</th>
                        <th>Image	</th>
                     
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>



         
<script type="text/javascript">
  $(function () {
      
    var table = $('.table_student').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('View_students') }}",
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
          
            {data: 'lastname', name: 'lastname'},
            {data: 'firstname', name: 'firstname'},
            {data: 'gender', name: 'gender'},
            { data: 'image', name: 'image',
                    render: function( data, type, full, meta ) {
                        return "<img class='img-responsive rounded-circle' src=\"/image/thumbnails/" + data + "\" height=\"50\"/>";
                    }
                     },
          
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
  });
</script>


@include('user_template/js')