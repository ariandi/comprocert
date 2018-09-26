@if($demo->sento == '1')

<p>Hei og velkommen!</p>
<p>Som mottaker av mine e-poster kommer du til å få lære mye om å arbeide smartere og prestere bedre.</p>
<p>Jeg jobber med å hjelpe mennesker med forbedring utvikling og vekst i eget liv og arbeidsliv. Det gjør jeg gjennom å lære bort hva en effektiv endringsprosess innebærer og hvordan du du kommer deg igjennom alle stegen i endringsprosessen for å oppnå ønsket resultat.</p>
<p>Jeg håper at du skal få masse nytte og glede av det du kommer til å lære fra meg i fremtiden!<br /><br />Om du har noen spørsmål rundt temaet endring og forbedring av vaner, adferd og arbeidsmåter, er du hjertelig velkommen til å svare på denne e-posten og spørre meg om hva du måtte lure på!</p>
<p>Vil du ha en litt lenger samtale med meg for å teste utviklingsverktøyet Change66 og kartlegge og analysere din nåsituasjon, så kan du bestille en kostnadsfri samtale med meg for å se om jeg kan hjelpe deg.</p>
<p>Tusen takk for at du er her og jeg gleder meg til å kunne bidra i endringsprosessene du ønsker å forbedre!<br /><br />Med vennlig hilsen<br />WiseHouse AS</p>
<p>Rune Haugen<br />rune@wisehouse.no</p>
<p>+47 934 40 771<br />www.wisehouse.no</p>

@endif

@if($demo->sento == '2')

<p>hei, det er nye folk som kontakter oss,</p>
<p>navn: {{ $demo->name }}</p>
<p>E-post: {{ $demo->email }}</p>

<p><br />WiseHouse AS</p>
<p>Rune Haugen<br />rune@wisehouse.no</p>
<p>+47 934 40 771<br />www.wisehouse.no</p>
@endif