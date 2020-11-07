

<template>

<div class="q-pa-md" style="color:grey; background-color: ghostwhite;">
  <q-tabs  v-model="tab"  class="text-teal">
      <q-tab name="progetto"  icon="account_box" label="Progetto" />
      <q-tab name="anagraficaIntervento"  icon="alarm" label="Anagrafica intervento" /> 
      <q-tab name="screening"  icon="movie" label="Screening" />
    </q-tabs> 

    <div  v-if="tab == 'progetto'">
          <div class="row">
              <div class="col text-h4 text-center">Dati del progetto</div>
          </div>
    <div class="row" >
        <div class="col">
            <q-input outlined v-model="titoloProgetto" label="Titolo del progetto" />
        </div>
    </div>


    <!-- ANAGRAFICA CLIENTI -->
    <div class="q-gutter-xs"  style="color:grey; ">
      <div class="col"><hr><br><b>Anagrafica Clienti</b></div>
        
    </div>
    <div class="row">
      <div class="col-10">
        <q-input v-model="search" debounce="500"  outlined :dense=true filled placeholder="Cerca Anagrafica" >
          <template v-slot:append>
            <q-icon name="search" />
          </template>
         
        </q-input>
        </div>
        <div class="col-2"> <q-btn   label="Crea"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" /></div>
    </div>
    
    <div class="row" style="padding-top:20px">
      <div class="col-12">
       
      </div>
    </div>
    
    <div class="row"  style="border-bottom:1px solid black">
      <div class="col"><b>Nome</b> </div> 
      <div class="col"><b>Cognome</b> </div>
      <div class="col"><b>Codice Fiscale</b> </div>  
  </div>

  <div  class="row" v-for="item in elencoAnagraficaClienti" :key="item.message" style="border-bottom:1px solid black">
    <div class="col"> {{ item.nome }}</div>
    <div class="col"> {{ item.cognome }}</div>
    <div class="col"> {{ item.codiceFiscale }}</div>
  </div>
   <!-- FINE ANAGRAFICA CLIENTI -->

    <!-- collaboratori interni -->
    
    <div class="row">
      <div class="col"><hr><br><b>Collaboratori interni</b></div>
        
    </div>
    <div class="row">
      <div class="col-10">
        <q-input v-model="search" debounce="500"  outlined :dense=true filled placeholder="Cerca Anagrafica" >
          <template v-slot:append>
            <q-icon name="search" />
          </template>
         
        </q-input>
        </div>
        <div class="col-2"> <q-btn   label="Crea"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" /></div>
    </div>
    
    <div class="row" style="padding-top:20px">
      <div class="col-12">
       
      </div>
    </div>
    
    <div class="row"  style="border-bottom:1px solid black">
      <div class="col"><b>Nome</b> </div> 
      <div class="col"><b>Cognome</b> </div>
      <div class="col"><b>Codice Fiscale</b> </div>  
  </div>

  <div  class="row" v-for="item in elencoAnagraficaClienti" :key="item.message" style="border-bottom:1px solid black">
    <div class="col"> {{ item.nome }}</div>
    <div class="col"> {{ item.cognome }}</div>
    <div class="col"> {{ item.codiceFiscale }}</div>
  </div>
   <!-- FINE collaboratori interni -->

    <!-- collaboratori esterni -->
    <div class="row">
      <div class="col"><hr><br><b>Collaboratori Esterni</b></div>
        
    </div>
    <div class="row">
      <div class="col-10">
        <q-input v-model="search" debounce="500"  outlined :dense=true filled placeholder="Cerca Anagrafica" >
          <template v-slot:append>
            <q-icon name="search" />
          </template>
         
        </q-input>
        </div>
        <div class="col-2"> <q-btn   label="Crea"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" /></div>
    </div>
    
    <div class="row" style="padding-top:20px">
      <div class="col-12">
       
      </div>
    </div>
    
    <div class="row"  style="border-bottom:1px solid black">
      <div class="col"><b>Nome</b> </div> 
      <div class="col"><b>Cognome</b> </div>
      <div class="col"><b>Codice Fiscale</b> </div>  
  </div>

  <div  class="row" v-for="item in elencoAnagraficaClienti" :key="item.message" style="border-bottom:1px solid black">
    <div class="col"> {{ item.nome }}</div>
    <div class="col"> {{ item.cognome }}</div>
    <div class="col"> {{ item.codiceFiscale }}</div>
  </div>
   <!-- FINE collaboratori esterni -->

  </div>


