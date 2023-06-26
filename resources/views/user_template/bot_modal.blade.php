<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
  
</head>
<body>



<div class="container">

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


          </div>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_get_edit" role="dialog">
    <div class="modal-dialog">
       <form  method="post" id="MyForm" action="" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
               
                <h3 class="modal-title">Edit Student</h3>
                 <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                      <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Student LastName"  />
                        <input type="text" class="form-control" name="ids" id="ids" readonly />
                       
                      </div>

                      <div class="form-group">
                        <label for="lastname">First Name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Student FirstName"  />
                      </div>

                      <div class="form-group">
                <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                        
                          <option value="" selected="">Select Gender</option>
                          
                          <option value="Male">Male</option>
                          <option value="Male">Female</option>
                         
                        </select>
              </div>

               <div class="form-group">
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">

              <span id="user_upload_image"></span></div>
                <label for="image">image</label>
              <input type="file" id="student_image" name="student_image">
            </div>


                    </div>
              
            <div class="modal-footer">
                   <button type="submit" class="btn btn-primary mr-2">Update </button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            </div>
            
        </div><!-- /.modal-content -->
         </form>
  
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


         
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

<script type="text/javascript">

    $(document).ready(function () {
      
        $('body').on('click', '.edit_std', function () {
            var std_id = $(this).attr("id");

            var userURL = "{{ url('edit_student', ':std_id') }}";
          userURL = userURL.replace(':std_id', std_id);
            $.ajax({
         
               url:userURL,
               method:"GET",
               data:{std_id:std_id},
               dataType:"json",
               async: false,
               success:function(data)
         
                 {
              
                    $('#modal_get_edit').modal('show');
                     $('#ids').val(data.id);
                    
                    $('#lastname').val(data.Lastname);
                    $('#firstname').val(data.Firstname);
                      $('#gender').val(data.gender);
                    $('#user_upload_image').html(data.std_image2);
                    
             }
          });
        
            

             });
       
    });
  
</script>

  


</body>
</html>