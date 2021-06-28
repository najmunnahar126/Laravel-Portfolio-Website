@extends('Layout.app')
@section('title','Photo Gallery')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 p-3">
      <button data-toggle="modal" data-target="#PhotoModal" id="AddNewPhotoBtnId" class="btn my-3 btn-sm btn-danger">Add New 
      </button>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row photoRow pb-5">
  </div>
  <button class="btn btn-primary btn-sm" id="LoadMoreBtn">Load More
  </button>
</div>
<!-- --Modal-- -->
<div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Photo
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;
          </span>
        </button>
      </div>
      <div class="modal-body ">
        <input class="form-control" id="imgInput" type="file">
        <img class="imgPreview mt-3" id="imgPreview" src="{{asset('images/default.png')}}" alt="">   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel
        </button>
        <button  id="savePhoto" type="button" class="btn  btn-sm  btn-danger">Save
        </button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')
 
 <script type="text/javascript">
   $('#imgInput').change(function() {
    var reader = new FileReader();
    reader.readAsDataURL(this.files[0]);
    reader.onload = function(event) {
        var ImgSource = event.target.result;
        $('#imgPreview').attr('src', ImgSource)
    }
})
$('#savePhoto').on('click', function() {
    $('#savePhoto').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
    var photofile = $('#imgInput').prop('files')[0];
    var formData = new FormData();
    formData.append('photo', photofile);

    axios.post("/PhotoUpload", formData).then(function(response) {
        if (response.status == 200 && response.data == 1) {
            $('#savePhoto').html('Save');
            $('#PhotoModal').modal('hide');
            toastr.success('Photo Upload Success');
        } else {
            $('#PhotoModal').modal('hide');
            toastr.error();
            ('Photo Upload failed');
        }

    }).catch(function(error) {
        toastr.error();
        ('Photo Upload failed');
        $('#PhotoModal').modal('hide');
        $('#savePhoto').html('Save');
    })


})
LoadPhoto();

function LoadPhoto() {
    let URL = "/PhotoJSON";
    axios.get(URL).then(function(response) {

        $.each(response.data, function(i, item) {
            $("<div class='col-md-4 p-2'>").html(

                "<img data-id=" + item['id'] + " class='imgOnRow' src=" + item['location'] + ">" +
                "<button data-id=" + item['id'] + " data-photo=" + item['location'] + " class='btn deletePhoto btn-danger btn-sm'>Delete</button>"

            ).appendTo('.photoRow');

        })
        $('.deletePhoto').on('click',function (event) {
                    let id=$(this).data('id');
                    let photo=$(this).data('photo');
                    PhotoDelete(photo,id);
                    event.preventDefault();
                })


    }).catch(function(error) {

    })
}


var ImgID = 0;

function LoadByID(FirstImgID, loadMoreBtn) {
    ImgID = ImgID + 3;
    let PhotoID = ImgID + FirstImgID;
    let URL = "/PhotoJSONByID/" + PhotoID;
    loadMoreBtn.html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.get(URL).then(function(response) {
        loadMoreBtn.html("Load More");
        $.each(response.data, function(i, item) {
            $("<div class='col-md-4 p-2'>").html(

                "<img data-id=" + item['id'] + " class='imgOnRow' src=" + item['location'] + ">" +
                "<button data-id=" + item['id'] + " data-photo=" + item['location'] + " class='btn btn-danger btn-sm'>Delete</button>"
            ).appendTo('.photoRow')

        });


    }).catch(function(error) {

    })
}

$('#LoadMoreBtn').on('click', function() {
    let loadMoreBtn = $(this);
    let FirstImgID = $(this).closest('div').find('img').data('id');
    LoadByID(FirstImgID, loadMoreBtn);
})

function PhotoDelete(OldPhotoURL,id){
                let URL="/PhotoDelete";
                let MyFormData=new FormData();
                MyFormData.append('OldPhotoURL',OldPhotoURL);
                MyFormData.append('id',id);
     axios.post(URL,MyFormData).then(function (response) {
                    if(response.status==200 && response.data==1){
                        toastr.success('Photo Delete Success');
                        window.location.href="/Photo";
                    }
                    else{
                        toastr.error('Delete Fail Try Again');
                    }
                }).catch(function () {
                    toastr.error('Delete Fail Try Again');
                })

}
</script>

@endsection