@extends('Layout.app')

@section('title','Contact')
@section('content')

<div id="mainDivContact" class="container d-none">
   <div class="row">
      <div class="col-md-12 p-5">
         <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th class="th-sm">Name</th>
                  <th class="th-sm">Mobile No</th>
                  <th class="th-sm">Email</th>
                  <th class="th-sm">Message</th>
                  <th class="th-sm">Delete</th>
               </tr>
            </thead>
            <tbody id="contact_table">
            </tbody>
         </table>
      </div>
   </div>
</div>
<div id="loaderDivContact" class="container">
   <div class="row">
      <div class="col-md-12 text-center p-5 ">
         <img class="loading-img m-5" src="{{asset('images/loader.svg')}}" alt="">
      </div>
   </div>
</div>
<div id="wrongDivContact" class="container d-none">
   <div class="row">
      <div class="col-md-12 text-center p-5">
         <h3>Something Went Wrong !</h3>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModalContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-body p-3 text-center">
            <h6 class="mt-4">Do You Want To Delete?</h6>
            <h5 id="contactDeleteId" class="mt-4 d-none">   </h5>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
            <button  id="contactDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
         </div>
      </div>
   </div>
</div>



@endsection




@section('script')

<script type="text/javascript">

getContactData();
  // for Contact table
function getContactData() {

axios.get('/getContactData')
    .then(function(response) {


        if (response.status == 200) {
            $('#mainDivContact').removeClass('d-none');
            $('#loaderDivContact').addClass('d-none');
            $('#contactDataTable').DataTable().destroy()
            $('#contact_table').empty();


            var jsonData = response.data;


            $.each(jsonData, function(i, item) {
                $('<tr>').html(

                    "<td>" + jsonData[i].contact_name + " </td>" +
                    "<td>" + jsonData[i].contact_mobile + "</td>" +
                    "<td>" + jsonData[i].contact_email + "</td>" +
                    "<td>" + jsonData[i].contact_message + "</td>" +

                    "<td><a class='contactDeleteBtn'  data-id=" + jsonData[i].id + "  ><i class='fas fa-trash-alt'></i></a> </td>"

                ).appendTo('#contact_table')

            });


            // Contact Table Delete Icon Click
            $('.contactDeleteBtn').click(function() {
                var id = $(this).data('id');
                $('#contactDeleteId').html(id);
                $('#deleteModalContact').modal('show');
            })


            $('#contactDataTable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');
              
        } else {
            $('#loaderDivContact').addClass('d-none');
            $('#wrongDivContact').removeClass('d-none');
        }

    })
    .catch(function(error) {
        $('#loaderDivContact').addClass('d-none');
        $('#wrongDivContact').removeClass('d-none');

    });

}
// Contact Delete Modal Yes Btn
$('#contactDeleteConfirmBtn').click(function() {
var id = $('#contactDeleteId').html();
ContactDelete(id);
})
// Contact Delete
function ContactDelete(deleteID) {
$('#contactDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
axios.post('/ContactDelete', {
        id: deleteID
    })
    .then(function(response) {
        $('#contactDeleteConfirmBtn').html("Yes")
        if (response.status == 200) {
            if (response.data == 1) {
                $('#deleteModalContact').modal('hide');
                toastr.success('Delete Success');
                getContactData();
            } else {
                $('#deleteModalContact').modal('hide');
                toastr.error('Delete Fail');
                getContactData();
            }
        } else {
            $('#deleteModalContact').modal('hide');
            toastr.error('Something Went Wrong');
            getContactData();


        }


    })

    .catch(function(error) {
        $('#deleteModalContact').modal('hide');
            toastr.error('Something Went Wrong');
            getContactData();
    });

}


</script>

@endsection