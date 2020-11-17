

<template>

<div class="q-pa-md" style="color:grey; background-color: ghostwhite;">
  
  <q-tabs  v-model="tab" style="border-bottom:1px black solid" >
      <q-tab name="progetto"  icon="account_box" label="Progetto" />
      <q-tab name="anagraficaIntervento"  icon="alarm" label="Anagrafica intervento" /> 
      <q-tab name="screening"  icon="movie" label="Screening" />
      <q-tab name="datiStrutturali"  icon="build" label="Dati Strutturali" />
      <q-tab name="allegati"  icon="attach_file" label="Allegati" />
      <q-tab name="quote"  icon="euro_symbol" label="Quote" />
     
    </q-tabs> 

<!-- #region progetto -->
    <div  v-if="tab == 'progetto'">
          <div class="row">
              <div class="col text-h4 text-center">Dati del progetto</div>
          </div>
    <div class="row" >
        <div class="col">
            <q-input outlined v-model="titoloProgetto" label="Titolo del progetto" />
        </div>
    </div>


    <!-- #region ANAGRAFICA CLIENTI -->
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
        <div class="col-2"> <q-btn   label="Crea"   :dense='true' icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" /></div>
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
   <!-- #endregion -->

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
        <div class="col-2"> <q-btn   label="Crea"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true"  :dense="true" /></div>
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
        <div class="col-2"> <q-btn   label="Crea"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" :dense="true" /></div>
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
<!-- #endregion -->

<!-- #region Anagrafica intervento -->
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
<!-- #endregion -->


<!-- #region  ******SCREENING********-->
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



 </div><!-- DIV TAB Screening -->
<!-- #endregion -->
 

 <!-- #region Dati Strutturati-->
<div v-if="tab == 'datiStrutturali' ">
<div class="row"><div class="col-12"><span class="text-h6">Dati strutturali</span></div></div>

  <div class="row">
    <div class="col-12">
    <strong>Tipologia struttura edificio:</strong>
    </div>
  
    <div class="col-3"><q-checkbox right-label v-model="datistrutturalichk" val="EdificioinMuraturaPortante" label="Edificio in Muratura Portante" /></div>
    <div class="col-3"><q-checkbox right-label v-model="datistrutturalichk" val="EdificioTelaioCAinopera" label="Edificio con telaio in C.A. in opera" /></div>
    <div class="col-3"><q-checkbox right-label v-model="datistrutturalichk" val="EdificioElementiPrefabbricati" label="Edificio con elementi prefabbricati" /></div>
    <div class="col-3"><q-checkbox right-label v-model="datistrutturalichk" val="altro" label="Altro" /></div>


  </div>
  <div class="row" v-if="datistrutturalichk.includes('altro')"><div class="col"><q-input v-model="altroDatiStrutturali" type="text" :dense="true" outlined label="Altro" /></div></div>
 
  <div class="row">
    <div class="col-12">
    <strong>Tipologia parete:</strong>
    </div>
   
    <div class="col-3"><q-checkbox right-label v-model="tipologiaParetechk" val="Laterizio" label="Laterizio" /></div>
    <div class="col-3"><q-checkbox right-label v-model="tipologiaParetechk" val="MuraturaCassaVuota" label="Muratura a cassa vuota" /></div>
    <div class="col-3"><q-checkbox right-label v-model="tipologiaParetechk" val="MuraturaCassaIsolanteIntercapedine" label="Muratura a cassa con isolante in intercapedine" /></div>
    <div class="col-3"><q-checkbox right-label v-model="tipologiaParetechk" val="Tufo" label="Tufo" /></div>
    <div class="col-3"><q-checkbox right-label v-model="tipologiaParetechk" val="Gasbeton" label="Gasbeton" /></div>
    <div class="col-3"><q-checkbox right-label v-model="tipologiaParetechk" val="altro" label="Altro" /></div>


  </div>
  <div class="row" v-if="tipologiaParetechk.includes('altro')"><div class="col"><q-input v-model="altroTipologiaParetechk" type="text" :dense="true" outlined label="Altro" /></div></div>

 <div class="row">
    <div class="col-12">
    <strong>Tipologia FOTO COSA FARE:</strong>
    </div>
   
    <div class="col-3"><q-checkbox right-label v-model="tipologiaParetechk" val="Laterizio" label="Presenza intercapedine/camera d’aria" /></div>
    <div class="col-3"><q-checkbox right-label v-model="tipologiaParetechk" val="MuraturaCassaVuota" label="Isolante in camera d’aria (sughero, EPS, ecc…)" /></div>
    <div class="col-3"><q-checkbox right-label v-model="tipologiaParetechk" val="MuraturaCassaIsolanteIntercapedine" label=" Idoneo a insufflaggio" /></div>
    <div class="row">
    <div class="col-4 paddingInput">
    <label for="">Spessori muri esterni (cm)</label>
    <q-input v-model="SpessoreMuriEsterni" type="text" outlined :dense="true"/>
    </div>
    <div class="col-4 paddingInput">
    <label for="">Spessoricamera d'aria (cm)</label>
    <q-input v-model="SpessoreCameraDaria" type="text" outlined :dense="true"/>
    </div>
    <div class="col-4 paddingInput">
    <label for="">Spessori Isolamento (cm)</label>
    <q-input v-model="SpessoreIsolamento" type="text" outlined :dense="true"/>
    </div>
    <div class="col-4 paddingInput">
    <label for="">Tipo isolante in camera d’aria</label>
    <q-input v-model="TipologiaIsolamentoIncameraDaria" type="text" outlined :dense="true"/>
    </div>
   </div>

  </div>

 <div class="row">
    <div class="col-12">
    <strong>Eventuale Isolante esistente(cappotto):</strong>
    </div>
   
    <div class="col-3"><q-checkbox right-label v-model="isolamentoEsistentechk" val="eps" label="EPS" /></div>
    <div class="col-3"><q-checkbox right-label v-model="isolamentoEsistentechk" val="sughero" label="Sughero" /></div>
    <div class="col-3"><q-checkbox right-label v-model="isolamentoEsistentechk" val="lanaDiroccaVetro" label="Lana di roccia/vetro " /></div>
    <div class="col-3"><q-checkbox right-label v-model="isolamentoEsistentechk" val="altro" label="Altro" /></div>
    


  </div>
  <div class="row" v-if="isolamentoEsistentechk.includes('altro')"><div class="col"><q-input v-model="altroisolamentoEsistentechk" type="text" :dense="true" outlined label="Altro" /></div></div>

