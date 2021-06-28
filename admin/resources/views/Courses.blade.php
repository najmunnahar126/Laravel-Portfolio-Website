@extends('Layout.app')
@section('title','Courses')
@section('content')

<div id="mainDivCourse" class="container d-none">
   <div class="row">
      <div class="col-md-12 p-3">
	  <button id="addNewCourseBtnId" class="btn my-3 btn-sm btn-danger">Add New  </button>
         <table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th class="th-sm">Course Name</th>
                  <th class="th-sm">Course Fee</th>
                  <th class="th-sm">Total Classes</th>
                  <th class="th-sm">Total Enroll</th>
                  <th class="th-sm">Details</th>
                  <th class="th-sm">Edit</th>
                  <th class="th-sm">Delete</th>
               </tr>
            </thead>
            <tbody id="course_table">

            </tbody>
         </table>
      </div>
   </div>
</div>

<div id="loaderDivCourse" class="container">
   <div class="row">
      <div class="col-md-12 text-center p-5 ">
         <img class="loading-img m-5" src="{{asset('images/loader.svg')}}" alt="">
      </div>
   </div>
</div>
<div id="wrongDivCourse" class="container d-none">
   <div class="row">
      <div class="col-md-12 text-center p-5">
         <h3>Something Went Wrong !</h3>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title mt-2  ml-2">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="course_modal" class="modal-body  text-center">
       <div class="container">
       	<div id="modaltext"  class="row">
       		<div class="col-md-6">
            <div >
            <input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
            <textarea id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description"></textarea>
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll"></div>
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="deleteCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-body p-3 text-center">
            <h6 class="mt-4">Do You Want To Delete?</h6>
            <h5 id="courseDeleteId" class="mt-4 d-none">   </h5>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
            <button  id="courseDeleteConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Yes</button>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title mt-2  ml-2">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">

       <div id="courseEditForm" class="container d-none">
       <h5 id="courseEditId" class="mt-4 d-none">   </h5>
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
            <textarea type="text" id="CourseDesUpdateId" class="form-control mb-3" placeholder="Course Description" ></textarea>
    		 	<input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<textarea id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link"></textarea>
     			<input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
                   
          <img id="courseEditLoader" class="loading-img m-5" src="{{asset('images/loader.svg')}}" alt="">
          <h5 id="courseEditWrong" class="d-none">Something Went Wrong !</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="detailsCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title mt-2  ml-2"> Course Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">

       <div id="courseDetailsForm" class="container d-none">
         <h5 id="courseDetailsId" class="mt-4 d-none">   </h5>
       	<div class="row">
       		<div class="col-md-12">
                           <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
                           <thead>
                              <tr>
                                 <th class="th-sm">Course Name</th>
                                 <th class="th-sm">Course Fee</th>
                                 <th class="th-sm">Total Classes</th>
                                 <th class="th-sm">Total Enroll</th>
                                 <th class="th-sm">Course Details</th>
                                 <th class="th-sm">Course Link</th>
                                 <th class="th-sm">Course Image Link</th>
                              </tr>
                           </thead>
                           <tbody id="course_Details_table">

                           </tbody>
                        </table>
       		</div>
       		
       	</div>
       </div>
                   
          <img id="courseDetailsLoader" class="loading-img m-5" src="{{asset('images/loader.svg')}}" alt="">
          <h5 id="courseDetailsWrong" class="d-none">Something Went Wrong !</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection




@section('script')
 
 <script type="text/javascript">
getCoursesData()


