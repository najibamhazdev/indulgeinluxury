{!! Form::model($todolist, ['method' => 'PUT','route' => ['todolists.storeDone', $todolist->id]]) !!}
<div class="modal-body">
    <em>Are you sure the task was Done</em>?
 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

   <button type="submit" class="btn btn-success photo-delete" data-slug="">Set as Done</button>
 </div>
 {!! Form::close() !!}
