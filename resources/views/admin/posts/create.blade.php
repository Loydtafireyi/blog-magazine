@extends('layouts.app')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')

<div class="card">
	<div class="card-header text-uppercase">{{isset($post) ? 'Update Post' :  'Create Post'}}</div>
	<div class="card-body">
		<form action="{{ isset($post) ? route('post.update', $post->id) : route('post.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			@if(isset($post))
				@method('PUT')
			@endif
			<div class="form-gorup">
				<label for="category_id">Post Category</label>
				<select class="form-control" name="category_id" id="category_id">
					<option selected>Choose...</option>
					@foreach($categories as $category)
						<option value="{{ $category->id }}"
							@if(isset($post))
								@if($category->id == $post->category_id)
								selected 
								@endif
							@endif
							>{{ $category->name }}
						</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="title">Post Title</label>
				<input type="text" name="title" id="title" class="form-control" value="{{ isset($post) ? $post->title : '' }}">
			</div>
			<div class="form-group">
				<label for="description">Short Description</label>
				<input id="description" type="hidden" name="description" value="{{ isset($post) ? $post->description : '' }}">
  				<trix-editor input="description"></trix-editor>
			</div>
			<div class="form-group">
				<label for="content">Post Content</label>
				<textarea cols="5" rows="5" type="text" name="content" id="content" class="form-control">{{ isset($post) ? $post->content : '' }}</textarea>
			</div>

			@if(isset($post))
				<div class="form-group">
					<img src="{{asset($post->image)}}" alt="{{$post->image}}" style="width: 100%">
				</div>
			@endif
			<div class="form-group">
				<label for="image">Post Featured Image</label>
				<input type="file" name="image" id="image" class="form-control-file">
			</div>
			<div class="form-group">
				<label for="published_at">Schedule Post</label>
				<input type="date" name="published_at" id="published_at" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">{{ isset($post) ? 'Update Post' :  'Add Post' }}</button>
			</div>
		</form>
	</div>
</div>

@endsection

@section('scripts')
	<script src="{{ asset('js/trix.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script>
		flatpickr('#published_at', {
			enableTime: true,
		})
	</script>
@endsection