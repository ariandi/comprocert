
<div class="container">
      <div class="row grsatas grsbawah">
                        <div class="col-25  kiri">
                          <label>{{ Menus::getLanguageString('idEmail') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Auth::user()->email }}</label></div>
                     </div>

                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idFirstName') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Auth::user()->first_name }}</label></div>
                     </div>
                        
                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idLastName') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Auth::user()->last_name }}</label></div>
                     </div>

                      <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idPosition') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label></label></div>
                     </div>

                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idYearOfBirth') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Auth::user()->birth_date }}</label></div>
                     </div>

                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idGender') }}:</label></div>
                          <div class="col-75 kanan ujung">
                          <label>{{ Auth::user()->gender == 'M'? 'Male' : '' }}</label>
                          <label> {{ Auth::user()->gender == 'F'? 'Female' : '' }}</label>
                        </div>
                     </div>

                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idAddress') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Auth::user()->address }}</label></div>
                     </div>

                     <div class="row grsbawah">
                        <div class="col-25 kiri">
                          <label>{{ Menus::getLanguageString('idMobilePhoneNumber') }}:</label></div>
                          <div class="col-75 kanan ujung">
                        <label>{{ Auth::user()->no_hp }}</label></div>
                     </div>
       </div>
                
 </div>