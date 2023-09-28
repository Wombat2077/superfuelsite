<div class="btn-group">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $modal_id }}">{{ $button_label}}</button>
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
    <span class="visually-hidden"></span>
    </button>
    <ul class="dropdown-menu">
        {{$slot}}
    </ul>
  </div>
