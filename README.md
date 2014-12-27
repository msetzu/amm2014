amm2014
=======

L'applicazione presentata agisce da semplice gestione elettronica di cartelle cliniche di un ospedale. Il sistema permette di creare nuovi pazienti, assegnare loro reparti e numeri di letto, aggiungere e cancellare dati alla rispettiva cartella clinica, corredati di data di inizio e di fine dei sintomi relativi. È possibile iscriversi al servizio secondo due ruoli, quello di 'Studente' e quello di 'Dottore'.

##Requisiti

+ Pattern MVC: Added
+ html5: Added
+ css: Added
+ php: Added
mySQL: Added (Transazione utilizzata nel file 'model/caseEntriesFactory.php', funzione 'deleteEntry($id)')
+ ajax: Added (Utilizzato nel file '/controller/js/bedChecker.js', verifica in real-time la disponibilità del letto cui si sta cercando di assegnare il paziente.)
