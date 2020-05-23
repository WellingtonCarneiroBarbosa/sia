@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="alert-inner--text"><i class="fas fa-thumbs-down mr-2"></i><strong> {{ __("Opps") }}...</strong>
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@elseif(session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <span class="alert-inner--text"><i class="ni ni-like-2 mr-2"></i><strong>{{  __("Success") }}!</strong> {{session('status')}}</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
