# PHP

Zadatak je nadodati dinamičke fukncionalnosti u web stranicu koristeći znanja JavaScripta, HTML-a iz prethodnih vježbi i povezati ih s PHP-om. 

## Kako raditi s PHP-om, MySQL-om, JavaScriptom, HTML-om i CSS-om koristeći XAMPP

1. Preuzmite i instalirajte XAMPP sa službene web stranice.
2. Pokrenite XAMPP i pokrenite usluge Apache i MySQL.
3. Napravite novu mapu za svoj projekt u mapi htdocs koja se nalazi u instalacijskom direktoriju XAMPP-a.

**Da biste zajedno koristili PHP, MySQL i HTML, možete slijediti korake u nastavku:**

1. Napravite HTML datoteku u mapi svog projekta i dodajte svoj HTML i CSS kod.
2. Napravite JavaScript datoteku u mapi svog projekta i dodajte svoj JavaScript kod.
3. Napravite PHP datoteku u mapi svog projekta i dodajte svoj PHP kod.
4. U svojoj PHP datoteci povežite se s MySQL bazom podataka pomoću funkcije `mysqli_connect()`.
5. Napišite SQL upite za interakciju s vašom MySQL bazom podataka pomoću funkcije `mysqli_query()`.
6. Koristite PHP za generiranje dinamičkog sadržaja na vašoj web stranici postavljanjem upita vašoj MySQL bazi podataka i ispisivanjem rezultata.

******************************************PRIJEDLOG STRUKTURE DOKUMENATA:******************************************

\-- shoppingcart

|-- functions.php - Ova datoteka će sadržavati sve funkcije koje su nam potrebne za naš sustav košarice (zaglavlje predloška, podnožje predloška i funkcije povezivanja s bazom podataka).

|-- index.php - Ova će datoteka sadržavati glavni predložak (zaglavlje, podnožje itd.) i osnovno usmjeravanje kako bismo mogli uključiti stranice u nastavku.

|-- home.php - Ova će datoteka biti početna stranica koja će sadržavati istaknutu sliku i 4 nedavno dodana proizvoda.

|-- products.php - Ova će datoteka služiti za prikaz svih proizvoda s osnovnom paginacijom.

|-- product.php - Ova datoteka će prikazati proizvod (ovisi o GET zahtjevu) i sadržavat će obrazac koji će omogućiti korisniku da promijeni količinu i doda proizvod u košaricu.

|-- cart.php - Stranica košarice za kupnju popunit će sve proizvode koji su dodani u košaricu, zajedno s količinama, ukupnim cijenama i međuzbrojenim cijenama.

|-- placeorder.php - Osnovna poruka koja će biti prikazana korisniku kada izvrši narudžbu.

|-- admin.php 

|-- dashboard.php - admin sučelje

|-- style.css - Lista stilova koji će se koristiti za web stranicu košarice.

\--imgs folder koji će sadržavati sve slike za vaš sustav košarica (istaknute slike, slike proizvoda itd.). 

## Upute za izrada shoppingcart stranice

- [x]  File **admin.php** 
Admin login:
    - Email: [admin@admin.com](mailto:admin@admin.com)
    - Password: admin123
    
    Administrator se mora prijaviti na stranicu (potrebno je imati predefinirane podatke za administratora u bazi koji su naglašeni u gornjem dijelu). Nakon što se administrator uspješno prijavi, logika ga vodi na admin sučelje koje ima url **/dashboard.php** u kojem postoji Meni početna, proizvodi, narudžbe i odjava. 
        
    - [x]  Ako administrator ugasi stranicu i ponovno ode na dashboard url, automatski
    je logiran sve dok mu traje aktivni cookie. Administrator ne smije doći na navedeni URL dashboard-a ako se nije prethodno prijavio. Također, administratorova šifra unutar baze podataka mora biti enkriptirana (odabrati MD5 ili SHA256 kriptografsku metodu).

