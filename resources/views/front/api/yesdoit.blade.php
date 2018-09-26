<div id="yesdoit" class="">
  <div class="">

    <!-- Modal content-->
    <div>
      <div style="border-bottom: 2px solid #ccc;">
        <h2 class="" id="" style="margin-bottom: 5px;text-transform: none;">
          <i class="fa fa-book" aria-hidden="true" style="margin-right:10px;"></i>{{ Menus::getLanguageString('idNoteStatement') }}
        </h2>
      </div>

      <div class="modal-body">
        <form action="#" method="post">
          <h5 style="margin-bottom: 15px;text-transform: none;">
            <div class="TextNode">{{ Menus::getLanguageString('idYesDoIt') }}</div>
          </h5>

          <input type="text" id="note" class="form-control clear" placeholder="{{ Menus::getLanguageString('idNiaSatS') }}"
          style="height:100px;"/>

          <div style="margin-top: 30px;">
            <button type="button" name="action_publish_xnote" class="btn btn-success yesdoitsubmit">{{ Menus::getLanguageString('idSave') }}</button>
            <button class="btn btn-danger cancelProfile" type="button">{{ Menus::getLanguageString('idCancel') }}</button>
          </div>
        </form>

      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> --}}
    </div>

  </div>
</div>
