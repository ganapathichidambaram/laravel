@if (isset($success) && $message = $success)
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if (isset($error) && $message = $error)
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-bs-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
</div>
@endif


@if (isset($warning) && $message = $warning)
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-bs-dismiss="alert">×</button>	
	<strong>{{ $message }}</strong>
</div>
@endif


@if (isset($info) && $message = $info)
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-bs-dismiss="alert">×</button>	
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger">
	<button type="button" class="close" data-bs-dismiss="alert">×</button>	
	Please check the form below for errors
</div>
@endif