<!-- SCHEDA 2 -->
    <div v-if="tab =='anagraficaIntervento'"  style="color:grey; ">

        <div class="row" style="background-color: white;">
            <div class="col">
                <b>Tipologia Edificio</b>
                <div class="q-gutter-sm">
      <q-radio v-model="tipologiaEdificio" val="condominio" label="Condominio" />
      <q-radio v-model="tipologiaEdificio" val="edificioFamiliare" label="Edificio Familiare" />
      <q-radio v-model="tipologiaEdificio" val="commerciale" label="Commerciale" />
      <q-radio v-model="tipologiaEdificio" val="altro" label="altro" />
      
    </div>
            </div>
        </div>
          <!--***** Edificio Familiare **** -->
        <div v-if="tipologiaEdificio =='edificioFamiliare'" class="bgmargintop"  >
          <span class="text-h6"><b>Edificio Unifamiliare</b></span>
          <div class="row">
            <div class="col">
              <q-radio v-model="edificioUnifamiliareTipo" val="unifimaliare" label="Edificio residenziale unifamiliare" /> 
              
              <q-radio v-model="edificioUnifamiliareTipo" val="plurifimiliare" label="Unità immobiliare sita all’interno di edifici plurifamiliari" /> 

            </div>
          </div>
          <div class="row" style="padding-top:20px">
            <div class="col-12"><b> Dati proprietario dell'immobile </b></div>
            <div class="col-12">
              <q-btn   label="Aggiungi"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" />
            </div>
          </div>
          <div class="row"  style="border-bottom:1px solid black">
            <div class="col"><b>Nome</b> </div>  
            <div class="col"><b>Cognome</b> </div>  
            <div class="col"><b>Codice Fiscale</b> </div>  
  </div>
  <div  class="row" v-for="item in elencoAnagraficaClienti" :key="item.message" style="border-bottom:1px solid black">
    <div class="col"> {{ item.nome }}</div>
    <div class="col"> {{ item.cognome }}</div>
    <div class="col"> {{ item.codiceFiscale }}</div>
   
            </div>
           <div class="row" style="padding-top:20px">
             <div class="col">
               <label><b>Dati dell'immobile </b></label>
             </div>
           </div>
          <div class="row">
            
            <div class="col"><q-input v-model="edificioUnifamiliareIndirizzo"  outlined :dense=true type="text" label="Indirizzo" style="padding:5px" /></div>
            <div class="col"><q-input v-model="edificioUnifamiliarecitta"   outlined :dense=true  type="text" label="Città" style="padding:5px" /></div>
            <div class="col"><q-input v-model="edificioUnifamiliareProvincia"   outlined :dense=true  type="text" label="Provincia" style="padding:5px" /></div>
            <div class="col"><q-input v-model="edificioUnifamiliareAnnocostruzione"    outlined :dense=true  type="text" label="Anno di costruzione" style="padding:5px" /></div>
          </div>
          
          <div class="row" style="padding-top:20px;">
            <div class="col">
              <label><b>Piano immobile</b></label>
              <q-input v-model="edificioUnifamiliarePianoImmobile" type="text"  outlined :dense="true" />
            </div>
          </div>

 <q-space />


        </div>

                <!--***** Edificio Condominio********-->
        <div v-if="tipologiaEdificio == 'condominio'"   class="bgmargintop"  >
        <span class="text-h6"><b>Condominio</b></span>  
          <div class="row">
            <div class="col">
              <q-input v-model="condominioNome"  outlined :dense=true   type="text"  style="padding:5px" label="Nome Condominio" /><!-- Riportare nel mandato per la redazione dello studio di fattibilità-->

            </div>
          </div>

          <div class="row">
            <div class="col">
              <q-input v-model="condominioIndirizzo"  outlined :dense=true  type="text"  style="padding:5px" label="Indirizzo" />
            </div>
            <div class="col">
              <q-input v-model="condominioCitta"   outlined :dense=true type="text"  style="padding:5px" label="Citta" />
            </div>
            <div class="col">
              <q-input v-model="condominioProvincia"  outlined :dense=true type="text"  style="padding:5px" label="Provincia " />
           </div>
           
           </div>

          <div class="row">
            <div class="col-2">
              <q-input v-model="condominioAnnodicotruzione" type="number"  outlined :dense=true   style="padding:5px" label="Anno di costruzione " />
            </div>
            <div class="col-2">
              <q-input v-model="condominioPianoimmboile"  outlined :dense=true type="text"  style="padding:5px" label="Piano Immobile " />
            </div>
          </div>

          <div class="row" style="padding-top:20px">
            <div class="col-4">
              <label><b>Numero u. i. accatastate (escluse pertinenze)</b>
             <q-icon name="info" >
               <q-tooltip anchor="top middle" self="bottom middle">
                Riportare il n. di unità abitative accatastate (comprese A1, A8, A9, uffici) ad eccezione delle pertinenze
                </q-tooltip> 
              </q-icon>
              </label>
               <q-input v-model="condominioNumeroUnitaAccatastate" outlined :dense=true  type="number"  style="padding:5px;max-width:150px" />
               </div> 
               
            <div class="col-3">
              <label> <b> Numero u.i. attualmente riscaldate</b>
              <q-icon name="info" >
                <q-tooltip anchor="top middle" self="bottom middle">
                  Nel caso di impianto centralizzato, riportare il n. di unità abitative riscaldate.<br>
                  Nel caso di impianto autonomo, riportare il n. di unità abitative dotate di impianto di riscaldamento.
                </q-tooltip> 
              </q-icon>
            </label>
              <q-input v-model="condominioNumerounitariscaldate" type="text"   style="padding:5px;max-width:150px" outlined :dense=true />
            </div>
          </div>


          <div class="row" style="padding-top:20px">
            <div class="col-12">
            <b> Numero pertinenze autonomamente accatastate </b>
              
              <q-icon name="info" >
                <q-tooltip anchor="top middle" self="bottom middle">
                  Riportare il n. di pertinenze autonomamente accatastate. <br>Si considerano pertinenze le seguenti categorie catastali:
                </q-tooltip> 
              </q-icon>
              
            </div>
            <div class="col-12">
              <q-checkbox right-label v-model="condominioPertinenzaC2" value="C/2" label="C/2 magazzini e locali di deposito" />
              <q-checkbox right-label v-model="condominioPertinenzaC6" value="C/6" label="C/6 stalle, scuderie, rimesse, autorimesse" />
              <q-checkbox right-label v-model="condominioPertinenzaC7" value="C/7" label="C/7 tettoie chiuse o aperte" />
            </div>

          </div>
          <div class="row" style="padding-top:20px">
           
          </div>


          <div class="row">
            <div class="col-12">
              <b>Il condominio è formalmente costituito?</b>
              <q-icon name="info" >
                <q-tooltip anchor="top middle" self="bottom middle">
                - Barrare la casella “SI” se l’edificio oggetto di intervento è costituito da oltre 8 unità immobiliari. In tal caso vi è l’obbligo di costituire formalmente il condominio e nominare l’amministratore.
                - Barrare la casella “NO” in caso di condominio minimo ovvero quando l’edificio oggetto di intervento è costituito da un n. di condomìni inferiore a 8. 
                </q-tooltip> 
              </q-icon>
            </div>
            <div class="col-12">
              <q-radio v-model="condominioformalmenteCostituito" val="SI" label="SI" />
              <q-radio v-model="condominioformalmenteCostituito" val="NO" label="NO" />
            </div>
          </div>
          <div class="row" v-if="condominioformalmenteCostituito == 'SI'">
            <div class="col-3">
              <q-input v-model="condominioFormalmenteCostituitoCodiceFsicale" outlined :dense=true type="text" label="Codice Fiscale Condominio"  style="padding:5px;max-width:250px" maxlength="16" />
              </div>
            <div class="col"> 
               <q-input v-model="condominioFormalmenteCostituitoRiferimentoAmministatore" outlined :dense=true type="text" style="padding:5px;" label="Riportare Nome e Cognome, email (no pec) e num. di telefono" />
               </div>
          </div>
          
          <div class="row" v-if="condominioformalmenteCostituito == 'NO'">
            <div class="col-4">
              <q-input v-model="condominioNOformalmenteCostituitoReferente" outlined :dense=true type="text" label="Riferimento Referente" style="padding:5px;" />
              </div>
              
            <div class="col-4">
              <q-input v-model="condominioNOformalmenteCostituitoCodiceFiscaleReferente" outlined :dense=true type="text" label="Codice Fsicale Referente"  style="padding:5px;max-width:250px" maxlength="16"  />
            </div>
          </div>

          
 <q-space />