<div class="row" style="padding-top:20px"><div class="col"><span class="text-h6">Dati Centrale Termina</span></div></div>

<div class="row"><div class="col-12">
  <label class="text-bold">Tipologia Impianto esistente</label></div>
  <div class="col-12">
    <q-radio v-model="tipologiaImpiantoEsistente" val="centralizzato" label="Centralizzato" />
    <q-radio v-model="tipologiaImpiantoEsistente" val="autonomo" label="autonomo" />
    <q-radio v-model="tipologiaImpiantoEsistente" val="assente" label="assente" />
    
    </div>
  </div>

<!-- #region CENTRALIZZATO -->
  <div  v-if="tipologiaImpiantoEsistente == 'centralizzato'">
<div class="row"><div class="col"><span class="text-bold">Stato di fatto</span></div></div>
<div class="row">
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold" >Tecnologia impianto esistente</label>
 
  <q-select v-model="cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente" :dense='true' outlined :options="tecnologieCentraliTermiche"  />

  <q-input v-show="cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente.value == 'altro' " v-model="cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro" outlined :dense="true" type="text" label="Specificare"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Numero unità di generazione</label>
  <q-input v-model="cetraleTermicaCentralizzatoNumeroUnita" outlined :dense="true" type="text"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Anno di installazionee</label>
  <q-input v-model="cetraleTermicaCentralizzatoAnnoInstallazione" outlined :dense="true" type="text"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Potenza termica utile impianto esistente [kWt]</label>
  <q-input v-model="cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente" outlined :dense="true" type="text"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Tipologia di distribuzione esistente</label>
  <q-input v-model="cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste" outlined :dense="true" type="text"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Tipologia sistema di termoregolazione evoluta</label>
  <q-input v-model="cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente" outlined :dense="true" type="text"  />
  
  </div>
  <div class="col-md-12 col-12">
    <label for="" class="text-bold">Disponibilità libretto di impianto aggiornato</label><br>
    <q-radio v-model="cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato" val="SI" label="SI" />
    <q-radio v-model="cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato" val="NO" label="NO" />
    <q-radio v-model="cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato" val="Assente" label="Assente" />
    <div v-if="cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato == 'SI'">
      <q-file
      v-model="cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato"
      label="allegare copia libretto "
      outlined
      :dense="true"
      style="max-width: 300px" />

      </div>
  </div>
  <div class="col-md-12 col-12">
    <label for="" class="text-bold">Disponibilità prove fumi aggiornate</label><br>
    <q-radio v-model="cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate" val="SI" label="SI" />
    <q-radio v-model="cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate" val="NO" label="NO" />
    <q-radio v-model="cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate" val="Assente" label="Assente" />
    <div v-if="cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate == 'SI'">
       <q-file
      v-model="cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato"
      label="allegare copia libretto "
      outlined
      :dense="true"
      style="max-width: 300px" />
      QUI PURE ALLEGATI?</div>
  </div>
  <div class="col-md-12 col-12">
    <label for="" class="text-bold">Disponibilità prove fumi aggiornate</label><br>
    <q-radio v-model="cetraleTermicaCentralizzatoCertificatoCPI" val="SI" label="SI" />
    <q-radio v-model="cetraleTermicaCentralizzatoCertificatoCPI" val="NO" label="NO" />
    <q-radio v-model="cetraleTermicaCentralizzatoCertificatoCPI" val="Assente" label="Assente" />
    <div v-if="cetraleTermicaCentralizzatoCertificatoCPI == 'SI'">
       <q-file
      v-model="cetraleTermicaCentralizzatoCertificatoCPIAllegato"
      label="allegare copia libretto "
      outlined
      :dense="true"
      style="max-width: 300px" />
      
      
      QUI PURE ALLEGATI?</div>
  </div>
