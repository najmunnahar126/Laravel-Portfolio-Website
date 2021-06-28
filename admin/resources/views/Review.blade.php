@extends('Layout.app')
@section('title','Review')

@section('content')


<div id="mainDivReview" class="container d-none">
  <div class="row">
    <div class="col-md-12 p-5">
      <button id="reviewAddNewBtnId" class="btn my-3 btn-sm btn-danger">Add New 
      </button>
      <table id="reviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th class="th-sm">Image
            </th>
            <th class="th-sm">Name
            </th>
            <th class="th-sm">Description
            </th>
            <th class="th-sm">Edit
            </th>
            <th class="th-sm">Delete
            </th>
          </tr>
        </thead>
        <tbody id="review_table">
        </tbody>
      </table>
    </div>
  </div>
</div>
<div id="loaderDivReview" class="container">
  <div class="row">
    <div class="col-md-12 text-center p-5 ">
      <img class="loading-img m-5" src="{{asset('images/loader.svg')}}" alt="">
    </div>
  </div>
</div>
<div id="wrongDivReview" class="container d-none">
  <div class="row">
    <div class="col-md-12 text-center p-5">
      <h3>Something Went Wrong !
      </h3>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deleteModalReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-3 text-center">
        <h6 class="mt-4">Do You Want To Delete?
        </h6>
        <h5 id="reviewDeleteId" class="mt-4 d-none">   
        </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No
        </button>
        <button  id="reviewDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes
        </button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addModalReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
  <div class="modal-dialog " role="document">
    <form id="reviewForm">
      <div class="modal-content">
        <div class="modal-body p-5 text-center">
          <div id="reviewAddForm" class="w-100">
            <h5 class="mb-4">Add New Review
            </h5>
            <input type="text" id="reviewNameAddID" class="form-control mb-4" placeholder="Name" />
            <textarea type="text" id="reviewDesAddID" class="form-control mb-4" placeholder="Description" >
            </textarea>
            <input type="text" id="reviewDesAddID" class="form-control mb-4" placeholder="Image Link" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel
          </button>
          <button  id="reviewAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="editModalReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-body p-5 text-center">
        <h5 id="reviewEditId" class="mt-4 d-none">   
        </h5>
        <div id="reviewEditForm" class="w-100  d-none">
          <h5 class="mb-4">Review Update
          </h5>
          <input type="text" id="reviewEditNameID" class="form-control mb-4" placeholder="Name" />
          <textarea type="text" id="reviewEditDesID" class="form-control mb-4" placeholder="Description" >
          </textarea>
          <input type="text" id="reviewEditImgID" class="form-control mb-4" placeholder="Image Link" />
        </div>
        <img id="reviewEditLoader" class="loading-img m-5" src="{{asset('images/loader.svg')}}" alt="">
        <h5 id="reviewEditWrong" class="d-none">Something Went Wrong !
        </h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel
        </button>
        <button  id="reviewEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<script type="text/javascript">

getReviewData();
// for Review table
function getReviewData() {

    axios.get('/getReviewData')
        .then(function(response) {


            if (response.status == 200) {
                $('#mainDivReview').removeClass('d-none');
                $('#loaderDivReview').addClass('d-none');
                $('#reviewDataTable').DataTable().destroy()
                $('#review_table').empty();


                var jsonData = response.data;


                $.each(jsonData, function(i, item) {
                    $('<tr>').html(

                        "<td><img class='table-img' src=" + jsonData[i].img + "> </td>" +
                        "<td>" + jsonData[i].name + "</td>" +
                        "<td>" + jsonData[i].des + "</td>" +
                        "<td><a class='reviewEditBtn' data-id=" + jsonData[i].id + "  ><i class='fas fa-edit'></i></a> </td>" +

                        "<td><a class='reviewDeleteBtn'  data-id=" + jsonData[i].id + "  ><i class='fas fa-trash-alt'></i></a> </td>"

                    ).appendTo('#review_table')

                });


                //Review Table Delete Icon Click
                $('.reviewDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#reviewDeleteId').html(id);
                    $('#deleteModalReview').modal('show');
                })



                // Review Table Edit Icon Click
                $('.reviewEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#reviewEditId').html(id);
                    ReviewUpdateDetails(id)
                    $('#editModalReview').modal('show');
                })

                $('#reviewDataTable').DataTable({
                    "order": false
                });
                $('.dataTables_length').addClass('bs-select');

            } else {
                $('#loaderDivReview').addClass('d-none');
                $('#wrongDivReview').removeClass('d-none');
            }

        })
        .catch(function(error) {
            $('#loaderDivReview').addClass('d-none');
            $('#wrongDivReview').removeClass('d-none');

        });

}