<div class="row"><div class="col"><hr/></div></div>
        </div>



        <div :v-if="tipologiaEdificio == 'condominio' || tipologiaEdificio=='edificioFamiliare'"  class="bgmargintop" >

          <div class="row " style="padding-top:20px;">
              <div class="col-12">
                
                <label class=""><b>Zona climatica</b> <q-icon name="info" > 
                <q-tooltip anchor="top middle" self="bottom middle">
              Riportare la zona climatica secondo la Tabella A del DPR 412/1993 e s.m.i:
                </q-tooltip> 
                </q-icon> 

                </label>
              </div>
          <div class="col-12">
                  <q-checkbox v-model="zonaclimaticaA" label="Zona A: GG<600" /> 
                  <q-checkbox v-model="zonaclimaticaB" label="Zona B: 601<GG<900" /> 
                  <q-checkbox v-model="zonaclimaticaC" label="Zona C: 901<GG>1400" /> 
                  <q-checkbox v-model="zonaclimaticaD" label="Zona D: 1401<GG>2100" /> 
                  <q-checkbox v-model="zonaclimaticaE" label="Zona E: 2101<GG>3000" /> 
                  <q-checkbox v-model="zonaclimaticaF" label="Zona F: GG>3000" /> 

                </div>
          </div>

          <div class="row" style="padding-top:20px; ">
            <div class="col-5">
           
              <label>
              <b>Gradi giorno </b>
              <q-icon name="info" > 
                <q-tooltip anchor="top middle" self="bottom middle">
                Riportare i Gradi Giorno della località oggetto di intervento:
                </q-tooltip> 
                </q-icon> 
                </label>

                <q-input outlined :dense=true style="max-width:200px"   v-model="gradigiornoText" type="text" label="Gradi" />
               
             </div>
          </div>


        <div class="row" style="padding-top:20px">
          <div class="col">
            <b>L’immobile è in area vincolata (Decreto Legislativo 22 gennaio 2004, n. 42):</b>
            <div class="q-gutter-sm">
            <q-radio v-model="areavincolata42" val="SI" label="SI" /> 
            <q-radio v-model="areavincolata42" val="NO" label="NO" /> 
            <q-input  type="text" v-if="areavincolata42 == 'SI'" label="Specificare il tipo di vincolo" v-model="areaVicnolata42TipoVincolo" />
          </div>
          </div>
        </div>

        <div class="row" style="padding-top:20px">
          <div class="col"><b>L’immobile il quale zona sismica ricade</b>
           <div class="q-gutter-sm">
          <q-radio v-model="zonasismisca4" val="1" label="Zona 1" /> 
          <q-radio v-model="zonasismisca4" val="2" label="Zona 2" /> 
          <q-radio v-model="zonasismisca4" val="3" label="Zona 3" /> 
          <q-radio v-model="zonasismisca4" val="4" label="Zona 4" /> 
          <q-input  type="text"  v-model="zonasismisca4Interventiantisismici" v-if="zonasismisca4 != ''" label="Compilare solo nel caso in cui siano previsti interventi antisismici" />
          <q-input  type="text"  v-model="zonasismisca4Interventiantisismici" v-if="zonasismisca4 != ''" label="Altri vincoli" />
          </div>
          </div>
        </div>
        <div class="row" style="padding-top:20px">
            <div class="col-12">
              <b>Tipologia intervento proposto</b>

            </div>
            <div class="col4">
              <q-checkbox right-label  v-model="TipoInterventoPropostoEnergetico" label="Energetico" />
              <q-checkbox right-label v-model="TipoInterventoPropostoSismico" label="Sismico" />
              <q-checkbox right-label v-model="TipoInterventoPropostoCombinato" label="Combinato" />
            </div>
          </div>
        <div class="row" style="padding-top:20px">
            <div class="col-12">
              <b>Tipologia intervento DPR 380/2001</b>

            </div>
            <div class="col4">
              <q-checkbox right-label  v-model="TipologiainterventoDPR3802001Ordinaria" value="ordinaria" label="Manutenzione Ordinaria" />
              <q-checkbox right-label v-model="TipologiainterventoDPR3802001Straordinaria" value="straordinaria" label="Manutenzione straordinaria" />
              <q-checkbox right-label v-model="TipologiainterventoDPR3802001RisanamentoConcervativo" value="risanamentoConservativo"  label="Restauro e risanamento conservativo" />
              <q-checkbox right-label v-model="TipologiainterventoDPR3802001RistrutturazioneEdilizia" value="ristrutturazioneEdilizia"  label="Ristrutturazione Edilizia" />
              <q-checkbox right-label v-model="TipologiainterventoDPR3802001NuovaCostruzione" value="nuovaCostruzione"  label="Nuova Costruzione" />
              <q-checkbox right-label v-model="TipologiainterventoDPR3802001InterventiUrbanistici" value="ristrutturazioneUrbanistica"  label="Interventi di ristrutturazione urbanistica" />
            </div>
          </div>

        <div class="row">
          <div class="col">
            <hr>
            </div>
        </div>
        </div>

       
        


        <!--*** Progettisti *** -->
        <div class="row">
          <div class="col">
            <div class="col-12"><b>Progettisti</b></div>
           
          </div>
        </div>
         <div class="row" style="padding-top:20px">
            <div class="col-12"> <q-input v-model="cercaProgettista" outlined :dense=true type="text" label="Cerca" /></div>
            <div class="col-12">
              <q-btn   label="Crea"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" />
            </div>
          </div>
          <div class="row"  style="border-bottom:1px solid black">
            <div class="col"><b>Nome</b> </div>  
            <div class="col"><b>Cognome</b> </div>  
            <div class="col"><b>Codice Fiscale</b> </div>  
  </div>
  <div  class="row" v-for="item in elencoAnagraficaClienti" :key="item.message" style="border-bottom:1px solid black">
    <div class="col"> {{ item.nome }}</div>
    <div class="col"> {{ item.cognome }}</div>
    <div class="col"> {{ item.codiceFiscale }}</div>
   
            </div>




    </div><!--Anagrafica intervento -->






      <!-- ******SCREENING********-->
