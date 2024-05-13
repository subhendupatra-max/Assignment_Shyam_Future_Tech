<!DOCTYPE html>
<html lang="en">
<head>
  <title>Assignment For Shyam Future Tech Pvt Ltd </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<div class="container">
 
  <div class="col-md-12">
    <div class="row">
      <div class="col-md-6">
      <h2>Tester List</h2>
      </div>
      <div class="col-md-6 text-right">
      <button type="button" class="btn btn-info add_button" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Add Tester</button>
      </div>
    </div>
  </div>
  <div id="tester_data">  
  <table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Image</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$item)
      <tr>
        <td>{{@$item['tester_id']}}</td>
        <td>{{@$item['tester_name']}}</td>
        <td>
          @if(@$item['tester_image'] != null)
            <a  onclick="view_image('{{@$item['tester_image']}}')" target="_blank"><img src="{{ asset('/assets/images') }}/{{@$item['tester_image']}}" height="30px" weight="30px"></a>
          @endif
        </td>
        <td>{{@$item['address']}}</td>
        <td>{{@$item['gender']}}</td>
        <td>
          <a href="#" onclick="viewDetails('{{@$item['tester_id']}}')" class="fa fa-eye a_tag" data-toggle="tooltip" data-placement="top" title="View"></a>

          <a href="#" class="fa fa-edit a_tag" onclick="detailsedit('{{@$item['tester_id']}}')" data-toggle="tooltip" data-placement="top" title="Edit"></a>

          <a href="#" onclick="confirmDelete('{{@$item['tester_id']}}')" class="fa fa-trash a_tag" data-toggle="tooltip" data-placement="top" title="Delete"></a>

        </td>
      </tr>
    @endforeach
    
    </tbody>
  </table>
  </div>
</div>
<!-- //================save details modal ============================================= -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Add New Tester</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formDataForm" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
              <label for="tester_name">Tester Id<span class="text-danger">*</span> : </label>
              <input type="text" required class="form-control" id="tester_id" placeholder="Enter Id" name="tester_id">
            </div>
            <div class="form-group">
              <label for="tester_name">Name:</label>
              <input type="text" class="form-control" id="tester_name" placeholder="Enter Name" name="tester_name">
            </div>
            <div class="form-group">
              <label >Address:</label>
              <textarea class="form-control" name="address"></textarea>
            </div>
            <div class="form-group">
              <label>Gender:</label><br>
              <label class="radio-inline"><input type="radio" name="gender" value="Male" checked>Male</label>
              <label class="radio-inline"><input type="radio" value="Female" name="gender">Female</label>
            </div>
            <div class="form-group">
              <label for="image">Image:</label>
              <input type="file" class="form-control" id="image"  name="tester_image">
            </div>
    
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
          </form>
      
      </div>
    </div>
  </div>
</div>
<!-- //================save details modal ============================================= -->

<!-- //================show details modal ============================================= -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"> Tester Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <img src="" id="viewimage" style="max-height: 50px;" />
     
            <div class="form-group">
              <label>Tester Id : <span id="tester_id1"></span></label>
            </div>
            <div class="form-group">
              <label>Tester Name : <span id="tester_name1"></span>  </label>
            </div>
            <div class="form-group">
              <label>Tester Address : <span id="address1"></span>  </label>
            </div>
            <div class="form-group">
              <label>Tester Gender : <span id="gender1"></span> </label>
            </div>
         
      
      </div>
    </div>
  </div>
</div>
<!-- //================show details modal ============================================= -->

<!-- //================edit details modal ============================================= -->
<div class="modal fade" id="editmyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Update Tester Details</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="formDataFormEDIT" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
              <label for="tester_name">Tester Id<span class="text-danger">*</span> : </label>
              <input type="text" required class="form-control" readonly id="tester_id_edit" placeholder="Enter Id" name="tester_id">
            </div>
            <div class="form-group">
              <label for="tester_name">Name:</label>
              <input type="text" class="form-control" id="tester_name_edit" placeholder="Enter Name" name="tester_name">
            </div>
            <div class="form-group">
              <label >Address:</label>
              <textarea class="form-control" name="address" id="address_edit"></textarea>
            </div>
            <div class="form-group">
              <label>Gender:</label><br>
              <label class="radio-inline"><input type="radio" name="gender" value="Male" id="male_edit">Male</label>
              <label class="radio-inline"><input type="radio" value="Female" name="gender" id="female_edit" >Female</label>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" name="tester_image">
                <input type="hidden" class="form-control" id="image_edit" name="old_tester_image">
            </div>
            <div class="form-group">
                <label>Current Image:</label><br>
                <img src="" id="current_image" style="max-height: 50px;" />
            </div>
    
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
          </form>
      
      </div>
    </div>
  </div>