function getCoursesData() {

axios.get('/getCoursesData')
    .then(function(response) {


        if (response.status == 200) {
            $('#mainDivCourse').removeClass('d-none');
            $('#loaderDivCourse').addClass('d-none');
            
            $('#courseDataTable').DataTable().destroy()
            $('#course_table').empty();

            var jsonData = response.data;


            $.each(jsonData, function(i, item) {
                $('<tr>').html(

                    "<td>"+jsonData[i].course_name+"</td>" +
                    "<td>"+jsonData[i].course_fee+"</td>" +
                    "<td>"+jsonData[i].course_totalclass+"</td>" +
                    "<td>"+jsonData[i].course_totalenroll+"</td>" +
                    "<td><a class='courseViewDetailsBtn' data-id=" + jsonData[i].id + "  ><i class='fas fa-eye'></i></a> </td>" +
                    "<td><a class='courseEditBtn' data-id=" + jsonData[i].id + "  ><i class='fas fa-edit'></i></a> </td>" +
                    "<td><a class='courseDeleteBtn'  data-id=" + jsonData[i].id + "  ><i class='fas fa-trash-alt'></i></a> </td>"

                ).appendTo('#course_table')

            });

                // Courses Table Delete Icon Click
                $('.courseDeleteBtn').click(function() {
                    var id = $(this).data('id');
                    $('#courseDeleteId').html(id);
                    $('#deleteCourseModal').modal('show');
                })

                // Course Table Edit Icon Click
                $('.courseEditBtn').click(function() {
                    var id = $(this).data('id');
                    $('#courseEditId').html(id);
                    CourseUpdateDetails(id)
                    $('#updateCourseModal').modal('show');
                })

                    // Course Table View Details Icon Click
                    $('.courseViewDetailsBtn').click(function() {
                        var id = $(this).data('id');
                        $('#courseDetailsId').html(id);
                        EachCourseDetails(id)
                        $('#detailsCourseModal').modal('show');
                    })
        
                    $('#courseDataTable').DataTable({"order":false});
                    $('.dataTables_length').addClass('bs-select');

        } else {
            $('#loaderDivCourse').addClass('d-none');
            $('#wrongDivCourse').removeClass('d-none');
        }

    })
    .catch(function(error) {
        $('#loaderDivCourse').addClass('d-none');
        $('#wrongDivCourse').removeClass('d-none');

    });

}

//Course Add New Btn Click
$('#addNewCourseBtnId').click(function() {

    $('#addCourseModal').modal('show');
    });

// Course Add Modal Save Btn
$('#CourseAddConfirmBtn').click(function() {

var name = $('#CourseNameId').val();
var des = $('#CourseDesId').val();
var fee = $('#CourseFeeId').val();
var totalenroll = $('#CourseEnrollId').val();
var totalclass = $('#CourseClassId').val();
var link = $('#CourseLinkId').val();
var img = $('#CourseImgId').val();
CourseAdd(name, des, fee,totalenroll,totalclass,link, img);
});

// Course Add Method
function CourseAdd(CourseName, CourseDes, CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg) {
if (CourseName.length == 0) {
    toastr.error('Course Name is Empty');
} else if (CourseDes.length == 0) {
    toastr.error('Course Description is Empty');
}
else if (CourseFee.length == 0) {
    toastr.error('Course Fee is Empty');
}
else if (CourseEnroll.length == 0) {
    toastr.error('Course Total Enroll is Empty');
}
else if (CourseClass.length == 0) {
    toastr.error('Course Total Classes is Empty');
}
else if (CourseLink.length == 0) {
    toastr.error('Course Link is Empty');
} else if (CourseImg.length == 0) {
    toastr.error('Course Image is Empty');
} else {
    $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    
    axios.post('/CoursesAdd', {

        course_name: CourseName,
        course_des: CourseDes,
        course_fee: CourseFee,
        course_totalenroll: CourseEnroll,
        course_totalclass: CourseClass,
        course_link: CourseLink,

        course_img: CourseImg,
        })
        .then(function(response) {
            $('#CourseAddConfirmBtn').html("Save")
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#addCourseModal').modal('hide');
                    toastr.success('Add Success');
                    getCoursesData();

                } else {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Add Fail');
                    getCoursesData();

                }

            } else {
                $('#addCourseModal').modal('hide');
                toastr.error('Something Went Wrong !');
                getCoursesData();
            }



        })

        .catch(function(error) {
            $('#addCourseModal').modal('hide');
            toastr.error('Something Went Wrong !');
            getCoursesData();
        });
}


}


