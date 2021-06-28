@extends('Layout.app')
@section('title','Team')

@section('content')



<div id="mainDivTeam" class="container d-none">
   <div class="row">
      <div class="col-md-12 p-5">
      <button id="teamAddNewBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
         <table id="teamDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th class="th-sm">Image</th>
                  <th class="th-sm">Name</th>
                  <th class="th-sm">Designation</th>
                  <th class="th-sm">Edit</th>
                  <th class="th-sm">Delete</th>
               </tr>
            </thead>
            <tbody id="team_table">
            </tbody>
         </table>
      </div>
   </div>
</div>
<div id="loaderDivTeam" class="container">
   <div class="row">
      <div class="col-md-12 text-center p-5 ">
         <img class="loading-img m-5" src="{{asset('images/loader.svg')}}" alt="">
      </div>
   </div>
</div>
<div id="wrongDivTeam" class="container d-none">
   <div class="row">
      <div class="col-md-12 text-center p-5">
         <h3>Something Went Wrong !</h3>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModalTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-body p-3 text-center">
            <h6 class="mt-4">Do You Want To Delete?</h6>
            <h5 id="teamDeleteId" class="mt-4 d-none">   </h5>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
            <button  id="teamDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="addModalTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog " role="document">
   <form id="teamForm">
      <div class="modal-content">
      
         <div class="modal-body p-5 text-center">
       
            <div id="teamAddForm" class="w-100">
               <h5 class="mb-4">Add New Team Member</h5>
               
              <input type="text" id="teamNameAddID" class="form-control mb-4" placeholder="Name" />
               <textarea type="text" id="teamDesAddID" class="form-control mb-4" placeholder=" Designation" ></textarea>
               <input type="text" id="teamDesAddID" class="form-control mb-4" placeholder="Image Link" />
               
              
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
            <button  id="teamAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
         </div>
         
      </div>
      </form>
   </div>
</div>
<div class="modal fade" id="editModalTeam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-body p-5 text-center">
        
            <h5 id="teamEditId" class="mt-4 d-none">   </h5>
            <div id="teamEditForm" class="w-100  d-none">
            <h5 class="mb-4">Team Member Update</h5>
            
              <input type="text" id="teamEditNameID" class="form-control mb-4" placeholder="Name" />
              <textarea type="text" id="teamEditDesID" class="form-control mb-4" placeholder=" Designation" ></textarea>
              <input type="text" id="teamEditImgID" class="form-control mb-4" placeholder=" Image Link" />
            </div>
            
            <img id="teamEditLoader" class="loading-img m-5" src="{{asset('images/loader.svg')}}" alt="">
            <h5 id="teamEditWrong" class="d-none">Something Went Wrong !</h5>
         
         
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
            <button  id="teamEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
         </div>
      </div>
   </div>
</div>

@endsection

@section('script')
 
<script type="text/javascript">

getTeamData();
  // for team table
function getTeamData() {

axios.get('/getTeamData')
    .then(function(response) {


        if (response.status == 200) {
            $('#mainDivTeam').removeClass('d-none');
            $('#loaderDivTeam').addClass('d-none');
            $('#teamDataTable').DataTable().destroy()
            $('#team_table').empty();


            var jsonData = response.data;


            $.each(jsonData, function(i, item) {
                $('<tr>').html(

                    "<td><img class='table-img' src=" + jsonData[i].image + "> </td>" +
                    "<td>" + jsonData[i].name + "</td>" +
                    "<td>" + jsonData[i].designation + "</td>" +
                    "<td><a class='teamEditBtn' data-id=" + jsonData[i].id + "  ><i class='fas fa-edit'></i></a> </td>" +

                    "<td><a class='teamDeleteBtn'  data-id=" + jsonData[i].id + "  ><i class='fas fa-trash-alt'></i></a> </td>"

                ).appendTo('#team_table')

            });


            // Team Table Delete Icon Click
            $('.teamDeleteBtn').click(function() {
                var id = $(this).data('id');
                $('#teamDeleteId').html(id);
                $('#deleteModalTeam').modal('show');
            })



            // team Table Edit Icon Click
            $('.teamEditBtn').click(function() {
                var id = $(this).data('id');
                $('#teamEditId').html(id);
                TeamUpdateDetails(id)
                $('#editModalTeam').modal('show');
            })

            $('#teamDataTable').DataTable({"order":false});
            $('.dataTables_length').addClass('bs-select');
              
        } else {
            $('#loaderDivTeam').addClass('d-none');
            $('#wrongDivTeam').removeClass('d-none');
        }

    })
    .catch(function(error) {
        $('#loaderDivTeam').addClass('d-none');
        $('#wrongDivTeam').removeClass('d-none');

    });

}


