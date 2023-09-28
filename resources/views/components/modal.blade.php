<!-- Модальное окно -->
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="ModalLabel{{ $id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
      </div>
      <div class="modal-body">
        {{ $slot }}
      </div>
      </div>
    </div>
  </div>
</div>