</div>
<!-- //================edit details modal ============================================= -->


<!-- //================ image viewer modal ============================================= -->
<div class="modal fade" id="imageViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src="" id="view_image" style="max-height: 270px;"  />
      </div>
    </div>
  </div>
</div>
<!-- //================image viewer modal ============================================= -->

<script>


  //=========== save data ========================
  $(document).ready(function(){
      $('#myModal').on('shown.bs.modal', function () {
          $('#myInput').trigger('focus');
      });

      $('#formDataForm').submit(function(event) {
          event.preventDefault();
          
          var formData = new FormData($(this)[0]); 
    
          $.ajax({
              type: "POST",
              url: "/submit",
              data: formData,
              contentType: false, 
              processData: false, 
              success: function(response) {
                  $('#myModal').modal('hide');
                  $('#tester_data').load(document.URL +  ' #tester_data');
                  alert(response.message);
              },
              error: function(xhr, status, error) {
                  console.error(xhr.responseText);
              }
          });
      });
  });
  //=========== save data ========================
  //=========== update data ========================
  $(document).ready(function(){
      $('#myModal').on('shown.bs.modal', function () {
          $('#myInput').trigger('focus');
      });

      $('#formDataFormEDIT').submit(function(event) {
          event.preventDefault();
          
          var formData = new FormData($(this)[0]); 
    
          $.ajax({
              type: "POST",
              url: "/update",
              data: formData,
              contentType: false, 
              processData: false, 
              success: function(response) {
                  $('#editmyModal').modal('hide');
                  $('#tester_data').load(document.URL +  ' #tester_data');
                  alert(response.message);
              },
              error: function(xhr, status, error) {
                  console.error(xhr.responseText);
              }
          });
      });
  });
  //=========== update data ========================


  function confirmDelete(record_id) {
      var isConfirmed = confirm("Are you sure you want to delete this record");
      if (isConfirmed) {
        $.ajax({
              url: "{{ route('deleteTester') }}",
              type: "POST",
              data: {
                  _token: '{{ csrf_token() }}',
                  recordId: record_id,
              },

              success: function(response) {
                  alert(response.message);
                  $('#tester_data').load(document.URL +  ' #tester_data');
              },
              error: function(error) {
                  console.log(error);
              }
          });
      } else {

      }
  }

  //=========== view details ========================
  function viewDetails(record_id) {

        $.ajax({
              url: "{{ route('viewTesterDetails') }}",
              type: "POST",
              data: {
                  _token: '{{ csrf_token() }}',
                  recordId: record_id,
              },

              success: function(response) {
                console.log(response);
                  $('#tester_id1').text(response.tester_id);
                  $('#tester_name1').text(response.tester_name);
                  $('#gender1').text(response.gender);
                  $('#address1').text(response.address);
                  $('#viewimage').attr('src', '{{ asset('/assets/images') }}/' + response.tester_image);
                  $('#myModal1').modal('show');
              },
              error: function(error) {
                  console.log(error);
              }
          });

  }
  //=========== view details ========================

function view_image(img_name){
  $('#view_image').attr('src', '{{ asset('/assets/images') }}/' + img_name);
  $('#imageViewModal').modal('show');
}
  function detailsedit(record_id) {
    $.ajax({
          url: "{{ route('viewTesterDetails') }}",
          type: "POST",
          data: {
              _token: '{{ csrf_token() }}',
              recordId: record_id,
          },

          success: function(response) {
            console.log(response);
              $('#tester_id_edit').val(response.tester_id);
              $('#tester_name_edit').val(response.tester_name);
              if(response.gender == 'male'){
                $('#male_edit').attr('checked', true);
              }
              else{
                $('#female_edit').attr('checked', true);
              }
              $('#address_edit').val(response.address);
              if(response.tester_image) {
                $('#current_image').attr('src', '{{ asset('/assets/images') }}/' + response.tester_image);
            } else {
                $('#current_image').hide();
            }
            $('#image_edit').val(response.tester_image);
              $('#editmyModal').modal('show');
          },
          error: function(error) {
              console.log(error);
          }
      });

  }
</script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
