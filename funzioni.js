function validazioneRegistrazione(){ //controlli sui dati inseriti nella form di registrazione al servizio

    var nome = document.getElementById('nome').value;
    var cognome = document.getElementById('cognome').value;
    var cf  = document.getElementById('codiceFiscale').value;
    var numero= document.getElementById('nTelefono').value;
    var email= document.getElementById('email').value;
    var nCartaCredito= document.getElementById('cartaCredito').value;

    cf.toLowerCase();
    var validazione = true;

    if (nome.trim() == "") {
        alert("E' necessario inserire il nome");
        validazione = false;
    }
    if (cognome.trim() == "") {
        alert("E' necessario inserire il cognome");
        validazione = false;
    }
    if (cf.trim() == "") {
        alert("E' necessario inserire il codice fiscale");
        validazione = false;

    }
    else if (cf.length <16) {
        alert("E' necessario inserire un codice fiscale corretto (lunghezza 16)");
        validazione = false;

    }
    if (numero.trim() == "") {
        alert("E' necessario inserire il numero di telefono");
        validazione = false;

    }
    else if (numero.length <10) {
        alert("E' necessario inserire un numero di cellulare valido (lunghezza 10)");
        validazione = false;

    }
    if(isNaN(numero)){
        alert("Il numero di telefono non può contenere lettere");
        validazione = false;

    }
    if (email.trim() == "") {
        alert("E' necessario inserire un indirizzo mail");
        validazione = false;

    }
    if (nCartaCredito.trim() == "") {
        alert("E' necessario inserire il numero della carta di credito per l'addebito dei servizi");
        validazione = false;
    }
    else if (nCartaCredito.length <16) {
        alert("E' necessario inserire un numero di carta valido (lunghezza 16)");
        validazione = false;

    }
    if (isNaN(nCartaCredito)) {
        alert("Il numero di carta non può contenere lettere");
        validazione = false;

    }
    if(nome.includes("'") || nome.includes("\\") || cognome.includes("'") || cognome.includes("\\")
    || cf.includes("'") || cf.includes("\\") || email.includes("'") || email.includes("\\")){

        alert("I campi di inserimento non possono contenere i caratteri ' e \\");
        validazione = false;
    }
    
    if(validazione){

        document.getElementById("validazioneRegistrazione").submit();
    } 
}

function validazioneData(){ // controlli sulle date inserite nelle pagina di gestione delle stazioni

    var dataInferiore = document.getElementById("dataInferiore").value;
    var dataSuperiore = document.getElementById("dataSuperiore").value;
    var validazione = true;

    if(dataInferiore > dataSuperiore){
        alert("La data inferiore non può essere successiva alla superiore");
        validazione = false;
    }
    if(dataInferiore.length == 0 || dataSuperiore.length == 0){
        alert("Inserire correttamente le date");
        validazione = false;
    }

    if(validazione){
        document.getElementById("validazioneDate").submit();
    }
}

function validazioneAggiuntaAdmin(){ //controlli sull'inserimento di un nuovo amministratore

    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var x = document.getElementsByName("filtroRuolosx");
    var ruolo = x[0].value;

    var validazione = true;

    if(username.includes("'") || username.includes("\\") || password.includes("'") || password.includes("\\") ){
        alert("Username e password non possono contenere i caratteri ' e \\");
        validazione = false;
    }

    if (username.trim() == "") {
        alert("E' necessario inserire lo username");
        validazione = false;
        
    }
    if (password.trim() == "") {
        alert("E' necessario inserire la password");
        validazione = false;
        
    }
    if (ruolo == -1) {
        alert("E' necessario specificare un ruolo");
        validazione = false;
        
    }
    
    return validazione;    
}
function validazioneModificaAdmin(){ //controlli sulle modifiche degli amministratori

    var x = document.getElementsByName("filtroUtentedx");
    utente = x[0].value;
    var x = document.getElementsByName("nuovaPassword");
    nuovaPassword = x[0].value;
    var x = document.getElementsByName("filtroRuolodx");
    nuovoRuolo = x[0].value;
    
    var validazione = true;

    alert(utente);

    if (utente == -1){
        alert("Non è stato selezionato l'utente da gestire");
        validazione = false;
    }
    if (nuovoRuolo == -1){
        alert("Non è stato selezionato alcun nuovo ruolo. Verrà lasciato inalterato");
    }
    if (nuovaPassword.trim() == "") {
        alert("Non è stato inserita la nuova password. Verrà lasciata inalterata");
    }
    if(nuovaPassword.trim() == "" && nuovoRuolo == -1){
        alert("E' stato selezionato l'utente, ma non cosa si vuole modificare");
        validazione = false;
    }
    if(nuovaPassword.includes("'") || nuovaPassword.includes("\\") ) {
        alert("La password non può contenere i caratteri ' e \\");
        validazione = false;
    }
    
    return validazione;

}

function validazioneEliminaAdmin(){ //controlli sull'eliminazione degli amministratori

    var validazione = true;
    var x = document.getElementsByName("filtroUtenteElimina");
    if( x[0].value == -1){
        alert("Non è stato selezionato alcun utente da eliminare");
        validazione = false;
    }
    return validazione;
}