<div v-if="tab=='screening'" style="color:grey">
  <div v-if="tipologiaEdificio == 'edificioFamiliare'">
  <div class="row">
    <div class="col-12">
      <b>L’unità immobiliare è funzionalmente indipendente?</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
          N.B. L’U.I. è funzionalmente indipendente se è dotata di installazioni o manufatti <br>
          di qualunque genere, quali impianti per l’acqua, per il gas, per l’energia elettrica, <br>
          per il riscaldamento di proprietà esclusiva.
        </q-tooltip>
      </q-icon>
    </div>
    <div class="col-12">
      <q-radio v-model="screeningUnifamiliareIndipendente" val="SI" label="SI" />
      <q-radio v-model="screeningUnifamiliareIndipendente" val="NO" label="NO" />
      
      </div>
  </div>
  <div class="row">
    <div class="col-12">
      <b>L’unità immobiliare è dotata di accesso autonomo?</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
         N.B. L’U.I. è dotata di accesso autonomo se dispone di un accesso indipendente non comune ad <br>
altre unità immobiliari chiuso da cancello o portone di ingresso che consenta l’accesso <br>
dalla strada o dal cortile o giardino anche di proprietà non esclusiva.  
        </q-tooltip>
      </q-icon>
    </div>
    <div class="col-12">
      <q-radio v-model="screeningUnifamiliareIAcessoAutonomo" val="SI" label="SI" />
      <q-radio v-model="screeningUnifamiliareIAcessoAutonomo" val="NO" label="NO" />
      
      </div>
  </div>

  <div class="row">
    <div class="col-12">
      <b>Il proprietario dell’immobile ha già usufruito o
ha intenzione di usufruire della detrazione
al 110% per altre unità immobiliari?</b>
     
    </div>
    <div class="col-12">
      <q-radio v-model="screeningUnifamiliareUsufruito110" val="SI" label="SI" />
      <q-radio v-model="screeningUnifamiliareUsufruito110" val="NO" label="NO" />
      
      </div>
  </div>
<div class="row">
    <div class="col-12">
      <b>Sono previste opere di riqualificazione dei balconi?</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
