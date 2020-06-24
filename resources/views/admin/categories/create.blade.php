@extends('layouts.app')

@section('content')

<div class="card">
	<div class="card-header">
		{{ isset($category) ? $category->name : 'Add Category' }}
	</div>
	<div class="card-body">

		<form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" method="Post">
			@csrf
			@if(isset($category))
				@method('PATCH')
			@endif
			<div class="form-group">
				<label for="name">Category Name</label>
				<input type="text" name="name" id="name" class="form-control" value="{{ isset($category) ? $category->name : '' }}">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">{{ isset($category) ? 'Edit Category' : 'Add Category' }}</button>
			</div>
		</form>
		
	</div>
</div>

@endsection