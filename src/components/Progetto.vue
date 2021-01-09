

<template>
<!--q-pa-md-->
<div class=" " style="color:grey; background-color:#f2f4f8; width:100%">
  
  <q-tabs  v-model="tab" inline-label style="background-color:#fdfdfd"  >
      <q-tab name="progetto"  icon="account_box" label="Progetto"  />
      <q-tab name="anagraficaIntervento"  icon="alarm" label="Anagrafica intervento" /> 
      <q-tab name="screening"  icon="movie" label="Screening" />
      <q-tab name="datiStrutturali"  icon="build" label="Dati Strutturali" />
      <q-tab name="allegati"  icon="attach_file" label="Allegati" />
      <q-tab name="quote"  icon="euro_symbol" label="Quote" />
     
    </q-tabs> 

<!-- #region progetto -->
    <div  v-if="tab == 'progetto'">
          <div class="row justify-center">
              <div class=" text-h4 text-center text-secondary"><span class="text-secondary"> Dettagli Progetto</span></div>
          </div>
    <div class="row  justify-center"  >
        <div class=" col-12 col-md-7 bgmargintop">
            <q-input outlined v-model="titoloProgetto" label="Titolo del progetto" />
        </div>
    </div>



    <!-- #region ANAGRAFICA CLIENTI -->
    <div style="padding-top:20px">
    <div class="row justify-center"  style="color:grey; ">
      <div class="col-12 col-md-7 bgAree"><b>Aggiungi i Clienti</b></div>
      
    </div>
    <div class="row justify-center">
      <div class="col-12 col-md-7 bgAree">
        <q-input v-model="cercaAnagraficaClienti" debounce="500"  outlined :dense=true  placeholder="Cerca Cliente da aggiungere - Inserire 4 caratteri per avviare la ricerca" @keypress=" elencoCercaAnagraficaClientiFunction()">
          <div class="autocomplete-items" v-if="cercaAnagraficaClienti.length > 2">
            <div class="row"  v-for="item in elencoCercaAnagraficaClienti" :key="item.message">
              <div class="col">
                <a href="#" @click="aggiungiElencoClienti(item)">  {{ item.nome }} {{item.cognome}} {{item.denominazione}}</a></div>

            </div>
          </div>
          <template v-slot:append>
            <q-icon name="search" />
          </template>
         
        </q-input>
        </div>
        <!-- <div class="col-2"> <q-btn   label="Crea"   :dense='true' icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" /></div> -->
    </div>
    
    
        
    <div class="row justify-center "  style="justify-center" >
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Nome</b> </div> 
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Cognome</b> </div>
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black ">  <b>Codice Fiscale</b> </div>  
      <div class="col-1 col-md-1 bgAree" style="border-bottom:1px solid black ">  <b></b> </div>  
     
  </div>

  <div  class="row justify-center " v-for="(item,index) in elencoAnagraficaClienti" :key="item.message" >
    <div class="col-4 col-md-2 bgAree"> {{ item.nome }} {{ item.id }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.cognome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.codiceFiscale }}</div>
    <div class="col-1 col-md-1 bgAree"> 
    <q-btn   size="sm" round icon="delete" @click="elencoAnagraficaClienti.splice(index, 1)" />
  
  </div>
 
  </div>
  </div>
   <!-- #endregion -->

    <!-- collaboratori interni -->
    <div style="padding-top:20px">
    <div class="row justify-center">
      <div class="col-12 col-md-7 bgAree"><b>Collaboratori interni</b></div>
        
    </div>
    <div class="row justify-center">
      <div class="col-12 col-md-7 bgAree">
         <q-input v-model="cercaCollaboratoriInterni" debounce="500"  outlined :dense=true  placeholder="Inserire 4 caratteri per avviare la ricerca"  @keypress="elencoCercaCollaboratoreInternoFunction()">
          <div class="autocomplete-items" v-if="cercaCollaboratoriInterni.length > 2">
            <div class="row"  v-for="item in elencoCercaCollaboratoreInterno" :key="item.message">
              <div class="col">
                <a href="#" @click="aggiungiElencoCollaboratoreInterno(item)">  {{ item.nome }} {{item.cognome}} {{item.denominazione}}</a></div>

            </div>
          </div>  
          <template v-slot:append>
            <q-icon name="search" />
          </template>
         
        </q-input>
        </div>
       <!--  <div class="col-2"> <q-btn   label="Crea"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true"  :dense="true" /></div> -->
    </div>
    
    <div class="row justify-center"  style="">
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Nome</b> </div> 
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black ">  <b>Cognome</b> </div>
      <div class="col-4 col-md-2 bgAree" style="border-bottom:1px solid black "><b>Codice Fiscale</b> </div>  
      <div class="col-1 col-md-1 bgAree" style="border-bottom:1px solid black "></div>  
  </div>

  <div  class="row justify-center" v-for="item in elencoCollaboratoriInterno" :key="item.message" style="">
    <div class="col-4 col-md-2 bgAree"> {{ item.nome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.cognome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.codiceFiscale }}</div>
    <div class="col-1 col-md-1 bgAree"> 
    <q-btn   size="sm" round icon="delete" @click="elencoCollaboratoriInterno.splice(index, 1)" />
  
  </div>
  </div>
</div>

   <!-- FINE collaboratori interni -->

    <!-- collaboratori esterni -->
    <div style=padding-top:20px>
    <div class="row justify-center">
      <div class="col-12 col-md-7 bgAree"><b>Collaboratori Esterni</b></div>
        
    </div>
    <div class="row  justify-center">
      <div class="col-12 col-md-7 bgAree">
       <q-input v-model="cercaCollaboratoriEsterni" debounce="500"  outlined :dense=true  placeholder="Inserire 4 caratteri per avviare la ricerca"  @keypress="elencoCercaCollaboratoreEsternoFunction()">
          <div class="autocomplete-items" v-if="cercaCollaboratoriEsterni.length > 2">
            <div class="row"  v-for="item in elencoCercaCollaboratoreEsterno" :key="item.message">
              <div class="col">
                <a href="#" @click="aggiungiElencoClientiCollaboratoreEsterno(item)">  {{ item.nome }} {{item.cognome}} {{item.denominazione}}</a></div>

            </div>
          </div>  
        <template v-slot:append>
            <q-icon name="search" />
          </template>
         
        </q-input>
        </div>
       <!-- <div class="col-2"> <q-btn   label="Crea"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" :dense="true" /></div> -->
    </div>
    
    
    <div class="row justify-center" >
      <div class="col-4 col-md-2 bgAree"  style="border-bottom:1px solid black"><b>Nome</b> </div> 
      <div class="col-4 col-md-2 bgAree"  style="border-bottom:1px solid black"><b>Cognome</b> </div>
      <div class="col-4 col-md-2 bgAree"  style="border-bottom:1px solid black"><b>Codice Fiscale</b> </div>  
      <div class="col-1 col-md-1 bgAree"  style="border-bottom:1px solid black"></div>  
  </div>

  <div  class="row justify-center" v-for="item in elencoCollaboratoriEnterno" :key="item.message">
    <div class="col-4 col-md-2 bgAree"> {{ item.nome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.cognome }}</div>
    <div class="col-4 col-md-2 bgAree"> {{ item.codiceFiscale }}</div>
     <div class="col-1 col-md-1 bgAree"> 
    <q-btn   size="sm" round icon="delete" @click="elencoCollaboratoriEnterno.splice(index, 1)" />
  
  </div>
  </div>
  </div>
   <!-- FINE collaboratori esterni -->
<div class="">
<div class="row"><div class="col"><div class="col-2"> <q-btn   label="Aggiungi Nuova Anagrafica" color="secondary"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" :dense="true" /></div></div></div>

</div>
  </div>
<!-- #endregion -->

