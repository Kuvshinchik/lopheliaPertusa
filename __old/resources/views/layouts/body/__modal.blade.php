<!-- Modal            shape_form      -->
<div class="modal fade " id="exampleModal{{$alias}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Форма заказа товара</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
 @include('layouts.body.form')
      </div>
      <div class="modal-footer">
   <!--      <button type="button" class="btn btn-secondary" data-dismiss="modal">Купить</button>
       <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>