ad es. rifacimento della pavimentazione, ringhiere, frontalini, ecc….  
        </q-tooltip>
      </q-icon>
    </div>
    <div class="col-12">
      <q-radio v-model="screeningUnifamiliareRiqualificazioneBalconi" val="SI" label="SI" />
      <q-radio v-model="screeningUnifamiliareRiqualificazioneBalconi" val="NO" label="NO" />
      
      </div>
  </div>




  </div>
  <div v-if="tipologiaEdificio == 'condominio'">

 <div class="row">
    <div class="col-12">
      <b>E' presente un unico proprietario
 o comproprietari di tutte le u.i. del condominio?</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
In caso di risposta affermativa, interrompere la compilazione del questionario e verificare la fattibilità dell’operazione con EHUB.
        </q-tooltip>
      </q-icon>
    </div>
    <div class="col-12">
      <q-radio v-model="screeningCondominioUnicoProprietario" val="SI" label="SI" />
      <q-radio v-model="screeningCondominioUnicoProprietario" val="NO" label="NO" />
      
      </div>
  </div>

 <div class="row">
    <div class="col-12">
      <b>Ci sono unità immobiliari di proprietà di 
soggetti IRES?</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
I soggetti passivi IRES sono:
- le società di capitali ed enti equiparati
-enti pubblici/privati diversi dalle società che hanno come oggetto principale o esclusivo l’esercizio dell’attività commerciale
-  enti pubblici/privati diversi dalle società che non hanno come oggetto principale o esclusivo l’esercizio dell’attività commerciale
- società ed enti di ogni tipo con o senza personalità giuridica
        </q-tooltip>
      </q-icon>
    </div>
    <div class="col-12">
      <q-radio v-model="screeningCondominioSoggettiIRES" val="SI" label="SI" />
      <q-radio v-model="screeningCondominioSoggettiIRES" val="NO" label="NO" />
      
      </div>
  </div>

 <div class="row">
    <div class="col-12">
      <b>Ci sono condòmini che possiedono più di due unità immobiliari all'interno del condominio?</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
In caso di risposta affermativa, relativamente agli interventi realizzati sulle singole unità immobiliari, il condomìno potrà fruire della detrazione 110% su max 2 U.I.
Tale limitazione non si applica alle spese sostenute per interventi realizzati sulle parti comuni degli edifici in condominio.        </q-tooltip>
      </q-icon>
    </div>
    <div class="col-12">
      <q-radio v-model="screeningCondominioPossiedonoMultiProprieta" val="SI" label="SI" />
      <q-radio v-model="screeningCondominioPossiedonoMultiProprieta" val="NO" label="NO" />
      
      </div>
  </div>


 <div class="row">
    <div class="col-12">
      <b>Sono presenti u.i. con categoria catastale A1, A8 o A9?</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
          A1- Abitazione di tipo signorile
          A8- Abitazione in villa
          A9- Castelli, palazzi di eminenti pregi artistici o storici 
          </q-tooltip>
      </q-icon>
    </div>
    <div class="col-12">
      <q-radio v-model="screeningCondominioA1A8A9" val="SI" label="SI" />
      <q-radio v-model="screeningCondominioA1A8A9" val="NO" label="NO" />
      
      </div>
  </div>

 <div class="row">
    <div class="col-12">
      <b>Ci sono condòmini che hanno già usufruito o che hanno intenzione di usufruire della detrazione al 110% per altre u. i. esterne al condominio??</b>
      
    </div>
    <div class="col-12">
      <q-radio v-model="screeningCondominioA1A8A9" val="SI" label="SI" />
      <q-radio v-model="screeningCondominioA1A8A9" val="NO" label="NO" />
      
      </div>
  </div>

</div>



  <div class="row">
      <div class="col">
         <b style="color:red">Riportare di seguito la % per ciascuna categoria catastale DA RIVEDERE</b>
        
      </div>
    </div>

      <!-- Titolo autorizzativi-->

 <div class="row">
    <div class="col-13 col-md-13">
      <b>Tipologia Titolo</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
        Riportare il titolo con il quale è stato edificato l’edificio
          </q-tooltip>
      </q-icon>
    </div>
    <div class="col-12">
      <label for="">Riferimenti</label>
      <q-input v-model="text" type="text" outlined :dense="true"  />

      <label>Data</label>
     <q-input  outlined :dense="true"  v-model="date" mask="date" :rules="['date']">
      <template v-slot:append>
        <q-icon name="event" class="cursor-pointer">
          <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
            <q-date v-model="date">
              <div class="row items-center justify-end">
                <q-btn v-close-popup label="Close" color="primary" flat />
              </div>
            </q-date>
          </q-popup-proxy>
        </q-icon>
      </template>
    </q-input>
      
      </div>
       <q-file
      v-model="files"
      label="Carica file"
      filled
      multiple
      style="max-width: 300px"
    />
  </div>

 <div class="row">
    <div class="col-13 col-md-13">
      <b>Successivi interventi di manutenzione straordinaria 
(con SCIA, CILA, ecc..)</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
     Riportare eventuali interventi successivi relativi all’edificio nel suo complesso
          </q-tooltip>
      </q-icon>
    </div>
    <div class="col-12">
      <label for="">Anno di intervento</label>
      <q-input v-model="text" outlined :dense="true" type="text"/> 
    
      
      </div>
       <q-file
      v-model="files"
      label="Carica file"
      filled
      multiple
      style="max-width: 300px"
    />
  </div>