<!-- #region Anagrafica intervento -->
    <div v-if="tab =='anagraficaIntervento'"  style="color:grey; ">

        <div class="row" style="background-color: white;">
            <div class="col">
                <b>Tipologia Edificio</b>
                <div class="q-gutter-sm">
      <q-radio v-model="tipologiaEdificio" val="condominio" label="Condominio" />
      <q-radio v-model="tipologiaEdificio" val="edificioFamiliare" label="Edificio Residenziale" />
      <q-radio v-model="tipologiaEdificio" val="commerciale" label="Commerciale" />
      <q-radio v-model="tipologiaEdificio" val="altro" label="altro" />
      
    </div>
            </div>
        </div>
          <!--***** Edificio Familiare **** -->
        <div v-if="tipologiaEdificio =='edificioFamiliare' || tipologiaEdificio =='commerciale'  || tipologiaEdificio =='altro' " class="bgmargintop"  >
          <span class="text-h6"><b>Edificio</b></span>
          <div class="row">
            <div class="col">
              <q-radio v-model="edificioUnifamiliareTipo" val="unifimaliare" label="Edificio residenziale unifamiliare" /> 
              
              <q-radio v-model="edificioUnifamiliareTipo" val="plurifimiliare" label="Unità immobiliare sita all’interno di edifici plurifamiliari" /> 
              <q-radio v-model="edificioUnifamiliareTipo" val="commeciale" label="Commerciale" /> 
              <q-radio v-model="edificioUnifamiliareTipo" val="altro" label="Altro" /> 
              <q-input v-model="text" type="text" label="Altro" :dense="true" outlined  v-if="edificioUnifamiliareTipo == 'altro' "/>

            </div>
          </div>
          <div class="row q-gutter-xs" style="padding-top:20px">
            <div class="col-12"><b> Dati proprietario dell'immobile </b></div>
            <!--<div class="col-12">
              <q-btn   label="Aggiungi"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" />
            </div> -->
            <div class="col-2">
              <label>Nome</label>
              <q-input v-model="NuovoProprietarioImmobileNome" type="text" :dense="true"  outlined/>
              </div>
            <div class="col-2">
               <label>Cognome</label>
              <q-input v-model="NuovoProprietarioImmobileCognome" type="text" :dense="true"  outlined/>
           </div> 
            <div class="col-2">
               <label>Codice Fiscale</label>
              <q-input v-model="NuovoProprietarioImmobileCodiceFiscale" type="text" maxlength="15" :dense="true"  outlined/>
          
            </div>
            <div class="col-2">
               <label>Telefono</label>
              <q-input v-model="NuovoProprietarioImmobileTelefono" type="text" :dense="true" outlined  />
          </div>
          <div class="col-2">
            <q-btn color="primary"  style="margin-top:23px" icon="add" :dense="true"  outline @click="addRowProprietariImmobile()" /></div>


          </div>
          <div class="row"  style="border-bottom:1px solid black">
            <div class="col-2"><b>Nome</b> </div>  
            <div class="col-2"><b>Cognome</b> </div>  
            <div class="col-2"><b>Codice Fiscale</b></div>  
            <div class="col-2"><b>Telefono</b></div>  
            <div class="col-2"><b></b></div>  
          </div>
          
          <div  class="row" v-for="(item,index) in elencoProprietariImmobile" :key="item.message" style="border-bottom:1px solid black">
            <div class="col"> {{ item.nome }}</div>
            <div class="col"> {{ item.cognome }}</div>
            <div class="col"> {{ item.codiceFiscale }}</div>
            <div class="col"> {{ item.telefono }}</div>
            <div class="col">   <q-btn   size="sm" round icon="delete" @click="elencoProprietariImmobile.splice(index, 1)" />
            </div>
   
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
              <q-checkbox right-label v-model="condominioPertinenzaC2C6C7" val="C/2" label="C/2 magazzini e locali di deposito" />
              <q-checkbox right-label v-model="condominioPertinenzaC2C6C7" val="C/6" label="C/6 stalle, scuderie, rimesse, autorimesse" />
              <q-checkbox right-label v-model="condominioPertinenzaC2C6C7" val="C/7" label="C/7 tettoie chiuse o aperte" />
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
                  <q-checkbox v-model="zonaClimatica" label="Zona A: GG<600" val="zonaA" /> 
                  <q-checkbox v-model="zonaClimatica" label="Zona B: 601<GG<900" val="zonaB"  /> 
                  <q-checkbox v-model="zonaClimatica" label="Zona C: 901<GG>1400" val="zonaC"  /> 
                  <q-checkbox v-model="zonaClimatica" label="Zona D: 1401<GG>2100" val="zonaD"  /> 
                  <q-checkbox v-model="zonaClimatica" label="Zona E: 2101<GG>3000" val="zonaE"  /> 
                  <q-checkbox v-model="zonaClimatica" label="Zona F: GG>3000" val="zonaF"  /> 

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
          <q-input  type="text"  v-model="zonasismisca4InterventiantisismiciAltriVincoli" v-if="zonasismisca4 != ''" label="Altri vincoli" />
          </div>
          </div>
        </div>
        <div class="row" style="padding-top:20px">
            <div class="col-12">
              <b>Tipologia intervento proposto</b>

            </div>
            <div class="col4">
              <q-checkbox right-label  v-model="TipoInterventoProposto" label="Energetico" val="energetico" />
              <q-checkbox right-label v-model="TipoInterventoProposto" label="Sismico"  val="sismico"/>
              <q-checkbox right-label v-model="TipoInterventoProposto" label="Combinato" val="combinato" />
            </div>
          </div>
        <div class="row" style="padding-top:20px">
            <div class="col-12">
              <b>Tipologia intervento DPR 380/2001</b>

            </div>
            <div class="col4">
              <q-checkbox right-label  v-model="TipologiainterventoDPR3802001" val="ordinaria" label="Manutenzione Ordinaria" />
              <q-checkbox right-label v-model="TipologiainterventoDPR3802001" val="straordinaria" label="Manutenzione straordinaria" />
              <q-checkbox right-label v-model="TipologiainterventoDPR3802001" val="risanamentoConservativo"  label="Restauro e risanamento conservativo" />
              <q-checkbox right-label v-model="TipologiainterventoDPR3802001" val="ristrutturazioneEdilizia"  label="Ristrutturazione Edilizia" />
              <q-checkbox right-label v-model="TipologiainterventoDPR3802001" val="nuovaCostruzione"  label="Nuova Costruzione" />
              <q-checkbox right-label v-model="TipologiainterventoDPR3802001" val="ristrutturazioneUrbanistica"  label="Interventi di ristrutturazione urbanistica" />
            </div>
          </div>

        <div class="row">
          <div class="col">
            <hr>
            </div>
        </div>
        </div>

       
        


        <!--*** Progettisti *** -->
        <div class="bgAree">
        <div class="row " >
          <div class="col">
            <div class="col-12"><b>Progettisti</b></div>
           
          </div>
        </div>
        <div class="row q-gutter-sm "  style="padding-top:20px">
            <div class="col-7">
               <q-input v-model="cercaProgettista" @keypress=" elencoCercaAnagraficaProgettistiFunction()" outlined :dense=true type="text" label="Cerca" >
               <div class="autocomplete-items" v-if="cercaProgettista.length > 2">
            <div class="row"  v-for="item in elencoCercaAnagraficaProgettisti" :key="item.message">
              
              <div class="col">
                <a  @click="aggiungiElencoProgettisti(item)">  {{ item.nome }} {{item.cognome}} {{item.denominazione}}</a>
              </div>
                
            

            </div>
             
          </div>
           <template v-slot:append>
            <q-icon name="search" />
          </template>
         
        </q-input>
               </div>
            <div class="col-2">
              <q-btn   label="Crea"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" />
            </div>
        </div>
        <div class="row"  style="border-bottom:1px solid black">
            <div class="col"><b>Nome</b> </div>  
            <div class="col"><b>Cognome</b> </div>  
            <div class="col"><b>Codice Fiscale</b> </div>  
            <div class="col"> </div>  
        </div>
        <div  class="row" v-for="(item ,index) in elencoAnagraficaProgettisti" :key="item.message" >
        <div class="col"> {{ item.nome }}</div>
        <div class="col"> {{ item.cognome }}</div>
        <div class="col"> {{ item.codiceFiscale }}</div>
          <div class=""> 
                <q-btn   size="sm" round icon="delete" @click="elencoAnagraficaProgettisti.splice(index, 1)" />
              </div>
   </div>


            </div>




    </div><!--Anagrafica intervento -->
<!-- #endregion -->


<!-- #region  ******SCREENING********-->
<div v-if="tab=='screening'" style="color:grey">

  <div v-if="tipologiaEdificio == 'edificioFamiliare'" class="bgmargintop">
  <div class="row " >
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
  <div v-if="tipologiaEdificio == 'condominio'" class="bgmargintop">

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
      <q-radio v-model="screeningCondominioUsufruito110" val="SI" label="SI" />
      <q-radio v-model="screeningCondominioUsufruito110" val="NO" label="NO" />
      
      </div>
  </div>

</div>



  <div class="row">
      <div class="col">
         <b style="color:red">Riportare di seguito la % per ciascuna categoria catastale DA RIVEDERE</b>
        
      </div>
    </div>

      <!-- Titolo autorizzativi-->

 <div class=" bgmargintop q-pa-md q-gutter-sm row" >
   <div class="col-12"><span class="text-h6 text-secondary">Titoli autorizzativi</span></div>
   
    <div class="col-12">
      <b>Tipologia Titolo</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
        Riportare il titolo con il quale è stato edificato l’edificio
          </q-tooltip>
      </q-icon> <q-input v-model="tipologiaTitoloAutorizzativi" type="text" outlined :dense="true"  />
    </div>
    <div class="col-3">
      <label for="">Riferimenti</label>
      <q-input v-model="riferimentiAutorizzativi" type="text" outlined :dense="true"  />
 </div>
 <div class="col-3">
      <label>Data</label>
     <q-input  outlined :dense="true"  v-model="dateAutorizzativi" mask="date" :rules="['date']">
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
    <div class="col-3">
      <label>Allegato</label><br>
      <input  type="file" @change="handleFileTitoliAutorizzativi">
      <a href="#"  v-if="!nuovoProgetto" @click="downloadFile(idprogetto+'/'+AllegatoTitoloAutorizzativo,AllegatoTitoloAutorizzativo)" >{{AllegatoTitoloAutorizzativo}}</a>
      <!--<q-file v-model="AllegatoTitoloAutorizzativo" label="Carica file"  :dense="true" outlined multiple style="max-width: 300px"    />-->
  </div>
  
<div class="col-12">
 <div class="row q-gutter-sm ">
    <div class="col-12 col-md-12">
      <b>Successivi interventi di manutenzione straordinaria 
(con SCIA, CILA, ecc..)</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
     Riportare eventuali interventi successivi relativi all’edificio nel suo complesso
          </q-tooltip>
      </q-icon>
    </div>
    <div class="col-3">
      <label for="">Anno di intervento</label>
      <q-input v-model="annoIntervento" outlined :dense="true" type="number" maxlength="4"/>
    </div>

    <div class="col-3"> 
      <label for="">Allegato</label><br>
      <input type="file" @change="handleFile" >
    <!--  <q-file  v-model="allegatoIntervento"  label="Carica filedddd"  outlined :dense="true"     style="max-width: 300px"  />-->
    </div>
      
    
    <div class="col-3"> 
      <q-btn icon="add"  color="primary" @click="addrowInterventiManutenzioneSuccessivi(); " outline :dense="true" />
    </div>
   
  </div>
   <div class="row" style="background-color:white">
    <div class="col"><b>Anno di intervento</b></div>
    <div class="col"><b>Allegato</b></div>
    
    <div class="col-1 col-md-1 "></div>
    
    </div>

<!--  --> 
    <div   v-for="(item,index) in elencoInterventiManutenzioneStraordinariaSCIACILAltro" :key="item.message"  style="border-bottom:1px solid black background-color:white; ">
    <div class="row" v-if="item.cancellare != '1'">
    <div class="col"> {{ item.anno }}</div>
    <div class="col"><span  @click="downloadFile(idprogetto+'/'+item.allegato, item.allegato)" style=" cursor: pointer; text-decoration:underline"> {{ item.allegato }}</span></div>
 
    <div class="col-1 col-md-1 "> 
    <q-btn v-if="nuovoProgetto"  size="sm" round icon="delete" @click="elencoInterventiManutenzioneStraordinariaSCIACILAltro.splice(index, 1)" />
    <q-btn v-if="!nuovoProgetto"  size="sm" round icon="delete" @click="elencoInterventiManutenzioneStraordinariaSCIACILAltro[index].cancellare='1'" />

  </div>
  </div>
  </div>

</div>
</div>



