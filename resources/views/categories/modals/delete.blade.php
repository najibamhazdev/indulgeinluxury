{!! Form::model($category, ['method' => 'DELETE','route' => ['categories.destroy', $category->id]]) !!}
<div class="modal-body">
    <em>Are you sure that you want to delete</em>?
 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

   <button type="submit" class="btn btn-danger photo-delete" data-slug="">Delete</button>
 </div>
 {!! Form::close() !!}