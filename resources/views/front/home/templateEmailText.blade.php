@if($demo->sento == '1')

<p>Hei og velkommen!</p>
<p>Som mottaker av mine e-poster kommer du til {{ htmlentities("å få lære mye om å", ENT_COMPAT,"UTF-8", true) }} arbeide smartere og prestere bedre.</p>
<p>Jeg jobber med {{ htmlentities("å", ENT_COMPAT,"UTF-8", true) }} hjelpe mennesker med forbedring utvikling og vekst i eget liv og arbeidsliv. Det {{ htmlentities("gjør jeg gjennom å lære", ENT_COMPAT,"UTF-8", true) }} bort hva en effektiv endringsprosess {{ htmlentities("innebærer", ENT_COMPAT,"UTF-8", true) }} og hvordan du du kommer deg igjennom alle stegen i endringsprosessen for {{ htmlentities("å oppnå ønsket", ENT_COMPAT,"UTF-8", true) }} resultat.</p>
<p>Jeg {{ htmlentities("håper at du skal få masse nytte og glede av det du kommer til å lære", ENT_COMPAT,"UTF-8", true) }} fra meg i fremtiden!<br /><br />Om du har noen {{ htmlentities("spørsmål", ENT_COMPAT,"UTF-8", true) }} rundt temaet endring og forbedring av vaner, adferd og {{ htmlentities("arbeidsmåter", ENT_COMPAT,"UTF-8", true) }}, er du hjertelig velkommen til {{ htmlentities("å svare på denne e-posten og spørre meg om hva du måtte lure på", ENT_COMPAT,"UTF-8", true) }}!</p>
<p>Vil du ha en litt lenger samtale med meg for {{ htmlentities("å teste utviklingsverktøyet Change66 og kartlegge og analysere din nåsituasjon, så kan du bestille en kostnadsfri samtale med meg for å", ENT_COMPAT,"UTF-8", true) }} se om jeg kan hjelpe deg.</p>
<p>Tusen takk for at du er her og jeg gleder meg til {{ htmlentities("å kunne bidra i endringsprosessene du ønsker å forbedre", ENT_COMPAT,"UTF-8", true) }}!<br /><br />Med vennlig hilsen<br />WiseHouse AS</p>
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