<div class="row"><hr></div>
<!-- ALLEGATI INTERVENTI SUCCESSIVI ALLA COSTRUZIONE -->
<div  style="background-color:white">
  <div class="row " >
    <div class="col-6"><label for=""><b>Titoli autorizzativi relativi ad interventi successivi alla costruzione – area allegato -</b></label></div>
    <div class="col-2">
      </div>

  </div>
  <div class="row  q-gutter-sm" style="background-color:white">
    <div class="col"><b><q-input v-model="modalInterventiSuccessiviNuovoSub" :dense="true"  type="text" label="Sub" /></b></div>
    <div class="col"><b><q-input v-model="modalInterventiSuccessiviNuovaDecrizione" :dense="true"  type="text" label="Successivi interventi" /></b></div>
    <div class="col">
      <label>Allegato</label><br>
      <input type="file" @change="handleFile">
   <!--   <q-file
      v-model="modalInterventiSuccessiviNuovoAllegato"
      label="Carica file"
      :dense="true"
      filled
      style="max-width: 300px" />
      -->
      </div>
    <div class="col">
       <q-btn icon="add" color="primary" @click="addrowInterventiSuccessivi(); " outline :dense="true" />
    </div>
    
    </div>
  <div class="row" style="background-color:white">
    <div class="col"><b>Sub</b></div>
    <div class="col"><b>Successivi interventi</b></div>
    <div class="col"><b>Allegato</b></div>
    <div class="col-1 col-md-1 "></div>
    
    </div>
  


 <div v-for="(item,index) in elencoTitoliAutorizzatiInterventiSuccessivi" :key="item.message" style="border-bottom:1px solid black background-color:white; ">
   <div  class="row"  v-if="item.cancellare == '0'">

    <div class="col"> {{ item.sub }}</div>
    <div class="col"> {{ item.descrizione }}</div>
    <div class="col"><span  @click="downloadFile(idprogetto+'/'+item.allegato, item.allegato)" style=" cursor: pointer; text-decoration:underline"> {{ item.nomeAllegato }}</span></div>
    <div class="col-1 col-md-1 "> 
    <q-btn v-if="nuovoProgetto"  size="sm" round icon="delete" @click="elencoTitoliAutorizzatiInterventiSuccessivi.splice(index, 1)" />
    <q-btn v-if="!nuovoProgetto"  size="sm" round icon="delete" @click="elencoTitoliAutorizzatiInterventiSuccessivi[index].cancellare='1'" />
   
</div>
  </div>
  </div>
</div>
<div  style="background-color:white">
<!-- DATI CATASTALI -->
  <div class="row " style="padding-top:10px" >
    <div class="col-12"><label for="" class="text-h6">
      <b>Dati catastali</b></label>  </div>
   
  </div>
 
   
  <div class="row">
    <div class="col"><b>foglio</b></div>
    <div class="col"><b>Particella</b></div>
    <div class="col"><b>Sub</b></div>
    <div class="col"></div>

    </div>
      <div class="row  q-gutter-sm" style="background-color:white; border-bottom:1px solid black">
    <div class="col"><b><q-input v-model="modalDatiCatastaliTitoliAutorizzativiNuovoFoglio" :dense="true" outlined  type="text" /></b></div>
    <div class="col"><b><q-input v-model="modalDatiCatastaliTitoliAutorizzativiNuovoParticella" :dense="true" outlined  type="text"  /></b></div>
    <div class="col"><b><q-input v-model="modalDatiCatastaliTitoliAutorizzativiNuovoSub" :dense="true" outlined  type="text" /></b></div>

    <div class="col"> <q-btn icon="add"  color="primary" @click="addrowDatiCatastaliTitoliAutorizzativi(); " outline :dense="true" /></div>
    
    </div>
 <div  class="row  q-gutter-sm" v-for="(item,index) in elencoTitoliAutorizzatiDatiCatastali" :key="item.message" >
    <div class="col"> {{ item.foglio }}</div>
    <div class="col"> {{ item.particella }}</div>
    <div class="col"> {{ item.sub }}</div>
   <div class="col-1 col-md-1 "> 
    <q-btn   size="sm" round icon="delete" @click="elencoTitoliAutorizzatiDatiCatastali.splice(index, 1)" />
  
  </div>

  </div>
  </div>

<div class="bgmargintop">
  <div class="row "  style="padding-top:10px" >
    <div class="col-12">
      <strong class="text-h6  text-secondary" >Verifica di conformità</strong>
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
</div>


 </div><!-- DIV TAB Screening -->
<!-- #endregion -->
 

 <!-- #region Dati Strutturati-->
<div v-if="tab == 'datiStrutturali' ">

<div class="bgmargintop">
  <div class="row"><div class="col-12"><span class="text-h6 text-secondary">Dati strutturali</span></div></div>
  <div class="row">
    <div class="col-12">
    <strong>Tipologia struttura edificio:</strong>
    </div>
  
    <div class="col-3"><q-checkbox right-label v-model="datistrutturalichk" val="EdificioinMuraturaPortante" label="Edificio in Muratura Portante" /></div>
    <div class="col-3"><q-checkbox right-label v-model="datistrutturalichk" val="EdificioTelaioCAinopera" label="Edificio con telaio in C.A. in opera" /></div>
    <div class="col-3"><q-checkbox right-label v-model="datistrutturalichk" val="EdificioElementiPrefabbricati" label="Edificio con elementi prefabbricati" /></div>
    <div class="col-3"><q-checkbox right-label v-model="datistrutturalichk" val="altro" label="Altro" /></div>


  </div>
  <div class="row" v-if="datistrutturalichk.includes('altro')">
    <div class="col">
      <q-input v-model="altroDatiStrutturali" type="text" :dense="true" outlined label="Altro" />
      </div>
    </div>
 
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
  <div class="row" v-if="tipologiaParetechk.includes('altro')">
    <div class="col">
      <q-input v-model="altroTipologiaParetechk" type="text" :dense="true" outlined label="Altro" /></div></div>

 <div class="row">
    <div class="col-12">
    <strong>Tipologia FOTO COSA FARE:</strong>
    </div>
   
    <div class="col-3"><q-checkbox right-label v-model="tipologia_doppia_parete" val="presenzaIntercapedite" label="Presenza intercapedine/camera d’aria" /></div>
    <div class="col-3"><q-checkbox right-label v-model="tipologia_doppia_parete" val="IsolamentoInCameraDaria" label="Isolante in camera d’aria (sughero, EPS, ecc…)" /></div>
    <div class="col-3"><q-checkbox right-label v-model="tipologia_doppia_parete" val="idoneoInsuffiaggio" label=" Idoneo a insufflaggio" /></div>
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
  <div class="row" v-if="isolamentoEsistentechk.includes('altro')">
    <div class="col">
      <q-input v-model="altroisolamentoEsistentechk" type="text" :dense="true" outlined label="Altro" />
      </div>
    </div>
</div>

<div class="bgmargintop">
<div class="row" style="padding-top:20px"><div class="col"><span class="text-h6 text-secondary">Dati Centrale Termina</span></div></div>

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
    <label for="" class="text-bold">Disponibilità Certificato Prevenzione Incendi (CPI) aggiornato</label><br>
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
  <div class="col-1 col-md-1 ">  </div>
  </div>

 <div  class="row" v-for="(item,index) in elencoImpiantoAutonomoEsistente" :key="item.message" style="border-bottom:1px solid black">
     <div class="col"> {{ item.sub }}</div>
     <div class="col"> {{ item.tecnologiaImpianto }}</div>
     <div class="col"> {{ item.numeronUnitaGenerazione }}</div>
     <div class="col"> {{ item.tipologiaSistemaTermoregolazione }}</div>
     <div class="col"> {{ item.potenzaTermicaUtile }}</div>
     <div class="col"> {{ item.annoInstallazione }}</div>
     <div class="col"> {{ item.GeneratoreOggettoDiSostituzione }}</div>
    <div class="col-1 col-md-1 "> 
    <q-btn   size="sm" round icon="delete" @click="elencoImpiantoAutonomoEsistente.splice(index, 1)" />
  
  </div>
  </div>
    <div class="row"><div class="col"><span class="text-bold text-h5">Stato di Progetto</span></div></div>
    <div class="row"><div class="col">
      <q-btn  class="white" icon="add" label="Aggiungi" @click="modalAggiungiImpiantoEsistenteAutonomoStatoProgetto=true" /><!--TODO CAMBIARE CLICK BOTTONE MODAL -->
      
      </div></div>
<div class="row" style="border-bottom:1px solid black">
  <div class="col">Sub</div>
  <div class="col">Tecnologia impianto</div>
  <div class="col">N. unità di generazione</div>
  <div class="col">Tipologia sistema di termoregolazione</div>
  <div class="col">Potenza termica utile [kW]</div>
  <div class="col">Anno installazione</div>
  <div class="col">Generatore oggetto di sostituzione?</div>
  <div class="col-1 col-md-1 "></div>
  </div>

 <div  class="row" v-for="(item,index) in elencoImpiantoAutonomoEsistenteStatoDiProgetto" :key="item.message" style="border-bottom:1px solid black">
     <div class="col"> {{ item.sub }}</div>
     <div class="col"> {{ item.tecnologiaImpianto }}</div>
     <div class="col"> {{ item.numeronUnitaGenerazione }}</div>
     <div class="col"> {{ item.tipologiaSistemaTermoregolazione }}</div>
     <div class="col"> {{ item.potenzaTermicaUtile }}</div>
     <div class="col"> {{ item.annoInstallazione }}</div>
     <div class="col"> {{ item.GeneratoreOggettoDiSostituzione }}</div>
    <div class="col-1 col-md-1 "> 
    <q-btn   size="sm" round icon="delete" @click="elencoImpiantoAutonomoEsistenteStatoDiProgetto.splice(index, 1)" />
  
  </div>
  </div>

  </div>
</div>
</div>
<!-- #endregion -->

<div v-if="tab == 'allegati'">

<span class="text-h5">Allegati</span>

  
<div class="row">
  <div class="col-3">
     <label class="text-bold"> Allegato</label><br>
     <input type="file" @change="handleFile"  >
  <!--<q-file v-model="allegatoDiAllegati"   label="Carica file"  outlined :dense="true"   style="max-width: 300px" /> -->
  </div>
  <div class="col-6">  
    <label class="text-bold"> Tipo Allegato</label>
    <q-select v-model="tipoAllegatodiAllegati" :options="tipiDiAllegati" :dense="true" outlined label="Seleziona..."  />
    <q-input v-if="tipoAllegatodiAllegati.value =='altro'" v-model="tipoAltroAllegato" type="text" label="Altro tipo allegato" :dense=true />
  </div>
   <div class="col-12"> 
    <label for="" class="text-bold"> Note</label>
    <q-input v-model="noteallegatoDiallegati" outlined :dense="true" type="text"  />  
  </div>
  <div class="col-12" style="margin-top:10px;"><q-btn class="white" icon="add" label="Aggiungi" @click="addrowAllegati()" /></div>
   
     </div>