<!-- ALLEGATI INTERVENTI SUCCESSIVI ALLA COSTRUZIONE -->
  <div class="row " >
    <div class="col-12"><label for=""><b>Titoli autorizzativi relativi ad interventi successivi alla costruzione – area allegato -</b></label></div>
    <div class="col-2"> <q-btn icon="add" class="white" label="Aggiungi" @click=" modalAggiungiAllegatiInterventiSuccessiviAllaCostruzione=true " /></div>

  </div>
  <div class="row">
    <div class="col"><b>Sub</b></div>
    <div class="col"><b>Successivi interventi</b></div>
    <div class="col"><b>Allegato</b></div>
    </div>
 <div  class="row" v-for="item in elencoTitoliAutorizzatiInterventiSuccessivi" :key="item.message" style="border-bottom:1px solid black">
    <div class="col"> {{ item.sub }}</div>
    <div class="col"> {{ item.descrizione }}</div>
    <div class="col"> {{ item.allegato }}</div>
  </div>

<!-- DATI CATASTALI -->
  <div class="row " style="padding-top:10px" >
    <div class="col-12"><label for=""><b>Dati catastali</b></label></div>
    <div class="col-2"> <q-btn icon="add" class="white" label="Aggiungi" @click=" modalDatiCatastaliTitoliAutorizzativi=true " /></div>

  </div>
  <div class="row">
    <div class="col"><b>foglio</b></div>
    <div class="col"><b>Particella</b></div>
    <div class="col"><b>Sub</b></div>

    </div>
 <div  class="row" v-for="item in elencoTitoliAutorizzatiDatiCatastali" :key="item.message" style="border-bottom:1px solid black">
    <div class="col"> {{ item.foglio }}</div>
    <div class="col"> {{ item.particella }}</div>
    <div class="col"> {{ item.sub }}</div>

  </div>


  <div class="row"  style="padding-top:10px" >
    <div class="col-12">
      <strong class="text-h6">Verifica di conformità</strong>
      </div>
  </div>
   
  <div class="row"  style="padding-top:10px" >  
    <div class="col-12">
      <strong>Nell’edificio sono presenti abusi edilizi? </strong>
    </div>

    <div class="col-12">
      <q-radio v-model="abusiEdilizi" val="SI" label="SI" />
      <q-radio v-model="abusiEdilizi" val="NO" label="NO" />
    </div>
    
    <div class="col-12" v-if="abusiEdilizi =='SI'  ">
      <label for="">Specificare la tipologia</label>
      <q-input v-model="TipologiaAbusiEdilizi" type="text" :dense='true' outlined  />
    </div>

  </div>
  <div class="row"  style="padding-top:10px" >  
    <div class="col-12">
      <strong>Il progetto in atto al comune risulta corrispondente allo stato di fatto:</strong>
    </div>

    <div class="col-12">
      <q-radio v-model="comuneStatoDiFatto" val="SI" label="SI" />
      <q-radio v-model="comuneStatoDiFatto" val="NO" label="NO" />
    </div>

  </div>
  <div class="row"  style="padding-top:10px" >  
    <div class="col-12">
      <strong>La planimetria censita al NCEU risulta corrispondente allo stato di fatto:</strong>
    </div>

    <div class="col-12">
      <q-radio v-model="NCEUStatoDiFatto" val="SI" label="SI" />
      <q-radio v-model="NCEUStatoDiFatto" val="NO" label="NO" />
    </div>

  </div>
  <div class="row"  style="padding-top:10px" >  
    <div class="col-12">
      <strong>L’immobile presenta difformità urbanistiche*:</strong>
    </div>

    <div class="col-12">
      <q-radio v-model="difformitaUrbanistiche" val="SI" label="SI" />
      <q-radio v-model="difformitaUrbanistiche" val="NO" label="NO" />
    </div>
    <div class="col-12" v-if="difformitaUrbanistiche == 'SI'">
      <q-input v-model="noteDifformitaUrbanistiche" outlined  type="textarea" label="Note Difformità urbanistiche" />
    </div>

  </div>
  <div class="row"  style="padding-top:10px" >  
    <div class="col-12">
      <strong>L’immobile presenta difformità catastali**:</strong>
    </div>

    <div class="col-12">
      <q-radio v-model="difformitaCatastali" val="SI" label="SI" />
      <q-radio v-model="difformitaCatastali" val="NO" label="NO" />
    </div>
<div class="col-12" v-if="difformitaCatastali == 'SI'">
      <q-input v-model="noteDifformitaCatastali" outlined  type="textarea" label="Note Difformità Catastali" />
    </div>

  </div>
  <div class="row"  style="padding-top:10px" >  
    <div class="col-12">
      <strong>Le eventuali irregolarità riscontrate sono sanabili***:</strong><q-icon name="info" ><q-tooltip>
        Specificare che le attività di sanatoria sono a carico del condominio.
Specificare che gli abusi verranno sanati prima della data di inizio lavori. 
Specificare le modalità e i tempi di sanatoria.
      </q-tooltip></q-icon>
    </div>

    <div class="col-12">
      <q-radio v-model="irregolaritaSanabili" val="SI" label="SI" />
      <q-radio v-model="irregolaritaSanabili" val="NO" label="NO" />
    </div>
