@extends('admin.layouts.master')

@section('title')
    {{ __('main.addvicariate') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">{{ __('main.addvicariate') }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.vicariate.index') }}">{{ __('main.vicariates') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('main.addvicariate') }}</li>
                        </ol>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid"> 
        <form action="{{ route('admin.vicariate.store') }}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-8">
                    <div class="card">
                      <div class="card-body">
                        <div class="form-group ">
                            
                            <label for="name">{{ __('main.vicariatename') }} <span style="color: red">*</span></label>
                            <input type="text"
                                class="form-control  form-control-sm @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group ">
                            <label for="patron">{{ __('main.patron') }}</label>
                            <input type="text"
                                class="form-control form-control-sm  @error('patron') is-invalid @enderror"
                                id="patron" name="patron" value="{{ old('patron') }}">
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                    <div class="card text-right">
                    <div class="card-header">
                     <label for="media_img">{{ __('main.priestimage') }}</label>
                    </div>
                        <div class="card-body">
                        <img src="" alt=""  id="media_img" class="w-100 mr-5" style="width: 161px !important;">
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
                                <label for="establishment_date">{{ __('main.esatablishment_date') }}</label>
                                <input type="date"
                                    class="form-control form-control-sm  @error('establishment_date') is-invalid @enderror"
                                    id="establishment_date" name="establishment_date" value="{{ old('establishment_date') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="vicarare_forane_mobile">{{ __('main.vicarare_forane') }}</label>
                                <select class="form-control form-control-sm priest_id" id="priest_id" name="priest_id">
                                    <option value="0"></option>
                                    @foreach ($priests as $priest)
                                        <option value="{{ $priest->id }}" @if (old('vicarare_forane') == $priest->id) selected @endif>
                                            {{ $priest->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="vicarare_forane_mobile">{{ __('main.vicariateforanemobile') }}</label>
                                <input type="text"
                                    class="form-control form-control-sm  @error('vicarare_forane_mobile') is-invalid @enderror"
                                    id="vicarare_forane_mobile" name="vicarare_forane_mobile" value="{{ old('vicarare_forane_mobile') }}">
                            </div>
                            <div class="form-group col-6">
                                <label for="bg">{{__('main.vicariateimage')}}</label>
                                <div class="input-group input-group-sm " id="yourContainerId">
                                   
                                  </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="email">{{ __('main.email') }}</label>
                                <input type="text"
                                    class="form-control form-control-sm  @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}">
                                    @error('email') <small class="ml-auto text-danger">{{ __('main.emailError') }}</small> @enderror
                            </div>
                            <div class="form-group col-6">
                                <label for="phone">{{ __('main.phone') }}</label>
                                <input type="number" max="10"
                                    class="form-control form-control-sm  @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone') }}">
                            </div>
                            {{-- @include('admin.layouts.address') --}}
                        </div>
                       
                        <div class="form-group "> 
                            <label for="address">{{ __('main.Address') }} <span style="color: red">*</span></label>
                            <textarea 
                                class="form-control form-control-sm  @error('address') is-invalid @enderror"
                                id="addres" name="address" >{{ old('address') }}</textarea> 
                                
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card" id="save-card">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="btn btn-success btn-sm float-right"
                            id="submitpriest">{{ __('main.Save') }}</a>
                            <a href="{{ route('admin.vicariate.index') }}" class="btn btn-danger btn-sm float-right mr-2">Cancel</a>
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
<script>
$('.priest_id').change(function() {
    id =  $(this).val();
    $.get("{{ route('admin.parish.priestget') }}", {
        id: id
    })
    .done(function(response) {
        console.log("AJAX request successful. Response:", response);

      var newImage = $('<img>', {
                'src': response,
                'alt': 'pristimage'
        });
        $('#labelname').text('Priest Image');
    
        $('#yourContainerId').empty().append(newImage);
    })
    .fail(function(error) {
        console.error("AJAX request failed. Error:", error);
    });
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
