<table class="table table-user-information">
  <form method="POST" action="{{ route('api.profile.passwordstore') }}">
    {{ csrf_field() }}
    {{ method_field('put') }}
    <tbody>
      <tr>
        <td>{{ Menus::getLanguageString('idCurrentPassword') }} : </td>
        <td>
           <input type="password" class="form-control" id="current-password" name="current-password" placeholder="{{ Menus::getLanguageString('idCurrentPassword') }}" />
        </td>
      </tr>

      <tr>
        <td>{{ Menus::getLanguageString('idNewPassword') }} : </td>
        <td>
          <input type="password" class="form-control" id="password" name="password" placeholder="{{ Menus::getLanguageString('idPassword') }}" />
        </td>
      </tr>

      <tr>
        <td>{{ Menus::getLanguageString('idReEnterPassword') }} : </td>
        <td>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
          placeholder="{{ Menus::getLanguageString('idReEnterPassword') }}">
        </td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <button class="btn btn-primary passwordStore" type="button">{{ Menus::getLanguageString('idSave') }}</button>
          <button class="btn btn-danger cancelProfile" type="button">{{ Menus::getLanguageString('idCancel') }}</button>
        </td>
      </tr>
    </tfoot>
  </form>
</table>