</div>
<div class="row"><div class="col text-bold text-h5 primary" >Stato di Progetto</div></div>
<div class="row">
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold" >Tecnologia impianto esistente</label>

  <q-select v-model="cetraleTermicaCentralizzatoTecnologiaImpiantoProposto" :dense='true' outlined :options="tecnologieCentraliTermiche"  />

  <q-input v-show="cetraleTermicaCentralizzatoTecnologiaImpiantoProposto.value == 'altro' " v-model="cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro" outlined :dense="true" type="text" label="Specificare"  />
  
  </div>
<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Numero unità di generazione</label>
  <q-input v-model="cetraleTermicaCentralizzatoNumeroUnitaProposte" outlined :dense="true" type="text"  />
  
  </div>

  <div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Potenza termica utile impianto esistente [kWt]</label>
  <q-input v-model="cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto" outlined :dense="true" type="text"  />
  
  </div>

<div class="col-md-3 col-12 paddingInput">
  <label class="text-bold">Vettore energetico impianto</label>
  <q-input v-model="centraleTermivaCentralizzatoVettoreImpianto" outlined :dense="true" type="text"  />
  
  </div>

  </div>

  </div>

  <!-- #endregion  -->

  <div  v-if="tipologiaImpiantoEsistente == 'autonomo'">
    <div class="row"><div class="col"><span class="text-bold text-h5">Stato di fatto</span></div></div>
    <div class="row"><div class="col">
      <q-btn  class="white" icon="add" label="Aggiungi" @click="modalAggiungiImpiantoEsistenteAutonomo=true" /><!--TODO CAMBIARE CLICK BOTTONE MODAL -->
      
      </div></div>
<div class="row" style="border-bottom:1px solid black">
  <div class="col">Sub</div>
  <div class="col">Tecnologia impianto1</div>
  <div class="col">N. unità di generazione</div>
  <div class="col">Tipologia sistema di termoregolazione</div>
  <div class="col">Potenza termica utile [kW]</div>
  <div class="col">Anno installazione</div>
  <div class="col">Generatore oggetto di sostituzione?</div>
  </div>

 <div  class="row" v-for="item in elencoImpiantoAutonomoEsistente" :key="item.message" style="border-bottom:1px solid black">
     <div class="col"> {{ item.sub }}</div>
     <div class="col"> {{ item.tecnologiaImpianto }}</div>
     <div class="col"> {{ item.numeronUnitaGenerazione }}</div>
     <div class="col"> {{ item.tipologiaSistemaTermoregolazione }}</div>
     <div class="col"> {{ item.potenzaTermicaUtile }}</div>
     <div class="col"> {{ item.annoInstallazione }}</div>
     <div class="col"> {{ item.GeneratoreOggettoDiSostituzione }}</div>
   
  </div>
    <div class="row"><div class="col"><span class="text-bold text-h5">Stato di Progetto</span></div></div>
    <div class="row"><div class="col">
      <q-btn  class="white" icon="add" label="Aggiungi" @click="modalAggiungiImpiantoEsistenteAutonomo=true" /><!--TODO CAMBIARE CLICK BOTTONE MODAL -->
      
      </div></div>