// Course Delete Modal Yes Btn
$('#courseDeleteConfirmBtn').click(function() {
var id = $('#courseDeleteId').html();
CourseDelete(id);
})
// Course Delete
function CourseDelete(deleteID) {
$('#courseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
axios.post('/CoursesDelete', {
        id: deleteID
    })
    .then(function(response) {
        $('#courseDeleteConfirmBtn').html("Yes")
        if (response.status == 200) {
            if (response.data == 1) {
                $('#deleteCourseModal').modal('hide');
                toastr.success('Delete Success');
                getCoursesData();
            } else {
                $('#deleteCourseModal').modal('hide');
                toastr.error('Delete Fail');
                getCoursesData();
            }
        } else {
            $('#deleteCourseModal').modal('hide');
            toastr.error('Something Went Wrong');
            getCoursesData();


        }


    })

    .catch(function(error) {

    });



}

//Each Course View Details
function EachCourseDetails(viewDetailsID){
axios.post('/EachCoursesDetails', {
id: viewDetailsID
})
.then(function(response) {
if (response.status == 200) {
$('#courseDetailsForm').removeClass('d-none');
$('#courseDetailsLoader').addClass('d-none');
$('#course_Details_table').empty();
var jsonData = response.data;
$.each(jsonData, function(i, item) {
    $('<tr>').html(

        "<td>"+jsonData[i].course_name+"</td>" +
        "<td>"+jsonData[i].course_fee+"</td>" +
        "<td>"+jsonData[i].course_des+"</td>" +
        "<td>"+jsonData[i].course_totalclass+"</td>" +
        "<td>"+jsonData[i].course_totalenroll+"</td>" +
        "<td>"+jsonData[i].	course_link+"</td>" +   
        "<td>"+jsonData[i].	course_img+" </td>"

    ).appendTo('#course_Details_table')

});
} else {
$('#courseDetailsWrong').removeClass('d-none');
$('#courseDetailsLoader').addClass('d-none');
}


})

.catch(function(error) {
$('#courseDetailsWrong').removeClass('d-none');
$('#courseEditLoader').addClass('d-none');

});
}

//Each Course Update Details
function CourseUpdateDetails(detailsID){
    axios.post('/CoursesDetails', {
   id: detailsID
})
.then(function(response) {
if (response.status == 200) {
    $('#courseEditForm').removeClass('d-none');
    $('#courseEditLoader').addClass('d-none');
    var jsonData = response.data;
    $('#CourseNameUpdateId').val(jsonData[0].course_name);
    $('#CourseDesUpdateId').val(jsonData[0].course_des);
    $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
    $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
    $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
    $('#CourseLinkUpdateId').val(jsonData[0].course_link);
    $('#CourseImgUpdateId').val(jsonData[0].course_img);
} else {
    $('#courseEditWrong').removeClass('d-none');
    $('#courseEditLoader').addClass('d-none');
}


})

.catch(function(error) {
$('#courseEditWrong').removeClass('d-none');
 $('#courseEditLoader').addClass('d-none');

});
}
// course Update Modal Save Btn
$('#CourseUpdateConfirmBtn').click(function() {
var id = $('#courseEditId').html();
var name = $('#CourseNameUpdateId').val();
var des = $('#CourseDesUpdateId').val();
var fee = $('#CourseFeeUpdateId').val();
var totalenroll = $('#CourseEnrollUpdateId').val();
var totalclass = $('#CourseClassUpdateId').val();
var link = $('#CourseLinkUpdateId').val();
var img = $('#CourseImgUpdateId').val();
CourseUpdate(id,name, des, fee,totalenroll,totalclass,link, img);
});
    // Course Update Method
function CourseUpdate(cousreUpdateId,CourseUpdateName, CourseUpdateDes, CourseUpdateFee,CourseUpdateEnroll,CourseUpdateClass,CourseUpdateLink,CourseUpdateImg) {
if (cousreUpdateId.length == 0) {
   
}
else if (CourseUpdateName.length == 0) {
    toastr.error('Course Name is Empty');
} else if (CourseUpdateDes.length == 0) {
    toastr.error('Course Description is Empty');
}
else if (CourseUpdateFee.length == 0) {
    toastr.error('Course Fee is Empty');
}
else if (CourseUpdateEnroll.length == 0) {
    toastr.error('Course Total Enroll is Empty');
}
else if (CourseUpdateClass.length == 0) {
    toastr.error('Course Total Classes is Empty');
}
else if (CourseUpdateLink.length == 0) {
    toastr.error('Course Link is Empty');
} else if (CourseUpdateImg.length == 0) {
    toastr.error('Course Image is Empty');
} else {
    $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    axios.post('/CoursesUpdate', {
        id:cousreUpdateId,
        course_name: CourseUpdateName,
        course_des: CourseUpdateDes,
        course_fee: CourseUpdateFee,
        course_totalenroll: CourseUpdateEnroll,
        course_totalclass: CourseUpdateClass,
        course_link: CourseUpdateLink,

        course_img: CourseUpdateImg,
        })
        .then(function(response) {
            $('#CourseUpdateConfirmBtn').html("Save")
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#updateCourseModal').modal('hide');
                    toastr.success('Update Success');
                    getCoursesData();

                } else {
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Update Fail');
                    getCoursesData();

                }

            } else {
                $('#updateCourseModal').modal('hide');
                toastr.error('Something Went Wrong !');
                getCoursesData();
            }



        })

        .catch(function(error) {
            $('#addCourseModal').modal('hide');
            toastr.error('Something Went Wrong !');
            getCoursesData();
        });
}


}

</script>

 @endsection