@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">
	<a href="{{ route('post.create') }}" class="btn btn-primary">Add Post</a>
</div>

<div class="card">
	<div class="card-header">Posts Bin</div>
	<div class="card-body">
		@if($trashed->count() > 0)
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
				@foreach($trashed as $trash)
				<tr>
					<td>{{ $trash->title }}</td>
					<td>{{ $trash->category->name }}</td>
					<td>
						<img src="{{ asset($trash->image) }}" width="50" class="rounded-circle">
					</td>
					<td>{{ $trash->published_at }}</td>
					<td>
						<form action="{{ route('restore-post', $trash->id) }}" method="Post">
							@csrf
							@method('PUT')
							<button type="submit" class="btn btn-success btn-sm">Restore</button>
							
						</form>
					</td>
					<td>
						<form action="{{ route('post.destroy', $trash->id) }}" method="post">
							@csrf
							@method('DELETE')
							<button class="btn btn-danger btn-sm">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@else
			<h3 class="text-center">The recycle bin is empty</h3>
		@endif
	</div>
</div>


@endsection