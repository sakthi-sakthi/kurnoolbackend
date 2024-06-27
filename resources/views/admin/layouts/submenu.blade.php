

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 ml-5">
            <div class="col-sm-4">
                {{-- <h4 class="m-0 text-dark">{{ __('main.ourteam') }}</h4> --}}
                <button id="parish" class="@if(Request::segment(2)=="parish") btn btn-info @else btn btn-secondary @endif">{{ __('main.parishes') }}</button>
            </div>
            <div class="col-sm-4">
                {{-- <h4 class="m-0 text-dark">{{ __('main.ourteam') }}</h4> --}}
                <button id="priest" class="@if(Request::segment(2)=="priest") btn btn-info @else btn btn-secondary @endif"> {{ __('main.priests') }}</button>
            </div>
            <div class="col-sm-4">
                {{-- <h4 class="m-0 text-dark">{{ __('main.ourteam') }}</h4> --}}
                <button id="religio" class="@if(Request::segment(2)=="religio") btn btn-info @else btn btn-secondary @endif">{{ __('main.religious') }}</button>
            </div>
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<script>
     document.getElementById('priest').addEventListener('click', function() {
    window.location.href = '/admin/priest'; // replace with the actual route
});

document.getElementById('parish').addEventListener('click', function() {
    window.location.href = '/admin/parish'; // replace with the actual route
});

document.getElementById('religio').addEventListener('click', function() {
    window.location.href = '/admin/religio'; // replace with the actual route
});

</script>