@extends('layouts.app')

@section('content')

<div class="card">
	<div class="card-header">
		{{ isset($tag) ? $tag->name : 'Add Tag' }}
	</div>
	<div class="card-body">

		<form action="{{ isset($tag) ? route('tag.update', $tag->id) : route('tag.store') }}" method="Post">
			@csrf
			@if(isset($tag))
				@method('PATCH')
			@endif
			<div class="form-group">
				<label for="name">Tag Name</label>
				<input type="text" name="name" id="name" class="form-control" value="{{ isset($tag) ? $tag->name : '' }}">
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary">{{ isset($tag) ? 'Edit Tag' : 'Add Tag' }}</button>
			</div>
		</form>
		
	</div>
</div>

@endsection