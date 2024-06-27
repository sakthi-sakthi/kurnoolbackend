@extends('admin.layouts.master')

@section('title')
    {{ __('main.priests') }}
@endsection

@section('content')
<div class="content-wrapper">
<!-- Main content -->
<div class="content">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{ __('Bishop Profile') }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Bishop Profile') }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid"> 
        <form action="" method="post" id="form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-8">
                    <div class="card">
                      <div class="card-body">
                        <div class="form-group ">
                            <label for="name">{{ __('Bishop Name') }} <span style="color: red">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm  @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group ">
                            <label for="fname">{{ __('Father Name') }} <span style="color: red">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm  @error('fname') is-invalid @enderror"
                                id="fname" name="fname" value="{{ old('fname') }}">
                        </div>
                        <div class="form-group ">
                            <label for="mname">{{ __('Mother Name') }} <span style="color: red">*</span></label>
                            <input type="text"
                                class="form-control form-control-sm  @error('mname') is-invalid @enderror"
                                id="mname" name="mname" value="{{ old('mname') }}">
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                    <div class="card text-right">
                    <div class="card-header">
                     <label for="media_img">{{ __('Image') }}</label>
                    </div>
                        <div class="card-body">
                        <img src="" alt=""  id="media_img" class="w-100 mr-5">
                        </div>
                    <div class="card-footer">
                    <a href="javascript:void(0);" class="btn btn-xs btn-primary float-left"
                    id="choose">{{ __('main.Choose Image') }}</a>
                    <a href="javascript:void(0);" class="btn btn-xs btn-warning float-right"
                    id="remove">{{ __('main.Remove Image') }}</a>
                    </div>
              </div></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <input type="hidden" name="media_id" id="media_id" value="{{ old('media_id') }}">
                            <div class="row">
                            <div class="form-group col-6">
                                <label for="date_of_birth">{{ __('main.date_of_birth') }} <span style="color: red"></span></label>
                                <input type="date"
                                    class="form-control form-control-sm  @error('date_of_birth') is-invalid @enderror"
                                    id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="date_of_ordination">{{ __('main.date_of_ordination') }} <span style="color: red"></span></label>
                                <input type="date"
                                    class="form-control form-control-sm  @error('date_of_ordination') is-invalid @enderror"
                                    id="date_of_ordination" name="date_of_ordination" value="{{ old('date_of_ordination') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="profession">{{ __('Date of Profession') }} <span style="color: red"></span></label>
                                <input type="text"
                                    class="form-control form-control-sm  @error('profession') is-invalid @enderror"
                                    id="profession" name="profession" value="{{ old('profession') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="blood_group">{{ __('main.blood_group') }} <span style="color: red"></span></label>
                                <input type="text"
                                    class="form-control form-control-sm  @error('blood_group') is-invalid @enderror"
                                    id="blood_group" name="blood_group" value="{{ old('blood_group') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="phone">{{ __('main.phone') }}</label>
                                <input type="number" max="10"
                                    class="form-control form-control-sm  @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="email">{{ __('main.email') }}</label>
                                <input type="text"
                                    class="form-control form-control-sm  @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}">
                                    @error('email') <small class="ml-auto text-danger">{{ __('main.emailError') }}</small> @enderror
                            </div>
                        </div>
                        <div class="form-group "> 
                            <label for="content">{{ __('Content') }}</label>
                            <textarea 
                                class="form-control form-control-sm  @error('content') is-invalid @enderror"
                                id="addres" name="content" value="{{ old('content') }}" rows="3"></textarea>
                                
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card" id="save-card">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="btn btn-success btn-sm float-right"
                            id="submitpriest">{{ __('main.Save') }}</a>
                            <a href="{{ route('admin.priest.index') }}" class="btn btn-danger btn-sm float-right mr-2">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div><!-- /.container-fluid -->
</div><!-- /.content -->
</div>

    @include('admin.layouts.media')
@endsection

@section('script')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
   $(document).ready(function() {
    $('#roles').select2();
});
var uploadedDocumentMap = {};

// Generate the secure URL using secure_url function
var secureUrl = "{{ secure_url(route('admin.media.storeMedia')) }}";

// Configure Dropzone with the secure URL
Dropzone.options.documentDropzone = {
    url: secureUrl,
    maxFilesize: 50, // MB
    addRemoveLinks: true,
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function (file, response) {
        var error = response.error;
        var filesize = response.filesize;
        if (error) {
            $("#error-container").html('<div id="error-message" style="color: red;font-weight:700;">' + error + '</div>');
            $("#error-message").show();
            file.previewElement.remove();
        } else if (filesize >= 2) {
            $("#error-container").html('<div id="error-message" style="color: red;font-weight:700;"> Please reduce your file size before you upload it...! </div>');
            $("#error-message").show();
            file.previewElement.remove();
        } else {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name;
        }
        setTimeout(function () {
            $("#error-message").hide();
        }, 10000);
    },
    removedfile: function (file) {
        file.previewElement.remove();
        var name = '';
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name;
        } else {
            name = uploadedDocumentMap[file.name];
        }
        $('form').find('input[name="document[]"][value="' + name + '"]').remove();
    },
};

$(document).ready(function() {
    $('#submitmedia').click(function(event) {
        event.preventDefault(); // Prevent default form submission
        
        var formData = new FormData($('#media-form')[0]); // Serialize form data
        
        $.ajax({
            url: $('#media-form').attr('action'), // URL to submit the form to
            type: 'POST',
            data: formData, // Form data
            processData: false, // Don't process the data
            contentType: false, // Don't set contentType
            success: function(response) {
                if (Array.isArray(response)) {
    // Empty the .allmedia container
    $('.allmedia').empty();

    // Append each media item to the .allmedia container
    response.forEach(function(media) {
        var mediaHtml = '<div class="thumbnail">' +
                            '<a href="javascript:void(0);">' +
                                '<img id="' + media.id + '" src="' + media.thumbUrl + '" data-url="' + media.url + '" alt="' + media.alt + '" data-title="' + media.name + '">' +
                            '</a>' +
                        '</div>';
        $('.allmedia').append(mediaHtml);
    });
} else {
    console.error("Response medias is not an array:", response);
}
                $(".allmedia").css("display", "block");
                $(".add-medias").css("display", "none");
                var myDropzone = Dropzone.forElement("#document-dropzone");
                if(myDropzone) {
                    myDropzone.removeAllFiles();
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
            }
        });
    });
});

</script>
@endsection