<div class="row" style="border-bottom:1px solid black">
  <div class="col">Sub</div>
  <div class="col">Tecnologia impianto1</div>
  <div class="col">N. unità di generazione</div>
  <div class="col">Tipologia sistema di termoregolazione</div>
  <div class="col">Potenza termica utile [kW]</div>
  <div class="col">Anno installazione</div>
  <div class="col">Generatore oggetto di sostituzione?</div>
  </div>

 <div  class="row" v-for="item in elencoImpiantoAutonomoEsistente" :key="item.message" style="border-bottom:1px solid black">
     <div class="col"> {{ item.sub }}</div>
     <div class="col"> {{ item.tecnologiaImpianto }}</div>
     <div class="col"> {{ item.numeronUnitaGenerazione }}</div>
     <div class="col"> {{ item.tipologiaSistemaTermoregolazione }}</div>
     <div class="col"> {{ item.potenzaTermicaUtile }}</div>
     <div class="col"> {{ item.annoInstallazione }}</div>
     <div class="col"> {{ item.GeneratoreOggettoDiSostituzione }}</div>
   
  </div>

  </div>

</div>
<!-- #endregion -->

<div v-if="tab == 'allegati'">

<span class="text-h5">Allegati</span>

  
<div class="row">
  <div class="col-3">
     <label class="text-bold"> Allegato</label>
  <q-file v-model="allegatoDiAllegati"   label="Carica file"  outlined :dense="true"   style="max-width: 300px" /> 
  </div>
  <div class="col-6">  
    <label class="text-bold"> Tipo Allegato</label>
    <q-select v-model="tipoAllegatodiAllegati" :options="tipiDiAllegati" :dense="true" outlined label="Standard"  />
  </div>
   <div class="col-12"> 
    <label for="" class="text-bold"> Note</label>
    <q-input v-model="noteallegatoDiallegati" outlined :dense="true" type="text" label="Label" />  
  </div>
  <div class="col-12" style="margin-top:10px;"><q-btn class="white" icon="add" label="Aggiungi" @click="addrowAllegati()" /></div>
   
     </div>
<div class="row" style="margin-top:20px"> 
  <div class="col">File</div>
  <div class="col">Note</div>
  <div class="col">Tipo Documento</div>
  
</div>
<div class="row" v-for="allegato in elencoAllegati" :key="allegato.nomeFile">
  <div class="col"> {{allegato.nomeFile}}</div>
  <div class="col">{{allegato.noteFile}}</div>
  <div class="col">{{allegato.tipoAllegato}}</div>
</div>

</div>


<div v-if="tab == 'quote'">

<div class="row"><div class="col"></div></div>

<div class="row">
  <div class="col">Quota</div>
  <div class="col">Tipo</div>
  <div class="col">Data Pagamento</div>
  <div class="col">Metodo di pagamento</div>
  </div>
<div class="row" v-for="quota in elencoQuote" :key="quota.quota">
  <div class="col"> {{quota.quota}}</div>
  <div class="col">{{quota.tipo}}</div>
  <div class="col">{{quota.dataPagamento}}</div>
  <div class="col">{{quota.metodoPagamento}}</div>

</div>

</div>

<!-- #region MODAL-->
<!-- MODAL -->
 <q-dialog v-model="modalNuovaAnagraficaClienti" persistent
      :maximized="maximizedToggle=true"
      transition-show="slide-up"
      transition-hide="slide-down">
      <q-card>
         <q-bar>
          <q-space />
          <q-btn dense="true" flat icon="close" v-close-popup>
            <q-tooltip content-class="bg-white text-primary">Close</q-tooltip>
          </q-btn>
           </q-bar>
        <q-card-section>
          <div class="text-h6">Crea Nuova Anagrafica</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
       <formNuovaanagrafica idutente=''></formNuovaanagrafica>
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
<q-dialog v-model="modalAggiungiImpiantoEsistenteAutonomo" persistent>
  <q-card>
    <q-card-section class="row items-center">
     
      <span class="q-ml-md">Aggiungi</span>
    </q-card-section>
    <q-card-section class="row items-center">
    
      <span class="q-ml-md">
          
        <q-input v-model="NuovoImpiantoEsistenteAutonomosub" type="text" label="sub" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomotecnologiaImpianto" type="text" label="Tecnologia impianto" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione" type="text" label="N. unità di generazione" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione" type="text" label="Tipologia sistema di termoregolazione" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile" type="text" label="Potenza termica utile [kW]" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomoannoInstallazione" type="text" label="Anno installazione" />
        <label class="text-bold">Generatore oggetto di sostituzione?</label>
        <q-radio v-model="NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione" val="SI" label="SI" />
        <q-radio v-model="NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione" val="NO" label="NO" />
        
       
       
        </span>
    </q-card-section>
    <q-card-actions align="right">
      <q-btn flat label="Annulla" color="primary" v-close-popup />
      <q-btn flat label="Conferma" color="primary" @click="addrowImpiantoAutonomoEsistente();"/>
    </q-card-actions>
  </q-card>
