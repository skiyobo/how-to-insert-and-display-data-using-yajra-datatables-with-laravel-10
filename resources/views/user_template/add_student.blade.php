@include('user_template/css')
@include('user_template/topbar')
@include('user_template/sidebar')

 <!-- partial -->
 <div class="main-panel">
        <div class="content-wrapper">
        <form action="{{ route('Save_Student')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label for="P_title">Last Name</label>
                  <input type="text"  class="form-control" name="lastname" placeholder="Enter Your Last Name" required="">
                </div>


         <div class="form-group">
        <label for="P_title">First Name</label>
                  <input type="text" class="form-control" name="firstname" placeholder="Enter Your First Name" required="">
                </div>

               
              <div class="form-group">
                <label for="gender">Gender</label>
                        <select class="form-control" name="gender">
                        
                          <option value="" selected="">Select Gender</option>
                          
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                         
                        </select>
              </div>

               <div class="form-group">
                <label for="image">image</label>
              <input type="file" id="student_image" name="student_image">
            </div>


             <div class="col-md-12 text-center">
              <button  type="submit" class="btn btn-primary">Submit</button>
              <a href="{{ url ('Homedashboard')}}" class="btn btn-success"><i class="fa fa-arrow-left" aria-hidden="true"> Go Back</i></a>
              </div>
        </form>




@include('user_template/js')