- [x]  Ako je administrator unutar nadozrne ploče (dashboard) i klikne na **Proizvodi** unutar menija, otvorit će mu se liste svih trenutno kreiranih proizvoda (ako postoje) s prikazom slike, ime proizvoda, cijena i dostupna količina. Proizvodi se čitaju iz spremljene tablice u bazi. Kada administrator odabere opciju dodavanje proizvoda, odnosno klik na button "dodaj novi proizvod", logika ga vodi na novu stranicu gdje može ispuniti podatke o željenom novom proizvodu. Administrator potvrđuje svoje podatke o proizvodu tako što će kliknuti na gumb o potvrdi proizvoda. Kada administrator potvrdi proizvod, logika ga vraća na prethodnu stranicu gdje može vidjeti novi dodani proizvod unutar liste proizvoda. Ako korisnik ili administrator odu na početnu stranicu, prikazat će im se novo dodani proizvod na npr. "Novo u ponudi" dijelu gdje će se proizvodi dinamički povući iz baze podataka.
- [x]  Ako postoje proizvodi unutar sučelja "Proizvodi", korisnik ima mogućnost da klikne na gumb "Ažuriraj proizvod" **(** koji će ga odvesti na novo sučelje koje je vrlo slično onome kada se
dodaje proizvod, međutim u svakom inputu će postoji predefinirane informacije o navedenom proizvodu koje su također povučene iz baze podataka. Korisnik (administrator) ima mogućnost izmijeniti podatke koje želi, međutim postoje 2 opcije:
    - [x]  Prva opcija je da potvrdi i ažurira informacije o proizvodu, gdje će ga logika vratiti na prethodni page u kojem će moći vidjeti ažurirane podatke
    - [x]  Druga opcija je da obriše navedeni proizvod tako što klikne na "Obriši proizvod" button, gdje će ga logika vratiti također na prethodni page ali neće moći vidjeti više informacije o obrisanom proizvodu.
    - (Napomena: Sve promjene koje se događaju unutar kategorije proizvode moraju se odraziti na prikazane proizvode na početnoj stranici.)
- [x]  **Korisnikovo dodavanja artikala** u košaricu kad se klikne gumb za kupovinu artikla, brisanje artikala iz košarice i prikaz ukupne cijene košarice.  Pripaziti opciju odabira artikala više puta (komada) u košaricu .
    - [x]  Kada korisnik doda proizvode u minicart i klikne na button "Kupi sad", logika ga treba odvesti na cart page gdje će mu se u većoj varijanti košarice prikazati svi detalji koji su se nalazili unutar minicarta - naziv proizvoda, cijena, količina itd. Korisnik osim povećane verzije košarice, s desne ili lijeve strane ima informacije o narudžbi koje mora popuniti, kao i skraćeni prikaz njegove ukupne narudžbe unutar košarice (potrebno je samo definirati ukupnu cijenu košarice) gdje postoji veliki dizajnirani gumb da potvrdi svoju kupovinu. Korisnik ne može kliknuti na button ako sve informacije unutar forme za narudžbu nisu validirane i ispunjene.
        
    - [x]  Kada korisnik ispuni sve podatke i klikne na button za naručiti, ako postoje tražene količine proizvoda na stanju, logika će ga prebaciti na stranicu koja mu potvrđuje njegovu narudžbu (tkz. success page). Na navedenoj stranici potrebno je definirati kako je njegova narudžba zaprimljena i prikazati kreiranu narudžbu koju je korisnik naručio. Ako ne postoje tražene količine proizvoda na stanju, potrebno je korisniku prikazati poruku (još uvijek na cart page-u) kako trenutna količina koju on želi je nedostupna. Nakon što se operacija izvrši, također je potrebno smanjiti dostupnu količinu (QTY) određenog proizvoda koji je naručen
    (potrebno je testirati i pogledati prikaz unutar sekcije "Proizvodi").]

- [x]  ***Mogućnost "kupovine" artikala u košarici** -* Kupovina se odvija tako da se prikaže poruka da je kupovina uspješna i da se košarica isprazni. Paziti na kupovinu prazne košarice i slično. Osvježiti gumb za prikaz košarice tako da dinamički prikazuje broj artikala u košarici.
- [x]  Nakon što korisnik napravi narudžbu, administrator unutar njegove nadzorne ploče odlaskom na sekciju "Narudžbe" može pregledati napravljenu narudžbu tako što će imati prikaz o informacijama narudžbe (ime, prezime, telefon, adresa itd.) i naručene proizvode koje je potrebno samo tekstualno ispisati pod odgovarajućim stupcem. (pr. 1x Banana, 2x jabuke Cijena ukupno: xxxx itd.)