<div class="row" style="margin-top:20px"> 
  <div class="col">File</div>
  <div class="col">Note</div>
  <div class="col">Tipo Documento</div>
  <div class="col"></div>
  
</div>
<div  v-for="(allegato,index) in elencoAllegati" :key="allegato.nomeFile">
 <div class="row" v-if="allegato.cancellare=='0'">
  <div class="col">
    <span v-if="allegato.idprogetto != '0'"  @click="downloadFile(idprogetto+'/'+allegato.nomeFile, allegato.nomeFile)" style=" cursor: pointer; text-decoration:underline">{{allegato.nomeFile}}</span>
    <span v-if="allegato.idprogetto == '0'" >{{allegato.nomeFile}}</span>
     </div>
  <div class="col">{{allegato.noteFile}}</div>
  <div class="col">{{allegato.tipoAllegato}}</div>
  <div class="col"> <q-btn   size="sm" round icon="delete" @click="elencoAllegati[index].cancellare='1'" />
  </div>
  </div>

</div>

</div>


<div v-if="tab == 'quote'">


<div class="row  q-gutter-sm bgAree"><div class="col-8 col-md-3">
  <label for="" class="font-weigth:bold">Quota Preventivo €</label>
  <q-input v-model="quotaPreventivo" :dense="true" outlined type="number" /></div>

  <div class="col-2 col-md-2"> 
    <label for="" class="text-bold"> Allega Preventivo Firmato</label>
    <input type="file" @change="handleFilePreventivo">
      <a href="#"  v-if="!nuovoProgetto" @click="downloadFile(idprogetto+'/'+quoteAllegatoPreventivo,quoteAllegatoPreventivo)" >{{quoteAllegatoPreventivo}}</a>
   
  <!--  <q-file
      v-model="quoteAllegatoPreventivo"
      label="Carica file"
      outlined
      :dense="true"
      style="max-width: 300px" /> -->
      </div>
  </div>

  <div class="bgAree" style="margin-top:20px" >
<div class="row">
  <div class="col">
    <span class="text-h6 text-secondary">Acconti Ricevuti</span>
  </div>
</div>
  
  <div class="row  q-gutter-sm " style="padding-top:20px">
    <div class="col-6 col-md-2 ">
      <label class="text-bold">Data</label>
     <q-input  outlined :dense="true"  v-model="dataAcconto" mask="date" :rules="['date']">
      <template v-slot:append>
        <q-icon name="event" class="cursor-pointer">
          <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
            <q-date v-model="dataAcconto">
              <div class="row items-center justify-end">
                <q-btn v-close-popup label="Close" color="primary" flat />
              </div>
            </q-date>
          </q-popup-proxy>
        </q-icon>
      </template>
    </q-input>
    </div>
    <div class="col-6 col-md-2 ">
      <label for="" class="text-bold">Importo</label>
      <q-input v-model="quotaImportoAcconto" outlined :dense="true"  type="number" />
      </div>
   
    <div class="col-6 col-md-2 ">
      <label for="" class="text-bold">Modalità di pagamento</label>
    
      <q-select v-model="quotaAccontoModalitaPagamento" :options="elencoMetodoPagamenti" outlined :dense="true" /></div>
    <div class="col-6 col-md-3 ">
      <label for="" class="text-bold">Chi ha fatturato</label>
      <q-input v-model="quoteChiFattura" type="text" outlined :dense="true"  />
    </div>
    
    <div class="col-6 col-md-2">
      <q-btn icon="add" style="margin-top:25px"  color="primary" @click="addrowQuoteAcconti(); " outline :dense="true" />
    </div>
   
    
    </div>

<div class="row bgAree">
  <div class="col text-bold">Quota</div>
  <div class="col text-bold">Importo</div>
  <div class="col text-bold">Metodo di Pagamento</div>
  <div class="col text-bold">Chi Fatturato</div>
   <div class="col text-bold"></div>
  </div>
<div class="row bgAree"  v-for="(quota,index) in elencoQuote" :key="quota.quota">
 <div class="col">{{quota.dataPagamento}}</div>
  <div class="col"> {{quota.importo}}</div>
   <div class="col">{{quota.metodoPagamento}}</div>
  <div class="col">{{quota.chiFatturato}}</div>
  <div class="col"> 
    <q-btn   size="sm" round icon="delete" @click="elencoQuote.splice(index, 1)" />
  
  </div>
 

</div>
</div>


  <div class="bgAree" style="margin-top:20px" >
<div class="row">
  <div class="col">
    <span class="text-h6 text-secondary">Spese Effettuate</span>
  </div>
</div>
  
  <div class="row  q-gutter-sm " style="padding-top:20px">

    <div class="col-6 col-md-2 ">
      <label class="text-bold">Data</label>
     <q-input  outlined :dense="true"  v-model="dataSpesaEffettuata" mask="date" :rules="['date']">
      <template v-slot:append>
        <q-icon name="event" class="cursor-pointer">
          <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
            <q-date v-model="dataSpesaEffettuata">
              <div class="row items-center justify-end">
                <q-btn v-close-popup label="Close" color="primary" flat />
              </div>
            </q-date>
          </q-popup-proxy>
        </q-icon>
      </template>
    </q-input>
    </div>

    <div class="col-6 col-md-2 ">
      <label for="" class="text-bold">Importo</label>
      <q-input v-model="importoSpesaEffettuata" outlined :dense="true"  type="number" />
      </div>
   
    <div class="col-6 col-md-2 ">
      <label for="" class="text-bold">Causale</label>
      <q-input v-model="causaleSpesaEffettuata" outlined :dense="true"  type="text" />
 </div>
     <div class="col-6 col-md-3 ">
      <label for="" class="text-bold">Chi ha Pagato</label>
      <q-input v-model="chiHafattoSpesa" type="text" outlined :dense="true"  />
    </div>
    
    <div class="col-6 col-md-2">
      <q-btn icon="add" style="margin-top:25px"  color="primary" @click="addrowQuoteSpese(); " outline :dense="true" />
    </div>
   
    
    </div>

<div class="row bgAree">
  <div class="col text-bold">Quota</div>
  <div class="col text-bold">Importo</div>
  <div class="col text-bold">Causale</div>
  <div class="col text-bold">Chi ha pagato</div>
  <div class="col text-bold"></div>
  </div>
<div class="row bgAree" v-for="(quota,index) in elencoSpese" :key="quota.dataPagamento" >
 <div class="col">{{quota.dataPagamento}}</div>
  <div class="col"> {{quota.importo}}</div>
   <div class="col">{{quota.causale}}</div>
  <div class="col">{{quota.chiHapagato}}</div>
  <div class="col"> 
    <q-btn   size="sm" round icon="delete" @click="elencoSpese.splice(index, 1)" />
  
  </div>


</div>


</div>

<q-btn color="primary" v-if="nuovoProgetto" icon="check" label="Crea progetto" @click="aggiungiProgetto()" />
<q-btn color="positive" v-if="!nuovoProgetto" icon="check" label="Aggiorna progetto" @click="aggiungiProgetto()" />
</div>

<!-- #region MODAL-->
<!-- MODAL -->
 <q-dialog v-model="modalNuovaAnagraficaClienti" persistent>
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
          <q-input v-model="NuovoProprietarioImmobileNome" type="text" label="Nome" />
          <q-input v-model="NuovoProprietarioImmobileCognome" type="text" label="Cognome" />
          <q-input v-model="NuovoProprietarioImmobileCodiceFiscale" type="text" label="Codice Fiscale" />
          <q-input v-model="NuovoProprietarioImmobileTelefono" type="text" label="Telefono" />
     
         </q-card-section>

        <q-card-actions align="right">
          <q-btn  label="Chiudi" color="secondary" v-close-popup />
          <q-btn  label="Aggiungi" color="primary" v-close-popup />
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


<q-dialog v-model="modalAggiungiImpiantoEsistenteAutonomo" persistent>
  <q-card>
    <q-card-section class="row items-center">
     
      <span class="q-ml-md">Aggiungi</span>
    </q-card-section>
    <q-card-section class="row items-center">
    
      <span class="q-ml-md">
          
        <q-input v-model="NuovoImpiantoEsistenteAutonomosub" type="text" label="sub" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomotecnologiaImpianto" type="text" label="Tecnologia impianto" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione" type="number" label="N. unità di generazione" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione" type="text" label="Tipologia sistema di termoregolazione" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile" type="number" label="Potenza termica utile [kW]" />
        <q-input v-model="NuovoImpiantoEsistenteAutonomoannoInstallazione" type="number" label="Anno installazione" />
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
<q-dialog v-model="modalAggiungiImpiantoEsistenteAutonomoStatoProgetto" persistent>
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
      <q-btn flat label="Conferma" color="primary" @click="addrowImpiantoAutonomoEsistenteStatoProgetto();"/>
    </q-card-actions>
  </q-card>
</q-dialog>


<q-dialog persistent  v-model="visualizzamessaggio">
        <q-card>
  <q-card-section class="row items-center">
      {{messaggioDaVisualizzare}}
  </q-card-section>
  <q-card-actions align="right">
      <q-btn flat label="ok" color="primary" v-close-popup @click="redirectlistaprogetti()" />
    
    </q-card-actions>
        </q-card>
    </q-dialog>


<!-- FINE  MODAL -->
<!-- #endregion -->
  </div> <!-- quello iniziale con TAB -->

</template>
<style scoped>
.bgmargintop{
  background-color: white; margin-top:20px;
}
.bgAree{
  background-color: white;padding:5px
}
.paddingInput{padding:10px;}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9;
  
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important;
  color: #ffffff;
}
</style>
<script>