</q-dialog>

<!-- FINE  MODAL -->
<!-- #endregion -->
  </div> <!-- quello iniziale con TAB -->

</template>
<style scoped>
.bgmargintop{
  background-color: white; margin-top:10px;
}
.paddingInput{padding:10px;}
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
    addrowImpiantoAutonomoEsistente(){
      this.elencoImpiantoAutonomoEsistente.push(
        {
            sub:this.NuovoImpiantoEsistenteAutonomosub,
            tecnologiaImpianto:this.NuovoImpiantoEsistenteAutonomotecnologiaImpianto,
            numeronUnitaGenerazione:this.NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione,
            tipologiaSistemaTermoregolazione:this.NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione,
            potenzaTermicaUtile:this.NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile,
            annoInstallazione:this.NuovoImpiantoEsistenteAutonomoannoInstallazione,
            GeneratoreOggettoDiSostituzione:this.NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione
            }
         
         );

      this.modalAggiungiImpiantoEsistenteAutonomo= false;
    },
    addrowImpiantoAutonomoProposto(){
      this.elencoImpiantoAutonomoProposto.push(
        {
            sub:this.NuovoImpiantoEsistenteAutonomosub,
            tecnologiaImpianto:this.NuovoImpiantoEsistenteAutonomotecnologiaImpianto,
            numeronUnitaGenerazione:this.NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione,
            tipologiaSistemaTermoregolazione:this.NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione,
            potenzaTermicaUtile:this.NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile,
            annoInstallazione:this.NuovoImpiantoEsistenteAutonomoannoInstallazione,
            GeneratoreOggettoDiSostituzione:this.NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione
            }
         
         );

      this.modalAggiungiImpiantoEsistenteAutonomo= false;
    },
    addrowAllegati(){
//TODO prevedere caricaemnto sul database diretto
this.elencoAllegati.push({nomeFile:this.allegatoDiAllegati.name,path:'',noteFile:this.noteallegatoDiallegati, tipoAllegato:this.tipoAllegatodiAllegati.label });

    },

    
    removeRow(index){
   this.elencoAnagraficaClienti.splice(index, 1)
    }
    },
     
  data () {
    return {
        text:'',data:'',date:'',

         tab: "datiStrutturali",
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

          datistrutturalichk:[],altroDatiStrutturali:'',
          tipologiaParetechk:[],altroTipologiaParetechk:'',
          SegnapostotipologiaParetechk:[],SpessoreMuriEsterni:'',SpessoreCameraDaria:'',SpessoreIsolamento:'',TipologiaIsolamentoIncameraDaria:'',
          isolamentoEsistentechk:[],altroisolamentoEsistentechk:'',

          tipologiaImpiantoEsistente:'',

          cetraleTermicaCentralizzatoNumeroUnita:'', cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente:'', cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro:'', cetraleTermicaCentralizzatoAnnoInstallazione:'',cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato:null,
          cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente:'', cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste:'', cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente:'',
          cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato:'', cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate:'', cetraleTermicaCentralizzatoCertificatoCPI:'',
          cetraleTermicaCentralizzatoCertificatoCPIAllegato:null,cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato:null,
          
          cetraleTermicaCentralizzatoTecnologiaImpiantoProposto:'',cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro:'', cetraleTermicaCentralizzatoNumeroUnitaProposte:'', centraleTermivaCentralizzatoVettoreImpianto:'',cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto:'',


          modalAggiungiImpiantoEsistenteAutonomo:false,
          NuovoImpiantoEsistenteAutonomosub:'', NuovoImpiantoEsistenteAutonomotecnologiaImpianto:'',NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione:'',NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione:'',
          NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile:'',NuovoImpiantoEsistenteAutonomoannoInstallazione:'',NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione:'',
       allegatoDiAllegati:null,tipoAllegatodiAllegati:'',noteallegatoDiallegati:'',
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
      ],
      elencoImpiantoAutonomoEsistente:[
          {
            sub:'1',
            tecnologiaImpianto:'2',
            numeronUnitaGenerazione:'3',
            tipologiaSistemaTermoregolazione:'4',
            potenzaTermicaUtile:'5',
            annoInstallazione:'6',
            GeneratoreOggettoDiSostituzione:'7',
          }
      ],
      elencoImpiantoAutonomoProposto:[
          {
            sub:'1',
            tecnologiaImpianto:'2',
            numeronUnitaGenerazione:'3',
            tipologiaSistemaTermoregolazione:'4',
            potenzaTermicaUtile:'5',
            annoInstallazione:'6',
            GeneratoreOggettoDiSostituzione:'7',
          }
      ],
      tecnologieCentraliTermiche:[
          {
            label:'Caldaia a gas',
            value:'CaldaiaGas'
          },
          {
            label:'caldaia a condensazione',
            value:'caldaiaCondensazione'
          },
          {
            label:'pompa di calore',
            value:'pompaDiCalore'
          },
          {
            label:'caldaia a gasolio',
            value:'caldaiaGasolio'
          },
          {
            label:'altro (specificare)',
            value:'altro'
          }
      ],
      elencoAllegati:[
        {
        nomeFile:'file.pdf',
        path:'pathfile',
        noteFile:'Note file',
        tipoAllegato:'Modello privacy'
        },
        {
        nomeFile:'file.pdf',
        path:'pathfile',
        noteFile:'Note file',
        tipoAllegato:'Modello privacy'
        },
        {
        nomeFile:'file.pdf',
        path:'pathfile',
        noteFile:'Note file',
        tipoAllegato:'Modello privacy'
        },
        {
        nomeFile:'file.pdf',
        path:'pathfile',
        noteFile:'Note file',
        tipoAllegato:'Modello privacy'
        }



      ],
     elencoMetodoPagamenti:[
       {value:'c/c',label:'Conto corrente'},
       {value:'carta',label:'Carta'},
       {value:'carta2',label:'Carta C'}
       
       ],
     tipiDiAllegati:[
        {
        value:'ModelloPrivacy',
        label:'Modello privacy',
        },
        {
        value:'Visure',
        label:'Visure',
        },
        {
        value:'TitoloProvenienza',
        label:'Titolo di provenienza',
        },
        {
        value:'DocumentiIdentita',
        label:'Documenti di identità',
        },
        {
        value:'ConcessioneEdilizia',
        label:'Concessione edilizia',
        },
        {
        value:'Agibilita',
        label:'Agibilità',
        },
        {
        value:'PermessoCostruire',
        label:'Permesso di Costruire',
        },
        {
        value:'Cila',
        label:'Cila',
        },
        {
        value:'Cil',
        label:'Cil',
        },
        {
        value:'AgibilitaAbitabilita',
        label:'Agibilità\abitabilità',
        },
        {
        value:'SCA',
        label:'SCA',
        },
        {
        value:'SCIA',
        label:'SCIA',
        },
        {
        value:'DIA',
        label:'DIA',
        },
        {
        value:'CertificazioniVarie',
        label:'Certificazioni varie',
        },
        {
        value:'DocumentiStrutture',
        label:'Documenti Strutture',
        },
        {
        value:'DocumentiImpianti',
        label:'Documenti Impianti',
        },
        {
        value:'PareriVariEnti',
        label:'Pareri vari enti',
        },
        {
        value:'APE',
        label:'APE',
        },
        {
        value:'Contratto',
        label:'Contratto',
        },
        
      ],
      elencoQuote:[
        {quota:10,tipo:'Tipo A',dataPagamento:'01/11/2020',metodoPagamento:'C/C'},
        {quota:15,tipo:'Tipo A',dataPagamento:'5/11/2020',metodoPagamento:'C/C'},
        {quota:16,tipo:'Tipo A',dataPagamento:'10/11/2020',metodoPagamento:'C/C'},
        {quota:20,tipo:'Tipo B',dataPagamento:'12/11/2020',metodoPagamento:'C/C'}
  
        ]
    }
  },

  components: {
     
    formNuovaanagrafica
  },

}
</script>