<div class="col-12" v-if="irregolaritaSanabili == 'SI'">  
      <q-input v-model="noteIrregolaritaSanabili" outlined  type="textarea" label="Note Irregolarità Sanabili" />
    </div>

  </div>

 </div><!-- DIV TAB CHECK -->

 




<!-- MODAL -->
 <q-dialog v-model="modalNuovaAnagraficaClienti" persistent
      :maximized="maximizedToggle=true"
      transition-show="slide-up"
      transition-hide="slide-down">
      <q-card>
         <q-bar>
          <q-space />
          <q-btn dense flat icon="close" v-close-popup>
            <q-tooltip content-class="bg-white text-primary">Close</q-tooltip>
          </q-btn>
           </q-bar>
        <q-card-section>
          <div class="text-h6">Crea Nuova Anagrafica</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
       <formNuovaanagrafica></formNuovaanagrafica>
         </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Chiudi" color="primary" v-close-popup />
        </q-card-actions>
        
      </q-card>
    </q-dialog>

<q-dialog v-model="modalAggiungiAllegatiInterventiSuccessiviAllaCostruzione" persistent>
  <q-card>
    <q-card-section class="row items-center">
     
      <span class="q-ml-md">Aggiungi</span>
    </q-card-section>
    <q-card-section class="row items-center">
    
      <span class="q-ml-md">
        <q-input v-model="modalInterventiSuccessiviNuovoSub" type="text" label="sub" />
        <q-input v-model="modalInterventiSuccessiviNuovaDecrizione" type="text" label="descrizione" />
       <q-file
      v-model="modalInterventiSuccessiviNuovoAllegato"
      label="Carica file"
      filled
      style="max-width: 300px" />
      
        </span>
    </q-card-section>
    <q-card-actions align="right">
      <q-btn flat label="Annulla" color="primary" v-close-popup />
      <q-btn flat label="Conferma" color="primary" @click="addrowInterventiSuccessivi();"/>
    </q-card-actions>
  </q-card>
</q-dialog>

<q-dialog v-model="modalDatiCatastaliTitoliAutorizzativi" persistent>
  <q-card>
    <q-card-section class="row items-center">
     
      <span class="q-ml-md">Aggiungi</span>
    </q-card-section>
    <q-card-section class="row items-center">
    
      <span class="q-ml-md">
        <q-input v-model="modalDatiCatastaliTitoliAutorizzativiNuovoSub" type="text" label="sub" />
        <q-input v-model="modalDatiCatastaliTitoliAutorizzativiNuovoParticella" type="text" label="particella" />
        <q-input v-model="modalDatiCatastaliTitoliAutorizzativiNuovoFoglio" type="text" label="foglio" />
       
        </span>
    </q-card-section>
    <q-card-actions align="right">
      <q-btn flat label="Annulla" color="primary" v-close-popup />
      <q-btn flat label="Conferma" color="primary" @click="addrowDatiCatastaliTitoliAutorizzativi();"/>
    </q-card-actions>
  </q-card>
</q-dialog>

<!-- FINE  MODAL -->

  </div> <!-- quello iniziale -->

</template>
<style scoped>
.bgmargintop{
  background-color: white; margin-top:10px;
}
</style>
<script>


/*
import tabNuovo from '@/components/TabNuovoProgetto'

export default {
  name: 'tabDefault',

  components: {
    tabNuovo
  }

  }*/