//Team Delete Modal Yes Btn
$('#teamDeleteConfirmBtn').click(function() {
var id = $('#teamDeleteId').html();
TeamDelete(id);
})
// team Delete
function TeamDelete(deleteID) {
$('#teamDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
axios.post('/TeamDelete', {
        id: deleteID
    })
    .then(function(response) {
        $('#teamDeleteConfirmBtn').html("Yes")
        if (response.status == 200) {
            if (response.data == 1) {
                $('#deleteModalTeam').modal('hide');
                toastr.success('Delete Success');
                getTeamData();
            } else {
                $('#deleteModalTeam').modal('hide');
                toastr.error('Delete Fail');
                getTeamData();
            }
        } else {
            $('#deleteModalTeam').modal('hide');
            toastr.error('Something Went Wrong');
            getTeamData();


        }


    })

    .catch(function(error) {

    });

}



//Team Add New Btn Click
$('#teamAddNewBtnId').click(function() {

$('#addModalTeam').modal('show');
});

// Services Add Modal Save Btn
$('#teamAddConfirmBtn').click(function() {

var name = $('#teamNameAddID').val();
var des = $('#teamDesAddID').val();
var img = $('#teamDesAddID').val();
TeamAdd(name, des, img);
})

// Service Add Method
function TeamAdd(teamName, teamDes, teamImg) {
if (teamName.length == 0) {
    toastr.error('Name is Empty');
} else if (teamDes.length == 0) {
    toastr.error('Designation is Empty');
} else if (teamImg.length == 0) {
    toastr.error('Image is Empty');
} else {
    $('#teamAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/TeamAdd', {

            name: teamName,
            des: teamDes,
            img: teamImg,
        })
        .then(function(response) {
            $('#teamAddConfirmBtn').html("Save")
            
            if (response.status == 200) {
                
                if (response.data == 1) {
                   
                   $('#addModalTeam').modal('hide');
                        toastr.success('Add Success');
                        getTeamData();
                    
                       
                       
                 
                } else {
                    $('#addModalTeam').modal('hide');
                    toastr.error('Add Fail');
                    getTeamData();

                }

            } else {
                $('#addModalTeam').modal('hide');
                toastr.error('Something Went Wrong !');
                getTeamData();
            }



        })

        .catch(function(error) {
            $('#addModalTeam').modal('hide');
            toastr.error('Something Went Wrong !');
            getTeamData();
        });
}


}


// Team Update Modal Save Btn
$('#teamEditConfirmBtn').click(function() {
var id = $('#teamEditId').html();
var name = $('#teamEditNameID').val();
var des = $('#teamEditDesID').val();
var img = $('#teamEditImgID').val();
TeamUpdate(id, name, des, img);
})
//Each team Update Details
function TeamUpdateDetails(detailsID) {
axios.post('/TeamDetails', {
        id: detailsID
    })
    .then(function(response) {
        if (response.status == 200) {
            $('#teamEditForm').removeClass('d-none');
            $('#teamEditLoader').addClass('d-none');
            var jsonData = response.data;
            $('#teamEditNameID').val(jsonData[0].name);
            $('#teamEditDesID').val(jsonData[0].designation);
            $('#teamEditImgID').val(jsonData[0].image);
        } else {
            $('#teamEditWrong').removeClass('d-none');
            $('#teamEditLoader').addClass('d-none');
        }


    })

    .catch(function(error) {

    });

}

//team update method
function TeamUpdate(teamID, teamName, teamDes, teamImg) {
if (teamID.length == 0) {

} else if (teamName.length == 0) {
    toastr.error('Name is Empty');
} else if (teamDes.length == 0) {
    toastr.error('Designation is Empty');
} else if (teamImg.length == 0) {
    toastr.error('Image is Empty');
} else {
    $('#teamEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/TeamUpdate', {
            id: teamID,
            name: teamName,
            des: teamDes,
            img: teamImg,
        })
        .then(function(response) {
            $('#teamEditConfirmBtn').html("Save")
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#editModalTeam').modal('hide');
                    toastr.success('Update Success');
                    getTeamData();

                } else {
                    $('#editModalTeam').modal('hide');
                    toastr.error('Update Fail');
                    getTeamData();

                }

            } else {
                $('#editModalTeam').modal('hide');
                toastr.error('Something Went Wrong !');
                getTeamData();

            }



        })

        .catch(function(error) {
            $('#editModalTeam').modal('hide');
            toastr.error('Something Went Wrong  !');
            getTeamData();

        });
}


}
</script>

@endsection