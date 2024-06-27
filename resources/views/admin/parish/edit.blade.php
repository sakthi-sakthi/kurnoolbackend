@extends('admin.layouts.master')

@section('title')
    {{ __('main.editparishes') }}
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="m-0 text-dark">{{ __('main.editparishes') }}</h4>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('main.Home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('admin.parish.index') }}">{{ __('main.parishes') }}</a></li>
                                 
                                 <li class="breadcrumb-item active">{{ $value->title }}</li>
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
                <form action="{{ route('admin.parish.update',$value->id) }}" method="post" id="form" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-8">
                            <div class="card">
                              <div class="card-body">
                                <div class="form-group ">
                                    
                                    <label for="title">{{ __('main.parish_name') }} <span style="color: red">*</span></label>
                                    <input type="text"
                                        class="form-control  form-control-sm @error('parish_name') is-invalid @enderror"
                                        id="parish_name" name="parish_name" value="{{ old('parish_name') ?? $value->parish_name }}">
                                </div>
                                <div class="form-group ">
                                    <label for="parish_priest">{{ __('main.parish_priest') }} </label>
                                    <input type="text"
                                    class="form-control form-control-sm  @error('parish_priest') is-invalid @enderror"
                                    id="parish_priest" name="parish_priest" value="{{ $value->parish_priest }}"">
                                    {{-- <select class="form-control form-control-sm parish_priest" id="parish_priest" name="parish_priest">
                                        <option value="0"></option>
                                        @foreach ($priests as $priest)
                                            <option value="{{ $priest->id }}" @if (old('parish_priest') ?? $priest->id == $value->parish_priest) selected @endif>
                                                {{ $priest->name }}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                                {{-- <div class="form-group">
                                    <label for="bg">{{__('main.priestimage')}}</label>
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control form-control-sm" name="priest_image" id="urltext_img" value="{{ old('priest_image') ?? $value->priest_image }}">
                                        <span class="input-group-append">
                                          <button type="button" class="btn btn-info btn-flat" id="chooseimg">{{__('main.Choose')}}</button>
                                        </span>
                                        <img src="{{ $image }}" id="yourContainerId">
                                      </div>
                                </div> --}}
                            </div>
                          </div>
                        </div>
                        <div class="col-4">
                            <div class="card text-right">
                            <div class="card-header">
                             <label for="media_img">{{ __('main.parishimage') }}</label>
                            </div>
                                <div class="card-body">
                                <img src="{{ $value->getMedia->getUrl('thumb') ?? '' }}" alt=""  id="media_img" class="w-100 mr-5">
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
                                    <input type="hidden" name="media_id" id="media_id" value="{{ old('media_id') ?? $value->media_id }}">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>{{ __('main.vicariate') }} <span style="color: red">*</span></label>
                                            <select class="form-control form-control-sm" id="vicariate" name="vicariate">
                                                <option value="0"></option>
                                                @foreach ($vicariate as $vicariat)
                                                    <option value="{{ $vicariat->id }}" @if (old('vicariate') ??  $vicariat->id == $value->vicariate) selected @endif>
                                                        {{ $vicariat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>{{ __('main.Category') }} <span style="color: red">*</span></label>
                                            <select class="form-control form-control-sm" id="category_id" name="category_id">
                                                <option value="0"></option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if (old('category') ?? $value->getCategory->id == $category->id) selected @endif>
                                                        {{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    <div class="form-group col-6">
                                        <label for="patron">{{ __('main.patron') }} </label>
                                        <input type="text"
                                            class="form-control form-control-sm  @error('patron') is-invalid @enderror"
                                            id="patron" name="patron" value="{{ old('patron') ?? $value->patron }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="established_year">{{ __('main.established_year') }} <span style="color: red">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm  @error('established_year') is-invalid @enderror"
                                            id="established_year" name="established_year" value="{{ old('established_year') ?? $value->established_year }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="tamil_population">{{ __('main.tamil_population') }} <span style="color: red">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm  @error('tamil_population') is-invalid @enderror"
                                            id="tamil_population" name="tamil_population" value="{{ old('tamil_population') ?? $value->tamil_population }}">
                                    </div>
                                    {{-- <div class="form-group col-6">
                                        <label for="malayalam_population">{{ __('main.malayalam_population') }} <span style="color: red">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm  @error('malayalam_population') is-invalid @enderror"
                                            id="malayalam_population" name="malayalam_population" value="{{ old('malayalam_population') ?? $value->malayalam_population }}">
                                    </div> --}}
                                    {{-- <div class="form-group col-6">
                                        <label for="vicariate">{{ __('main.vicariate') }}</label>
                                        <input type="text"
                                            class="form-control form-control-sm  @error('vicariate') is-invalid @enderror"
                                            id="vicariate" name="vicariate" value="{{ old('vicariate') ?? $value->vicariate }}">
                                            
                                    </div> --}}
                                    <div class="form-group col-6">
                                        <label for="email">{{ __('main.email') }}</label>
                                        <input type="text"
                                            class="form-control form-control-sm  @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') ?? $value->email }}">
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="phone">{{ __('main.phone') }}</label>
                                        <input type="number" max="10"
                                            class="form-control form-control-sm  @error('phone') is-invalid @enderror"
                                            id="phone" name="phone" value="{{ old('phone') ?? $value->phone }}">
                                    </div>
                                </div>
                                <div class="form-group "> 
                                    <label for="address">{{ __('main.Address') }} <span style="color: red">*</span></label>
                                    <textarea 
                                        class="form-control form-control-sm  @error('address') is-invalid @enderror"
                                        id="address" name="address">{{ old('address') ?? $value->address }}</textarea>
                                        
                                </div>
                                    <div class="form-group">
                                        <label for="social_movements">{{ __('main.social_movements') }}</label>
                                        <textarea class="form-control form-control-sm" rows="3" id="social_movements" 
                                            name="social_movements">{{ old('social_movements') ?? $value->social_movements }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="pious_associations">{{ __('main.pious_associations') }}</label>
                                        <textarea class="form-control form-control-sm" rows="3"   id="pious_associations"
                                            name="pious_associations">{{ old('pious_associations') ?? $value->pious_associations }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="history">{{ __('main.history') }}</label>
                                        <textarea class="form-control form-control-sm" rows="3" id="history"
                                            name="history">{{ old('history') ?? $value->history }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" id="save-card">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="btn btn-success btn-sm float-right"
                                    id="submitparish">{{ __('main.Update') }}</a>
                                    <a href="{{ route('admin.parish.index') }}" class="btn btn-danger btn-sm float-right mr-2">Cancel</a>
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
        $('.parish_priest').change(function() {
    id =  $(this).val();
    $.get("{{ route('admin.parish.priestget') }}", {
        id: id
    })
    .done(function(response) {
        console.log("AJAX request successful. Response:", response);
        $('#yourContainerId').attr('src', response);
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
