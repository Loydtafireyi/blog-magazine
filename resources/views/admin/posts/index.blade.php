@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">
	<a href="{{ route('post.create') }}" class="btn btn-primary">Add Post</a>
</div>

<div class="card">
	<div class="card-header">{{$posts->count()}} Posts</div>
	<div class="card-body">
		@if($posts->count() > 0)
			<table class="table table-hover table-bordered table-dark">
				<thead>
					<th>Title</th>
					<th>Category</th>
					<th>Image</th>
					<th>Published On</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody>
					@foreach($posts as $post)
					<tr>
						<td>{{ $post->title }}</td>
						<td>{{ $post->category->name }}</td>
						<td>
							<img src="{{ asset($post->image) }}" width="50" class="rounded-circle">
						</td>
						<td>{{ $post->published_at }}</td>
						<td>
							<a href="{{ route('post.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
						</td>
						<td>
							<form action="{{ route('post.destroy', $post->id) }}" method="post">
								@csrf
								@method('DELETE')
								<button class="btn btn-danger btn-sm">Trash</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<h3 class="text-center">No post at the moment go ahead and start adding posts.</h3>
		@endif
	</div>
</div>


@endsection