</script>
<script>
import formNuovaanagrafica from '@/components/NuovaAnagrafica'
import message from '@/components/messaggio'
import Axios from 'axios';
import nuovoProgettoVue from '../views/nuovo-progetto.vue';
export default {

    methods: {
      downloadFile(path,titoloFile){
        Axios({
          url: 'http://localhost:8000/download/?pp='+path,
          method:'get',
          responseType: 'arraybuffer',
          }).then(response=>{
            console.log(response);
            if(response.data.byteLength >2){
            
            const url = window.URL.createObjectURL(new Blob([response.data]))
            const link = document.createElement('a')
            link.href = url
            link.setAttribute('download',titoloFile)
            document.body.appendChild(link)
            link.click()}
            else{
              alert('Errore file non esistente');

            }
            });
        },
      aggiungiProgetto(){
      const  sendForm={
        idprogetto:this.idprogetto,
          titoloProgetto:this.titoloProgetto,
         tipologiaEdificio:this.tipologiaEdificio,
         zonaClimatica:this.zonaClimatica,
         gradigiornoText:this.gradigiornoText ,
          areavincolata42:this.areavincolata42 ,
          tipoVincolo42:this.areaVicnolata42TipoVincolo,
          zonasismisca4:this.zonasismisca4 ,
          zonasismisca4Interventiantisismici:this.zonasismisca4Interventiantisismici ,
          zonasismisca4InterventiantisismiciAltriVincoli:this.zonasismisca4InterventiantisismiciAltriVincoli ,
          TipoInterventoProposto:this.TipoInterventoProposto ,
          TipologiainterventoDPR3802001:this.TipologiainterventoDPR3802001 ,

          tipologiaTitoloAutorizzativi:this.tipologiaTitoloAutorizzativi ,
          riferimentiAutorizzativi:this.riferimentiAutorizzativi,
          dateAutorizzativi:this.dateAutorizzativi,
          AllegatoTitoloAutorizzativo:this.AllegatoTitoloAutorizzativo,
          Base64AllegatoTitoloAutorizzativo:this.Base64AllegatoTitoloAutorizzativo,

          abusiEdilizi:this.abusiEdilizi,
          TipologiaAbusiEdilizi:this.TipologiaAbusiEdilizi,
          comuneStatoDiFatto:this.comuneStatoDiFatto,
          NCEUStatoDiFatto:this.NCEUStatoDiFatto,
          difformitaUrbanistiche:this.difformitaUrbanistiche,
          noteDifformitaUrbanistiche:this.noteDifformitaUrbanistiche,
          difformitaCatastali:this.difformitaCatastali,
          noteDifformitaCatastali:this.noteDifformitaCatastali,
          irregolaritaSanabili:this.irregolaritaSanabili,
          noteIrregolaritaSanabili:this.noteIrregolaritaSanabili,

          datistrutturalichk:this.datistrutturalichk,
          altroDatiStrutturali:this.altroDatiStrutturali,

          tipologiaParetechk:this.tipologiaParetechk,
          altroTipologiaParetechk:this.altroTipologiaParetechk,

          tipologia_doppia_parete:this.tipologia_doppia_parete,
          SpessoreMuriEsterni:this.SpessoreMuriEsterni,
          SpessoreCameraDaria:this.SpessoreCameraDaria,
          SpessoreIsolamento:this.SpessoreIsolamento,
          TipologiaIsolamentoIncameraDaria:this.TipologiaIsolamentoIncameraDaria,
          isolamentoEsistentechk:this.isolamentoEsistentechk,
          altroisolamentoEsistentechk:this.altroisolamentoEsistentechk,

          tipologiaImpiantoEsistente:this.tipologiaImpiantoEsistente,
          cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente:this.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente,
          cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro:this.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro,
          cetraleTermicaCentralizzatoNumeroUnita:this.cetraleTermicaCentralizzatoNumeroUnita,
          cetraleTermicaCentralizzatoAnnoInstallazione:this.cetraleTermicaCentralizzatoAnnoInstallazione ,
          cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente:this.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente ,
          cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste:this.cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste ,
          cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente:this.cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente,
          cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato:this.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato ,
          cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato:this.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato ,
          cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate:this.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate ,
          cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato:this.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato ,
          cetraleTermicaCentralizzatoCertificatoCPI:this.cetraleTermicaCentralizzatoCertificatoCPI ,
          cetraleTermicaCentralizzatoCertificatoCPIAllegato:this.cetraleTermicaCentralizzatoCertificatoCPIAllegato ,
          cetraleTermicaCentralizzatoTecnologiaImpiantoProposto:this.cetraleTermicaCentralizzatoTecnologiaImpiantoProposto ,
          cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro:this.cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro ,
          cetraleTermicaCentralizzatoNumeroUnitaProposte:this.cetraleTermicaCentralizzatoNumeroUnitaProposte ,
          cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto:this.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto ,
          centraleTermivaCentralizzatoVettoreImpianto:this.centraleTermivaCentralizzatoVettoreImpianto ,
          quotaPreventivo:this.quotaPreventivo,

          quoteAllegatoPreventivo:this.nameAuxFilePreventivo,
          base64AllegatoPreventivo:this.quoteAllegatoPreventivo,
          elencoAcconti:this.elencoQuote,
          elencoSpese:this.elencoSpese,

          clienti:this.elencoAnagraficaClienti,
          collaboratoriInterni:this.elencoCollaboratoriInterno,
          collaboratoriEsterni:this.elencoCollaboratoriEnterno,
          progettisti:this.elencoAnagraficaProgettisti,
          successiviInterventiStraordinaria:this.elencoInterventiManutenzioneStraordinariaSCIACILAltro,
          TitoliAutorizzatiInterventiSuccessivi:this.elencoTitoliAutorizzatiInterventiSuccessivi,
          datiCatastali:this.elencoTitoliAutorizzatiDatiCatastali,
          centraleTermicaDiFAtto:this.elencoImpiantoAutonomoEsistente,
          centraleTermicaDiProgetto:this.elencoImpiantoAutonomoEsistenteStatoDiProgetto,
          
          tipoEdificioEF:this.edificioUnifamiliareTipo,
          propietariImmobiliEF:this.elencoProprietariImmobile,
          indirizzoEF:this.edificioUnifamiliareIndirizzo,
          cittaEF:this.edificioUnifamiliarecitta,
          provinciaEF:this.edificioUnifamiliareProvincia,
          annoCostruzioneEF:this.edificioUnifamiliareAnnocostruzione,
          indipendenteEF:this.screeningUnifamiliareIndipendente,
          accessoAutonomiEF:this.screeningUnifamiliareIAcessoAutonomo,
          usufruito110EF:this.screeningUnifamiliareUsufruito110,
          riqualificazioneBalconiEF:this.screeningUnifamiliareRiqualificazioneBalconi,

          nomeCondominioCD:this.condominioNome,
          indirizzoCD:this.condominioIndirizzo,
          cittaCD:this.condominioCitta,
          provinciaCD:this.condominioProvincia,
          annoCostruzioneCD:this.condominioAnnodicotruzione,
          pianoImmobileCD:this.condominioPianoimmboile,
          numeroUnitaAccatastateCD:this.condominioNumeroUnitaAccatastate,
          numeroUnitaScaldateCD:this.condominioNumerounitariscaldate,
          numeroPertinnzeAccatastateCD:this.condominioPertinenzaC2C6C7,
          condominioFormalmenteCostituitoCD:this.condominioformalmenteCostituito,
          condominioUnicoProprietarioCD:this.screeningCondominioUnicoProprietario,
          IRESCD:this.screeningCondominioSoggettiIRES,
          mutliProprietaCD:this.screeningCondominioPossiedonoMultiProprieta,
          condominioA1A8A9CD:this.screeningCondominioA1A8A9,
          usufruito110CD:this.screeningCondominioUsufruito110,
          cd_codicefiscale_condominio:this.condominioFormalmenteCostituitoCodiceFsicale,
          cd_info_condominiocostituito:this.condominioFormalmenteCostituitoRiferimentoAmministatore,

          elencoFile:this.elencoAllegati,


          };
          if (this.nuovoProgetto){
               Axios.post(this.linkApi+"/aggiungi-progetto",sendForm).then(Response=>{
            
            console.log(Response.data)
            if(Response.data.response=='ok'){
              this.messaggioDaVisualizzare='Progetto Caricato con successo';
              this.visualizzamessaggio=true;
            
              }else{
                 this.messaggioDaVisualizzare=Response.data.message;
              this.visualizzamessaggio=true;
              }
            });
          }
          if (!this.nuovoProgetto){
               Axios.post(this.linkApi+"/aggiorna-progetto/",sendForm).then(Response=>{
            
            console.log(Response.data)
            if(Response.data.response=='ok'){
              this.messaggioDaVisualizzare='Progetto Aggiornato con successo';
              this.visualizzamessaggio=true;
            
              }else{
                 this.messaggioDaVisualizzare=Response.data.message;
              this.visualizzamessaggio=true;
              }
            });
          }
       

      },
    addRow(){
       this.elencoAnagraficaClienti.push(
         {nome:this.modalNuovoNome,
          cognome:this.modalNuovoCognome,
           codiceFiscale:this.modalNuovoCodiceFiscale});
      this.modalNuovaAnagraficaClienti= false;
    },
    redirectlistaprogetti(){
this.$router.push({ path:'lista-progetti'});
    },
    addRowProprietariImmobile(){
       this.elencoProprietariImmobile.push(
         {nome:this.NuovoProprietarioImmobileNome, 
         cognome:this.NuovoProprietarioImmobileCognome,
        codiceFiscale:this.NuovoProprietarioImmobileCodiceFiscale,
        telefono:this.NuovoProprietarioImmobileTelefono,
          });
    
    },
    handleFilePreventivo(e){
      this.nameAuxFilePreventivo=e.target.files[0].name;
      const selectImage= e.target.files[0];
      this.createBase64(selectImage);

    },
    handleFileTitoliAutorizzativi(e){
      this.AllegatoTitoloAutorizzativo=e.target.files[0].name;
      const selectImage= e.target.files[0];
      this.createBase64TitoliAutorizzativi(selectImage);

    },
     createBase64TitoliAutorizzativi(fileObject){
      const reader = new FileReader();
      reader.onload = (e)=>{
       var aux= e.target.result;
       var base64string = window.btoa(aux);
       this.Base64AllegatoTitoloAutorizzativo=base64string;
      };
      this.Base64AllegatoTitoloAutorizzativo= reader.readAsBinaryString(fileObject);

//return output;
    },
      createBase64Preventivo(fileObject){
      const reader = new FileReader();
      reader.onload = (e)=>{
       var aux= e.target.result;
       var base64string = window.btoa(aux);
       this.quoteAllegatoPreventivo=base64string;
      };
      this.quoteAllegatoPreventivo= reader.readAsBinaryString(fileObject);

//return output;
    },
    handleFile(e){
      this.nameAuxFile=e.target.files[0].name;
      const selectImage= e.target.files[0];
      this.createBase64(selectImage);

    },
  
     
    createBase64(fileObject){
      const reader = new FileReader();
      reader.onload = (e)=>{
       var aux= e.target.result;
       var base64string = window.btoa(aux);
       this.auxFile=base64string;
      };
      this.auxFile= reader.readAsBinaryString(fileObject);

//return output;
    },
     
    addrowInterventiManutenzioneSuccessivi(){
  
      this.elencoInterventiManutenzioneStraordinariaSCIACILAltro.push(
        {
          anno:this.annoIntervento,
          allegato:this.nameAuxFile,
          allegatoBase64:this.auxFile,
          new:1,
          cancellare:0

        });

        },
    addrowInterventiSuccessivi(){
      this.elencoTitoliAutorizzatiInterventiSuccessivi.push(
        {
          sub:this.modalInterventiSuccessiviNuovoSub,
          descrizione:this.modalInterventiSuccessiviNuovaDecrizione,
          nomeAllegato:this.nameAuxFile,
          allegatoBase64:this.auxFile,
          new:1,
          cancellare:0,
        });

      this.modalAggiungiAllegatiInterventiSuccessiviAllaCostruzione= false;
    },
    addrowDatiCatastaliTitoliAutorizzativi(){
      this.elencoTitoliAutorizzatiDatiCatastali.push(
        {sub:this.modalDatiCatastaliTitoliAutorizzativiNuovoSub,
         particella:this.modalDatiCatastaliTitoliAutorizzativiNuovoParticella,
         foglio:this.modalDatiCatastaliTitoliAutorizzativiNuovoFoglio});
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
    addrowImpiantoAutonomoEsistenteStatoProgetto(){
      this.elencoImpiantoAutonomoEsistenteStatoDiProgetto.push(
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
this.NuovoImpiantoEsistenteAutonomosub='';
           this.NuovoImpiantoEsistenteAutonomotecnologiaImpianto='';
           this.NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione='';
           this.NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione='';
           this.NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile='';
            this.NuovoImpiantoEsistenteAutonomoannoInstallazione='';
           this.NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione='';
           
      this.modalAggiungiImpiantoEsistenteAutonomoStatoProgetto= false;
      
    },
  /*  addrowImpiantoAutonomoProposto(){
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
        
      this.modalAggiungiImpiantoEsistenteAutonomoStatoProgetto= false;
    },*/
    addrowQuoteAcconti(){
      this.elencoQuote.push(
        {
          dataPagamento:this.dataAcconto,
          importo:this.quotaImportoAcconto,
          metodoPagamento:this.quotaAccontoModalitaPagamento.value,
          chiFatturato:this.quoteChiFattura,
          tipo_quota:'entrata'

        });
        },
    addrowQuoteSpese(){
      this.elencoSpese.push(
        {
          dataPagamento:this.dataSpesaEffettuata,
          importo:this.importoSpesaEffettuata,
          causale:this.causaleSpesaEffettuata,
          chiHapagato:this.chiHafattoSpesa,
          tipo_quota:'uscita'
        });
        },
    addrowAllegati(){
//TODO prevedere caricaemnto sul database diretto
this.elencoAllegati.push({
  nomeFile:this.nameAuxFile,
  fileBase64:this.auxFile,
  noteFile:this.noteallegatoDiallegati,
  tipoAllegato:this.tipoAllegatodiAllegati.value,
  idprogetto:0,
  new:1,
  cancellare:0,
  });

    },

    
    removeRow(index){
   this.elencoAnagraficaClienti.splice(index, 1)
    },
    elencoCercaAnagraficaClientiFunction(){
      if (this.cercaAnagraficaClienti.length > 1){
      Axios.get(this.linkApi+'/getCercaAnagrafica/cliente/'+this.cercaAnagraficaClienti).then(Response=>{console.log(Response.data);this.elencoCercaAnagraficaClienti= Response.data})
      }
      },
    elencoCercaCollaboratoreInternoFunction(){
      if (this.cercaCollaboratoriInterni.length>1){
      Axios.get(this.linkApi+'/getCercaAnagrafica/collaboratoreInterno/'+this.cercaCollaboratoriInterni).then(Response=>{console.log(Response.data);this.elencoCercaCollaboratoreInterno= Response.data})
      }
      },
    elencoCercaCollaboratoreEsternoFunction(){
      if (this.cercaCollaboratoriEsterni.length >1){
      Axios.get(this.linkApi+'/getCercaAnagrafica/collaboratoreEsterno/'+this.cercaCollaboratoriEsterni).then(Response=>{console.log(Response.data);this.elencoCercaCollaboratoreEsterno= Response.data})
    }},
    elencoCercaAnagraficaProgettistiFunction(){
      if (this.cercaProgettista.length >1){
      Axios.get(this.linkApi+'/getCercaAnagrafica/collaboratoreInterno/'+this.cercaProgettista).then(Response=>{console.log(Response.data);this.elencoCercaAnagraficaProgettisti= Response.data})
    }},
  aggiungiElencoClienti(datiUtente){
    this.elencoAnagraficaClienti.push({
        nome:datiUtente.nome,
       cognome:datiUtente.cognome,
       denominazione:datiUtente.denominazione,
       codiceFiscale:datiUtente.codice_fiscale,
       partitaIva:datiUtente.partita_iva,
       id:datiUtente.id,
      });
       this.cercaAnagraficaClienti='';
       this.elencoCercaAnagraficaClienti=null;
  },
  aggiungiElencoCollaboratoreInterno(datiUtente){
    this.elencoCollaboratoriInterno.push({
      nome:datiUtente.nome,
       cognome:datiUtente.cognome,
       denominazione:datiUtente.denominazione,
       codiceFiscale:datiUtente.codice_fiscale,
       partitaIva:datiUtente.partita_iva,
       id:datiUtente.id});
       this.cercaCollaboratoriInterni='';
       this.elencoCercaCollaboratoreInterno=null;
  },
  aggiungiElencoClientiCollaboratoreEsterno(datiUtente){
    this.elencoCollaboratoriEnterno.push({
      nome:datiUtente.nome,
       cognome:datiUtente.cognome,
       denominazione:datiUtente.denominazione,
       codiceFiscale:datiUtente.codice_fiscale,
       partitaIva:datiUtente.partita_iva,
       id:datiUtente.id});
       this.cercaCollaboratoriEsterni='';
       this.elencoCercaCollaboratoreEsterno=null;
  },
     
  aggiungiElencoProgettisti(datiUtente){
    this.elencoAnagraficaProgettisti.push({
      nome:datiUtente.nome,
       cognome:datiUtente.cognome,
       denominazione:datiUtente.denominazione,
       codiceFiscale:datiUtente.codice_fiscale,
       partitaIva:datiUtente.partita_iva,
       id:datiUtente.id});
       this.cercaProgettista='';
       this.elencoCercaAnagraficaProgettisti=null;
  }
    },
     
  data () {
    return {
      pathAllegatoTitoloAutorizzativo:'',
        text:'',data:'',date:'',auxFile:null,nameAuxFile:'',nameAuxFilePreventivo:'',
        nuovoProgetto:true,
        cercaAnagraficaClienti:'',cercaCollaboratoriInterni:'',cercaCollaboratoriEsterni:'',
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
        

         titoloProgetto:'',search:'',tipologiaEdificio:[],
         TipologiainterventoDPR3802001:[],
        /* TipologiainterventoDPR3802001Ordinaria:false,TipologiainterventoDPR3802001Straordinaria:false,TipologiainterventoDPR3802001RisanamentoConcervativo:false,TipologiainterventoDPR3802001RistrutturazioneEdilizia:false,TipologiainterventoDPR3802001NuovaCostruzione:false,TipologiainterventoDPR3802001InterventiUrbanistici:false,*/
         zonaClimatica:[],
        /* zonaclimaticaA:false,zonaclimaticaB:false,zonaclimaticaC:false,zonaclimaticaD:false,zonaclimaticaE:false,zonaclimaticaF:false,*/
         
         gradigiornoText:'',areavincolata42:'',
         areaVicnolata42TipoVincolo:'',zonasismisca4:'',zonasismisca4Interventiantisismici:'',zonasismisca4InterventiantisismiciAltriVincoli:'',edificioUnifamiliareTipo:false,edificioUnifamiliareIndirizzo:'',
         allegatoIntervento:null,annoIntervento:'',
         edificioUnifamiliarecitta:'', edificioUnifamiliareProvincia:'', edificioUnifamiliareAnnocostruzione:'',
         edificioUnifamiliarePianoImmobile:' di cui fuori terra n° ',edificioUnifamiliareTipologiaIntervento:false,
         condominioNome:'',condominioIndirizzo:'',condominioCitta:'',condominioProvincia:'',
         condominioAnnodicotruzione:'',condominioPianoimmboile:'',condominioPertinenzaC2C6C7:[],
         condominioformalmenteCostituito:false,condominioFormalmenteCostituitoCodiceFsicale:'',condominioFormalmenteCostituitoRiferimentoAmministatore:'',
         condominioNOformalmenteCostituitoReferente:'',condominioNOformalmenteCostituitoCodiceFiscaleReferente:'',
         dateAutorizzativi:'',	riferimentiAutorizzativi:'',			tipologiaTitoloAutorizzativi:'',
         AllegatoTitoloAutorizzativo:'', 
         Base64AllegatoTitoloAutorizzativo:'',
         
         
         TipoInterventoProposto:[],
         /*TipoInterventoPropostoEnergetico:false,TipoInterventoPropostoSismico:false,TipoInterventoPropostoCombinato:false,*/
         
         condominioNumeroUnitaAccatastate:'',condominioNumerounitariscaldate:'',cercaProgettista:'',screeningUnifamiliareIndipendente:'',screeningUnifamiliareIAcessoAutonomo:'',
         screeningUnifamiliareRiqualificazioneBalconi:'',screeningUnifamiliareUsufruito110:'',
         screeningCondominioUnicoProprietario:'',screeningCondominioSoggettiIRES:'',PossiedonoMultiProprieta:'',screeningCondominioUsufruito110:'',screeningCondominioA1A8A9:'', 
          
          files: null,
          abusiEdilizi:false,TipologiaAbusiEdilizi:'',comuneStatoDiFatto:false,NCEUStatoDiFatto:false,difformitaUrbanistiche:false,difformitaCatastali:false,irregolaritaSanabili:false,
          noteDifformitaUrbanistiche:'',noteDifformitaCatastali:'',noteIrregolaritaSanabili:'',

          datistrutturalichk:[],altroDatiStrutturali:'',
          tipologiaParetechk:[],altroTipologiaParetechk:'',
          tipologia_doppia_parete:[],
          SpessoreMuriEsterni:'',SpessoreCameraDaria:'',SpessoreIsolamento:'',TipologiaIsolamentoIncameraDaria:'',
          isolamentoEsistentechk:[],altroisolamentoEsistentechk:'',

          tipologiaImpiantoEsistente:'',

          cetraleTermicaCentralizzatoNumeroUnita:'', cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente:'', cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro:'', cetraleTermicaCentralizzatoAnnoInstallazione:'',cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornatoAllegato:null,
          cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente:'', cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste:'', cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente:'',
          cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato:'', cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate:'', cetraleTermicaCentralizzatoCertificatoCPI:'',
          cetraleTermicaCentralizzatoCertificatoCPIAllegato:null,cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornateAllegato:null,
          
          cetraleTermicaCentralizzatoTecnologiaImpiantoProposto:'',cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro:'', cetraleTermicaCentralizzatoNumeroUnitaProposte:'', centraleTermivaCentralizzatoVettoreImpianto:'',cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto:'',


          modalAggiungiImpiantoEsistenteAutonomo:false,  modalAggiungiImpiantoEsistenteAutonomoStatoProgetto:false,visualizzamessaggio:false,messaggioDaVisualizzare:'',
          NuovoImpiantoEsistenteAutonomosub:'', NuovoImpiantoEsistenteAutonomotecnologiaImpianto:'',NuovoImpiantoEsistenteAutonomonumeronUnitaGenerazione:'',NuovoImpiantoEsistenteAutonomotipologiaSistemaTermoregolazione:'',
          NuovoImpiantoEsistenteAutonomopotenzaTermicaUtile:'',NuovoImpiantoEsistenteAutonomoannoInstallazione:'',NuovoImpiantoEsistenteAutonomoGeneratoreOggettoDiSostituzione:'',
          allegatoDiAllegati:null,tipoAllegatodiAllegati:'',noteallegatoDiallegati:'',

          quotaPreventivo:'', quoteAllegatoPreventivo:null,
          dataAcconto:'',quotaAccontoModalitaPagamento:'',quotaImportoAcconto:'',quoteChiFattura:'',

          dataSpesaEffettuata:'',importoSpesaEffettuata:'', causaleSpesaEffettuata:'', chiHafattoSpesa:'',
          elencoProprietariImmobile:[],NuovoProprietarioImmobileNome:'',NuovoProprietarioImmobileCognome:'',NuovoProprietarioImmobileCodiceFiscale:'',NuovoProprietarioImmobileTelefono:'',
       tipoAltroAllegato:'',
      columns: [
        { name: 'id', align: 'center', label: 'ID', field: 'id', sortable: true },
        { name: 'nome', required: true, label: 'Nome', align: 'left', field: row => row.nome, format: val => `${val}`,sortable: true},
        { name: 'cognome', align: 'center', label: 'Cognome', field: 'cognome', sortable: true },
        { name: 'codiceFiscale', label: 'Codice Fiscale', field: 'codiceFiscale', sortable: true },
        { name: 'ragionesociale', label:'Ragione sociale', field:'ragionesociale'}
       
       
           ],

      elencoCercaAnagraficaClienti: [],
      elencoCercaCollaboratoreEsterno: [],
      elencoCercaCollaboratoreInterno: [],
      elencoCercaAnagraficaProgettisti: [],

      elencoAnagraficaClienti: [],
      elencoCollaboratoriEnterno: [],
      elencoCollaboratoriInterno: [],
      elencoAnagraficaProgettisti: [],
      elencoInterventiManutenzioneStraordinariaSCIACILAltro:[],
      elencoTitoliAutorizzatiInterventiSuccessivi:[],
      elencoTitoliAutorizzatiDatiCatastali:[],
      elencoImpiantoAutonomoEsistente:[],
      elencoImpiantoAutonomoEsistenteStatoDiProgetto:[],
      elencoImpiantoAutonomoProposto:[],
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
      elencoAllegati:[],
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
        {
        value:'altro',
        label:'Altro',
        },
       
        
      ],
      //deve essere uguale a quello di back-end
      staticTipoAllegato:{
        preventivoFirmato:'preventivoFirmato'

      },
      elencoQuote:[],
      elencoSpese:[]
    }
  },

  components: {
     
    formNuovaanagrafica,message
  },
  props:['idprogetto'],

  beforeMount:function(){


   if (this.idprogetto >0){ 
/********** DETTAGLI PROGETTO **********/

    this.nuovoProgetto=false;
Axios.get(this.linkApi+'/getProgetto/'+this.idprogetto).then(response =>{
//TODO PROBLEMA ALLEGATO
/* LISTA CLIENTI */
if (response.data['clienti'][0] != null){

 response.data['clienti'].forEach(element => {
   this.elencoAnagraficaClienti.push({
     nome:element.nome,
     cognome:element.cognome,
     codiceFiscale:element.codice_fiscale,
     denominazione:element.denominazione,
     partitaIva:element.partita_iva,
     id:element.id,
     
     });
   });
}
if (response.data['collaboratoriEsterni'][0] != null){

 response.data['collaboratoriEsterni'].forEach(element => {
   this.elencoCollaboratoriEnterno.push({
     nome:element.nome,
     cognome:element.cognome,
     codiceFiscale:element.codice_fiscale,
     denominazione:element.denominazione,
     partitaIva:element.partita_iva,
     id:element.id,
     });
   });
}
if (response.data['collaboratoriInterni'][0] != null){

 response.data['collaboratoriInterni'].forEach(element => {
   this.elencoCollaboratoriInterno.push({
     nome:element.nome,
     cognome:element.cognome,
     codiceFiscale:element.codice_fiscale,
     denominazione:element.denominazione,
     partitaIva:element.partita_iva,
     id:element.id,
     
        });
   });
}
if (response.data['progettistiProgetto'][0] != null){

 response.data['progettistiProgetto'].forEach(element => {
   this.elencoAnagraficaProgettisti.push({
     nome:element.nome,
     cognome:element.cognome,
     codiceFiscale:element.codice_fiscale,
      });
   });
}
if (response.data['interventiSuccessivi'][0] != null){

 response.data['interventiSuccessivi'].forEach(element => {
   this.elencoInterventiManutenzioneStraordinariaSCIACILAltro.push({
     id:element.id,
     id_legame:element.id_legame,
     id_progetto:element.id_progetto,
     anno:element.anno_intervento,
     allegato:element.nome_file,
     allegatoBase64:0,
     new:0,
     cancellare:0,
      });
   });
}
if (response.data['titoliAutorizzativiInterventiSuccessici'][0] != null){

 response.data['titoliAutorizzativiInterventiSuccessici'].forEach(element => {
   this.elencoTitoliAutorizzatiInterventiSuccessivi.push({
     sub:element.sub,
     descrizione:element.descrizione, 
     nomeAllegato:element.nome_file,
      allegatoBase64:0,
      new:0,
      cancellare:0
      });
   });
}
if (response.data['dataCatastali'][0] != null){

 response.data['dataCatastali'].forEach(element => {
   this.elencoTitoliAutorizzatiDatiCatastali.push({
     sub:element.sub,
     foglio:element.foglio, 
     particella:element.particella,
    });
   });
}
if (response.data['impiantoAutonomoDiFatto'][0] != null){

 response.data['impiantoAutonomoDiFatto'].forEach(element => {
   this.elencoImpiantoAutonomoEsistente.push({
     sub:element.sub,
     tecnologiaImpianto:element.tecnologia_impianto, 
     numeronUnitaGenerazione:element.numero_unita,
     tipologiaSistemaTermoregolazione:element.tipo_termoregolazione,
     potenzaTermicaUtile:element.potenza_kw,
     annoInstallazione:element.anno_installazione,
     GeneratoreOggettoDiSostituzione:element.oggetto_di_sostituzione,
     nuovo:0
     
     });
   });
}
if (response.data['impiantoAutonomoDiProgetto'][0] != null){

 response.data['impiantoAutonomoDiProgetto'].forEach(element => {
   this.elencoImpiantoAutonomoEsistenteStatoDiProgetto.push({
     sub:element.sub,
     tecnologiaImpianto:element.tecnologia_impianto, 
     numeronUnitaGenerazione:element.numero_unita,
     tipologiaSistemaTermoregolazione:element.tipo_termoregolazione,
     potenzaTermicaUtile:element.potenza_kw,
     annoInstallazione:element.anno_installazione,
     GeneratoreOggettoDiSostituzione:element.oggetto_di_sostituzione,
     nuovo:0
     });
   });
}
if (response.data['allegatiProgetto'][0] != null){

 response.data['allegatiProgetto'].forEach(element => {
   this.elencoAllegati.push({
     id:element.id,
     nomeFile:element.nome_file,
     noteFile:element.note_allegato, 
     tipoAllegato:element.tipo_allegato,
     idprogetto:element.id_progetto,
     new:0,
     cancellare:0,
     });
     if (element.tipo_allegato == this.staticTipoAllegato.preventivoFirmato){
     
     this.quoteAllegatoPreventivo=element.nome_file;
     }
   });
}
if (response.data['quoteAcconti'][0] != null){

 response.data['quoteAcconti'].forEach(element => {
   this.elencoQuote.push({
     dataPagamento:element.data,
     importo:element.importo, 
     metodoPagamento:element.modalita_pagamento,
     chiFatturato:element.chi_ha_fatturata,
     tipo_quota:element.tipo_quota,
   
     });
   });
}
if (response.data['quoteSpese'][0] != null){

 response.data['quoteSpese'].forEach(element => {
   this.elencoSpese.push({
     dataPagamento:element.data,
     importo:element.importo, 
     causale:element.modalita_pagamento,
     chiHapagato:element.chi_ha_fatturata,
     tipo_quota:element.tipo_quota,
     
     });
   });
}

if (response.data['infoEdificioProgetto'][0]!= null){
var dettagliEdificio=response.data['infoEdificioProgetto'][0];
this.edificioUnifamiliareTipo=dettagliEdificio.ef_tipo_edificio;
/* CONDOMINIO */
this.condominioNome=dettagliEdificio.cd_nome_condominio;
this.condominioIndirizzo=dettagliEdificio.cd_indirizzo;
this.condominioCitta=dettagliEdificio.cd_citta;
this.condominioProvincia=dettagliEdificio.cd_citta;
this.condominioAnnodicotruzione=dettagliEdificio.cd_annocostruzione;
this.condominioPianoimmboile=dettagliEdificio.cd_piano_immobile;
this.condominioNumeroUnitaAccatastate=dettagliEdificio.cd_numero_ui_accatastate;
this.condominioNumerounitariscaldate= dettagliEdificio.cd_numero_ui_riscaldate;
if (dettagliEdificio.cd_numero_pertinnze_accatastate != null){
var outputsplit = dettagliEdificio.cd_numero_pertinnze_accatastate.split(';');
if (outputsplit!=null){
   outputsplit.forEach(element=>{this.condominioPertinenzaC2C6C7.push(element)});
}}
this.condominioformalmenteCostituito=dettagliEdificio.cd_condominio_costituito;
if(dettagliEdificio.cd_condominio_costituito=='SI'){
this.condominioFormalmenteCostituitoCodiceFsicale=dettagliEdificio.cd_codicefiscale_condominio;
this.condominioFormalmenteCostituitoRiferimentoAmministatore=dettagliEdificio.cd_info_condominiocostituito;}
if(dettagliEdificio.cd_condominio_costituito=='NO'){
this.condominioNOformalmenteCostituitoCodiceFiscaleReferente=dettagliEdificio.cd_codicefiscale_condominio;
this.condominioNOformalmenteCostituitoReferente=dettagliEdificio.cd_info_condominiocostituito;}
/* SCREENIN CONDOMINIO */
this.screeningCondominioUnicoProprietario=dettagliEdificio.cd_unico_proprietario ;
this.screeningCondominioSoggettiIRES=dettagliEdificio.cd_ires;
this.screeningCondominioPossiedonoMultiProprieta=dettagliEdificio.cd_condomini_altri_unita;
this.screeningCondominioA1A8A9=dettagliEdificio.cd_a1a8a9;
this.screeningCondominioUsufruito110= dettagliEdificio.cd_usufruito110;


/*FINE CONDOMINIO */



/* familiare */
if (response.data['infoelencoProprietariImmobile'][0] != null){
  var listaProprietari=response.data['infoelencoProprietariImmobile'];
listaProprietari.forEach(element =>{ this.elencoProprietariImmobile.push(
         {nome:element.nome, 
         cognome:element.cognome,
        codiceFiscale:element.codicefiscale,
        telefono:element.telefono,
          });});
}
this.edificioUnifamiliareTipo=dettagliEdificio.ef_tipo_edificio;
this.edificioUnifamiliareIndirizzo=dettagliEdificio.ef_indirizzo;
this.edificioUnifamiliarecitta=dettagliEdificio.ef_citta;
this.edificioUnifamiliareProvincia=dettagliEdificio.ef_provincia;
this.edificioUnifamiliareAnnocostruzione=dettagliEdificio.ef_annocostruzione;
this.edificioUnifamiliarePianoImmobile=dettagliEdificio.ef_pianoImmobili;

/*screening familiare */
this.screeningUnifamiliareIndipendente=dettagliEdificio.ef_indipendente;
this.screeningUnifamiliareIAcessoAutonomo=dettagliEdificio.ef_accesso_autonomo;
this.screeningUnifamiliareUsufruito110=dettagliEdificio.ef_usufruito_110;
this.screeningUnifamiliareRiqualificazioneBalconi=dettagliEdificio.ef_riqualificazioni_balconi;



/* familiare */


}


/*DATI GENERICI PROGETTO */
  this.titoloProgetto=response.data['progetto'][0].titolo_progetto;
 this.tipologiaEdificio = response.data['progetto'][0].tipologia_edificio;

   var outputsplit= response.data['progetto'][0].zona_climatica.split(";");
   if (outputsplit!= null){
  outputsplit.forEach(element => {this.zonaClimatica.push(element); });}
  //this.zonaClimatica = response.data['progetto'][0].zona_climatica;
  this.gradigiornoText = response.data['progetto'][0].gradi_giorno ;
  this.areavincolata42 = response.data['progetto'][0].areavincolata; 
  this.areaVicnolata42TipoVincolo = response.data['progetto'][0].tipo_vincolo; 
  this.zonasismisca4 = response.data['progetto'][0].zonasismisca ;
  this.zonasismisca4Interventiantisismici = response.data['progetto'][0].interventi_antisismici ;
  this.zonasismisca4InterventiantisismiciAltriVincoli = response.data['progetto'][0].interventi_sismici_altri_vincoli ;
  if (response.data['progetto'][0].TipoInterventoProposto != null){
  outputsplit= response.data['progetto'][0].TipoInterventoProposto.split(";");
  if (outputsplit!= null){
  outputsplit.forEach(element => {this.TipoInterventoProposto.push(element); });}}
if (response.data['progetto'][0].TipologiainterventoDPR3802001 != null){
  outputsplit= response.data['progetto'][0].TipologiainterventoDPR3802001.split(";");
  if (outputsplit != null){
   outputsplit.forEach(element => {this.TipologiainterventoDPR3802001.push(element); });
  }
  }
  this.tipologiaTitoloAutorizzativi= response.data['progetto'][0].tipologiaTitoloAutorizzativi;
  this.riferimentiAutorizzativi= response.data['progetto'][0].riferimentiAutorizzativi;
  this.dateAutorizzativi= response.data['progetto'][0].dateAutorizzativi;
  this.AllegatoTitoloAutorizzativo=response.data['progetto'][0].AllegatoTitoloAutorizzativo;
  this.pathAllegatoTitoloAutorizzativo= 'http://localhost:8000/public/'+this.idprogetto+'/'+this.AllegatoTitoloAutorizzativo;
  this.abusiEdilizi= response.data['progetto'][0].abusiEdilizi;
  this.TipologiaAbusiEdilizi = response.data['progetto'][0].TipologiaAbusiEdilizi;
  this.comuneStatoDiFatto = response.data['progetto'][0].comuneStatoDiFatto;
  this.NCEUStatoDiFatto = response.data['progetto'][0].NCEUStatoDiFatto;
  this.difformitaUrbanistiche = response.data['progetto'][0].difformitaUrbanistiche;
  this.noteDifformitaUrbanistiche = response.data['progetto'][0].noteDifformitaUrbanistiche;
  this.difformitaCatastali = response.data['progetto'][0].difformitaCatastali;
  this.noteDifformitaCatastali= response.data['progetto'][0].noteDifformitaCatastali;
  this.irregolaritaSanabili= response.data['progetto'][0].irregolaritaSanabili;
  this.noteIrregolaritaSanabili= response.data['progetto'][0].noteIrregolaritaSanabili;

  if (response.data['progetto'][0].tipologia_struttura_edificiio != null){
   outputsplit= response.data['progetto'][0].tipologia_struttura_edificiio.split(";");
  
   outputsplit.forEach(element => {this.datistrutturalichk.push(element); });
  }
  this.altroDatiStrutturali = response.data['progetto'][0].altroDatiStrutturali;
  
  if (response.data['progetto'][0].tipologia_parete != null){
   outputsplit= response.data['progetto'][0].tipologia_parete.split(";");
   outputsplit.forEach(element => {this.tipologiaParetechk.push(element); });
  }

  this.altroTipologiaParetechk = response.data['progetto'][0].altroTipologiaParetechk;
 if ( response.data['progetto'][0].tipologia_doppia_parete  != null){
   outputsplit= response.data['progetto'][0].tipologia_doppia_parete.split(";");
   outputsplit.forEach(element => {this.tipologia_doppia_parete.push(element); });
  }
  this.SpessoreMuriEsterni = response.data['progetto'][0].spessori_muri_esternicm;
  this.SpessoreCameraDaria = response.data['progetto'][0].spessori_camera_ariacm;
  this.SpessoreIsolamento = response.data['progetto'][0].spessore_isolamentocm;
  this.TipologiaIsolamentoIncameraDaria = response.data['progetto'][0].tipo_isolamento_camera_aria;
  if (response.data['progetto'][0].cappotto != null){
  outputsplit= response.data['progetto'][0].cappotto.split(";");
  
   outputsplit.forEach(element => {this.isolamentoEsistentechk.push(element); });
  }
  this.altroisolamentoEsistentechk= response.data['progetto'][0].altroisolamentoEsistente;
  this.tipologiaImpiantoEsistente = response.data['progetto'][0].centraletermicaesistente_tipo_impianto;
  /* centrale termina centralizzato */

  this.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistente= response.data['progetto'][0].centraletermicaesistente_tecnologia_impianto;
  this.cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro= response.data['progetto'][0].cetraleTermicaCentralizzatoTecnologiaImpiantoEsistenteAltro;
  this.cetraleTermicaCentralizzatoNumeroUnita= response.data['progetto'][0].centraletermicaesistente_numero_unita_generazione;
  this.cetraleTermicaCentralizzatoAnnoInstallazione= response.data['progetto'][0].centraletermicaesistente_anno_installazione;
  this.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoEsistente= response.data['progetto'][0].centraletermicaesistente_potenza_termica;
  this.cetraleTermicaCentralizzatoTipologiaDistribuzioneEsiste= response.data['progetto'][0].centraletermicaesistente_tipologia_distribuzione;
  this.cetraleTermicaCentralizzatoTipologiaTermoregolazioneEsistente= response.data['progetto'][0].centraletermicaesistente_tipologia_termoregolazione;
  this.cetraleTermicaCentralizzatoDisponibilitaLibrettoImpiantoAggiornato=response.data['progetto'][0].centraletermicaesistente_libretto_impianto_aggiornato;
  this.cetraleTermicaCentralizzatoDisponbilitaProveFumiAggiornate= response.data['progetto'][0].centraletermicaesistente_provefumi;
  this.cetraleTermicaCentralizzatoCertificatoCPI=response.data['progetto'][0].centraletermicaesistente_cpi;
  this.cetraleTermicaCentralizzatoTecnologiaImpiantoProposto=response.data['progetto'][0].centraletermicaprogetto_tecnologia_esistente;
  this.cetraleTermicaCentralizzatoTecnologiaImpiantoPropostonteAltro=response.data['progetto'][0].centraletermicaprogetto_tecnologia_esistente_altro;
  this.cetraleTermicaCentralizzatoNumeroUnitaProposte=response.data['progetto'][0].centraletermicaprogetto_numero_unita;
  this.cetraleTermicaCentralizzatoPotenzaTermicaImpiantoProposto=response.data['progetto'][0].centraletermicaprogetto_potenza_termica;
  this.centraleTermivaCentralizzatoVettoreImpianto=response.data['progetto'][0].centraletermicaprogetto_vettore_energetico;
  this.quotaImportoAcconto= response.data['progetto'][0].quota_preventivo;
  
})

  }else{
    this.nuovoProgetto=true;
  }
  }

}
</script>