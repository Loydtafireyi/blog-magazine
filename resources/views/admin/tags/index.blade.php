@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-end mb-2">
	<a href="{{ route('tag.create') }}" class="btn btn-primary">Add Tag</a>
</div>

<div class="card">
	<div class="card-header">Categories</div>
	<div class="card-body">

		@if($tags->count() > 0)
			<table class="table table-hover table-bordered table-dark">
				<thead class="text-uppercase">
					<th>Name</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody>
					@foreach($tags as $tag)
					<tr>
						<td>{{ $tag->name }}</td>
						<td>
							<a class="btn btn-sm btn-primary" href="{{ route('tag.edit', $tag->id) }}">Edit</a>
						</td>
						<td>
							<button type="submit" class="btn btn-sm btn-danger" onclick="handleDelete({{ $tag->id }})">Delete</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		@else
			<h3>No tags found, go ahead and add tags</h3>
		@endif

		<!-- Delete Resource Modal -->

		<!-- Modal -->
		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		   <form action="" method="post" id="deleteCategory">
		   	@csrf
		   	@method('DELETE')
		   	 <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="deleteModalLabel">Delete Resource</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        Are you sure you want delete this resource? Once deleted can not be undone!
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
		        <button type="submit" class="btn btn-danger">Proceed, Deleting!</button>
		      </div>
		    </div>
		   </form>
		  </div>
		</div>

	</div>
</div>

@endsection

@section('scripts')

<script>
	function handleDelete(id) {
		const form = document.getElementById('deleteCategory')

		form.action = '/tag/' + id

		$('#deleteModal').modal('show')
	}
</script>

@endsection