//Review Delete Modal Yes Btn
$('#reviewDeleteConfirmBtn').click(function() {
    var id = $('#reviewDeleteId').html();
    ReviewDelete(id);
})
//Review Delete
function ReviewDelete(deleteID) {
    $('#reviewDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/ReviewDelete', {
            id: deleteID
        })
        .then(function(response) {
            $('#reviewDeleteConfirmBtn').html("Yes")
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#deleteModalReview').modal('hide');
                    toastr.success('Delete Success');
                    getReviewData();
                } else {
                    $('#deleteModalReview').modal('hide');
                    toastr.error('Delete Fail');
                    getReviewData();
                }
            } else {
                $('#deleteModalReview').modal('hide');
                toastr.error('Something Went Wrong');
                getReviewData();


            }


        })

        .catch(function(error) {

        });

}

//Review Add New Btn Click
$('#reviewAddNewBtnId').click(function() {

    $('#addModalReview').modal('show');
});

// Review Add Modal Save Btn
$('#reviewAddConfirmBtn').click(function() {

    var name = $('#reviewNameAddID').val();
    var des = $('#reviewDesAddID').val();
    var img = $('#reviewDesAddID').val();
    ReviewAdd(name, des, img);
})

// review Add Method
function ReviewAdd(reviewName, reviewDes, reviewImg) {
    if (reviewName.length == 0) {
        toastr.error('Name is Empty');
    } else if (reviewDes.length == 0) {
        toastr.error('Description is Empty');
    } else if (reviewImg.length == 0) {
        toastr.error('Image is Empty');
    } else {
        $('#reviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios.post('/ReviewAdd', {

                name: reviewName,
                des: reviewDes,
                img: reviewImg,
            })
            .then(function(response) {
                $('#reviewAddConfirmBtn').html("Save")

                if (response.status == 200) {

                    if (response.data == 1) {

                        $('#addModalReview').modal('hide');
                        toastr.success('Add Success');
                        getReviewData();




                    } else {
                        $('#addModalReview').modal('hide');
                        toastr.error('Add Fail');
                        getReviewData();

                    }

                } else {
                    $('#addModalReview').modal('hide');
                    toastr.error('Something Went Wrong !');
                    getReviewData();
                }



            })

            .catch(function(error) {
                $('#addModalReview').modal('hide');
                toastr.error('Something Went Wrong !');
                getReviewData();
            });
    }


}


// review Update Modal Save Btn
$('#reviewEditConfirmBtn').click(function() {
    var id = $('#reviewEditId').html();
    var name = $('#reviewEditNameID').val();
    var des = $('#reviewEditDesID').val();
    var img = $('#reviewEditImgID').val();
    ReviewUpdate(id, name, des, img);
})
//Each review Update Details
function ReviewUpdateDetails(detailsID) {
    axios.post('/ReviewDetails', {
            id: detailsID
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#reviewEditForm').removeClass('d-none');
                $('#reviewEditLoader').addClass('d-none');
                var jsonData = response.data;
                $('#reviewEditNameID').val(jsonData[0].name);
                $('#reviewEditDesID').val(jsonData[0].des);
                $('#reviewEditImgID').val(jsonData[0].img);
            } else {
                $('#reviewEditWrong').removeClass('d-none');
                $('#reviewEditLoader').addClass('d-none');
            }


        })

        .catch(function(error) {

        });

}

//Review update method
function ReviewUpdate(reviewID, reviewName, reviewDes, reviewImg) {
    if (reviewID.length == 0) {

    } else if (reviewName.length == 0) {
        toastr.error('Name is Empty');
    } else if (reviewDes.length == 0) {
        toastr.error('Description is Empty');
    } else if (reviewImg.length == 0) {
        toastr.error('Image is Empty');
    } else {
        $('#reviewEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios.post('/ReviewUpdate', {
                id: reviewID,
                name: reviewName,
                des: reviewDes,
                img: reviewImg,
            })
            .then(function(response) {
                $('#reviewEditConfirmBtn').html("Save")
                if (response.status == 200) {
                    if (response.data == 1) {
                        $('#editModalReview').modal('hide');
                        toastr.success('Update Success');
                        getReviewData();

                    } else {
                        $('#editModalReview').modal('hide');
                        toastr.error('Update Fail');
                        getReviewData();

                    }

                } else {
                    $('#editModalReview').modal('hide');
                    toastr.error('Something Went Wrong !');
                    getReviewData();

                }



            })

            .catch(function(error) {
                $('#editModalReview').modal('hide');
                toastr.error('Something Went Wrong  !');
                getReviewData();

            });
    }


}

</script>

@endsection