</script>
<script>
import formNuovaanagrafica from '@/components/NuovaAnagrafica'
export default {

    methods: {
    addRow(){
       this.elencoAnagraficaClienti.push({nome:this.modalNuovoNome, cognome:this.modalNuovoCognome, codiceFiscale:this.modalNuovoCodiceFiscale});
      this.modalNuovaAnagraficaClienti= false;
    },
    addrowInterventiSuccessivi(){
      this.elencoTitoliAutorizzatiInterventiSuccessivi.push(
        {
          sub:this.modalInterventiSuccessiviNuovoSub,
          descrizione:this.modalInterventiSuccessiviNuovaDecrizione,
          allegato:this.modalInterventiSuccessiviNuovoAllegato.name
        }
         
         );

      this.modalAggiungiAllegatiInterventiSuccessiviAllaCostruzione= false;
    },
    addrowDatiCatastaliTitoliAutorizzativi(){
      this.elencoTitoliAutorizzatiDatiCatastali.push(
        {
          sub:this.modalDatiCatastaliTitoliAutorizzativiNuovoSub,
          particella:this.modalDatiCatastaliTitoliAutorizzativiNuovoParticella,
          foglio:this.modalDatiCatastaliTitoliAutorizzativiNuovoFoglio
         
        }
         
         );

      this.modalDatiCatastaliTitoliAutorizzativi= false;
    },
    removeRow(index){
   this.elencoAnagraficaClienti.splice(index, 1)
    }
    },
     
  data () {
    return {
text:'',data:'',date:'',

         tab: "progetto",
         modalNuovaAnagraficaClienti: false,
         modalNuovoNome:'',modalNuovoCognome:'',modalNuovoCodiceFiscale:'',
         
         screeningCondominioPossiedonoMultiProprieta:'',screeningCondominioPossiedonoMultiProprieta:'',

         modalAggiungiAllegatiInterventiSuccessiviAllaCostruzione:false,
         modalInterventiSuccessiviNuovoSub:'',
         modalInterventiSuccessiviNuovaDecrizione:'',
         modalInterventiSuccessiviNuovoAllegato:null,

         modalDatiCatastaliTitoliAutorizzativi:false,
         modalDatiCatastaliTitoliAutorizzativiNuovoParticella:'',
         modalDatiCatastaliTitoliAutorizzativiNuovoSub:'',
         modalDatiCatastaliTitoliAutorizzativiNuovoFoglio:'',
        

         titoloProgetto:'',search:'',tipologiaEdificio:'condominio',
         TipologiainterventoDPR3802001Ordinaria:false,TipologiainterventoDPR3802001Straordinaria:false,TipologiainterventoDPR3802001RisanamentoConcervativo:false,TipologiainterventoDPR3802001RistrutturazioneEdilizia:false,TipologiainterventoDPR3802001NuovaCostruzione:false,TipologiainterventoDPR3802001InterventiUrbanistici:false,
         
         zonaclimaticaA:false,zonaclimaticaB:false,zonaclimaticaC:false,zonaclimaticaD:false,zonaclimaticaE:false,zonaclimaticaF:false,
         
         gradigiornoText:'',areavincolata42:'',
         areaVicnolata42TipoVincolo:'',zonasismisca4:'',zonasismisca4Interventiantisismici:'',edificioUnifamiliareTipo:false,edificioUnifamiliareIndirizzo:'',
         edificioUnifamiliarecitta:'', edificioUnifamiliareProvincia:'', edificioUnifamiliareAnnocostruzione:'',
         edificioUnifamiliarePianoImmobile:' di cui fuori terra n° ',edificioUnifamiliareTipologiaIntervento:false,
         condominioNome:'',condominioIndirizzo:'',condominioCitta:'',condominioProvincia:'',
         condominioAnnodicotruzione:'',condominioPianoimmboile:'',condominioPertinenzaC2:false,condominioPertinenzaC6:false,condominioPertinenzaC7:false,
         condominioformalmenteCostituito:false,condominioFormalmenteCostituitoCodiceFsicale:'',condominioFormalmenteCostituitoRiferimentoAmministatore:'',
         condominioNOformalmenteCostituitoReferente:'',condominioNOformalmenteCostituitoCodiceFiscaleReferente:'',
         
         TipoInterventoPropostoEnergetico:false,TipoInterventoPropostoSismico:false,TipoInterventoPropostoCombinato:false,
         
         condominioNumeroUnitaAccatastate:'',condominioNumerounitariscaldate:'',cercaProgettista:'',screeningUnifamiliareIndipendente:'',screeningUnifamiliareIAcessoAutonomo:'',
         screeningUnifamiliareRiqualificazioneBalconi:'',
         screeningCondominioUnicoProprietario:'',screeningCondominioSoggettiIRES:'',PossiedonoMultiProprieta:'',screeningCondominioA1A8A9:'', 
          
          files: null,
          abusiEdilizi:false,TipologiaAbusiEdilizi:'',comuneStatoDiFatto:false,NCEUStatoDiFatto:false,difformitaUrbanistiche:false,difformitaCatastali:false,irregolaritaSanabili:false,
          noteDifformitaUrbanistiche:'',noteDifformitaCatastali:'',noteIrregolaritaSanabili:'',

       
      columns: [
        { name: 'id', align: 'center', label: 'ID', field: 'id', sortable: true },
        { name: 'nome', required: true, label: 'Nome', align: 'left', field: row => row.nome, format: val => `${val}`,sortable: true},
        { name: 'cognome', align: 'center', label: 'Cognome', field: 'cognome', sortable: true },
        { name: 'codiceFiscale', label: 'Codice Fiscale', field: 'codiceFiscale', sortable: true },
        { name: 'ragionesociale', label:'Ragione sociale', field:'ragionesociale'}
       
       
           ],
      elencoAnagraficaClienti: [
        {
            id:'82',
            nome: 'Mario',
            cognome: 'rossi',
            codiceFiscale: 'frlfgh67y57u576y',
            indice:1,
            cestino:'x'
          
        },
        {
            id:'58',
            nome: 'Giuseppe ',
            cognome: 'verdi',
            codiceFiscale: 'frlfgh67y57u576y',
            indice:2
        },
        {
            id:'35',
            nome: 'Mario',
            cognome: 'Bianchi',
            codiceFiscale: 'frlfgh67y57u576y',
            indice:3
        }
        
      ],
      elencoTitoliAutorizzatiInterventiSuccessivi:[
        {
          sub:'321',
          descrizione:'tipo intervento successivo 1',
          allegato:'doc1.pdf'
        },
        {
          sub:'321-2',
          descrizione:'tipo intervento successivo 2',
          allegato:'doc2.pdf'
          
        },
        {sub:'321-3',
        descrizione:'tipo intervento successivo 3',
        allegato:'doc3.pdf'},
        {sub:'321-4',
        descrizione:'tipo intervento successivo 4',
        allegato:'doc4.pdf'}
      ],
      elencoTitoliAutorizzatiDatiCatastali:[
          {
          particella:'321654',
          sub:'sub1',
          foglio:'folgio1'
          },
          {
          particella:'321654',
          sub:'sub2',
          foglio:'folgio2'
          },
          {
          particella:'321654',
          sub:'sub3',
          foglio:'folgio3'
          }
        ]
    }
  },

  components: {
     
    formNuovaanagrafica
  },

}
</script>