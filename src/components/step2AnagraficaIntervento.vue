<template>
    <div>

         <div  style="background-color: white;">
            <div class="col">
                <b>Tipologia Edificio</b>
                <div class="q-gutter-sm">
      <q-radio v-model="value.tipologiaEdificio" val="condominio" label="Condominio"  :disable="!value.modificaAttivo" />
      <q-radio v-model="value.tipologiaEdificio" val="edificioFamiliare" label="Edificio Residenziale" :disable="!value.modificaAttivo"  />
      <q-radio v-model="value.tipologiaEdificio" val="commerciale" label="Commerciale"  :disable="!value.modificaAttivo" />
      <q-radio v-model="value.tipologiaEdificio" val="altro" label="altro" :disable="!value.modificaAttivo"  />
      
    </div>
            </div>
        </div>
          <!--***** Edificio Familiare **** -->
        <div v-if="value.tipologiaEdificio =='edificioFamiliare' || value.tipologiaEdificio =='commerciale'  || value.tipologiaEdificio =='altro' " class="bgmargintop "  >
          <span class="text-h6"><b>Edificio</b></span>
          <div class="row">
            <div class="col">
              <q-radio v-model="value.edificioUnifamiliareTipo" val="unifimaliare" label="Edificio residenziale unifamiliare"  :disable="!value.modificaAttivo"  /> 
              
              <q-radio v-model="value.edificioUnifamiliareTipo" val="plurifimiliare" label="Unità immobiliare sita all’interno di edifici plurifamiliari"  :disable="!value.modificaAttivo" /> 
              <q-radio v-model="value.edificioUnifamiliareTipo" val="commeciale" label="Commerciale"  :disable="!value.modificaAttivo" /> 
              <q-radio v-model="value.edificioUnifamiliareTipo" val="altro" label="Altro"  :disable="!value.modificaAttivo" /> 
              <q-input v-model="value.altroTipoEdificioFamiliare" type="text" label="Altro" :dense="true" outlined  v-if="value.edificioUnifamiliareTipo == 'altro' "  :disable="!value.modificaAttivo" />

            </div>
          </div>
          <div class="row q-gutter-xs" style="padding-top:20px">
            <div class="col-12"><b> Dati proprietario dell'immobile </b></div>
            <!--<div class="col-12">
              <q-btn   label="Aggiungi"   icon="add_circle_outline" @click="modalNuovaAnagraficaClienti = true" />
            </div> -->
            <div class="col-2">
              <label>Nome</label>
              <q-input v-model="NuovoProprietarioImmobileNome" type="text" :dense="true"  outlined :disable="!value.modificaAttivo" />
              </div>
            <div class="col-2">
               <label>Cognome</label>
              <q-input v-model="NuovoProprietarioImmobileCognome" type="text" :dense="true"  outlined :disable="!value.modificaAttivo" />
           </div> 
            <div class="col-2">
               <label>Codice Fiscale</label>
              <q-input v-model="NuovoProprietarioImmobileCodiceFiscale" type="text" maxlength="15" :dense="true"  outlined :disable="!value.modificaAttivo" />
          
            </div>
            <div class="col-2">
               <label>Telefono</label>
              <q-input v-model="NuovoProprietarioImmobileTelefono" type="text" :dense="true" outlined   :disable="!value.modificaAttivo" />
          </div>
          <div class="col-2">
            <q-btn color="primary"  style="margin-top:23px" icon="add" :dense="true"  outline @click="addRowProprietariImmobile()" :disable="!value.modificaAttivo"  /></div>


          </div>
          <div class="row"  style="border-bottom:1px solid black">
            <div class="col-2"><b>Nome</b> </div>  
            <div class="col-2"><b>Cognome</b> </div>  
            <div class="col-2"><b>Codice Fiscale</b></div>  
            <div class="col-2"><b>Telefono</b></div>  
            <div class="col-2"><b></b></div>  
          </div>
          
          <div  class="row" v-for="(item,index) in value.elencoProprietariImmobile" :key="item.message" style="border-bottom:1px solid black">
            <div class="col"> {{ item.nome }}</div>
            <div class="col"> {{ item.cognome }}</div>
            <div class="col"> {{ item.codiceFiscale }}</div>
            <div class="col"> {{ item.telefono }}</div>
            <div class="col">   <q-btn   size="sm" round icon="delete" @click="value.elencoProprietariImmobile.splice(index, 1)" />
            </div>
   
          </div>

           <div class="row" style="padding-top:20px">
             <div class="col">
               <label><b>Dati dell'immobile </b></label>
             </div>
           </div>
          <div class="row">
            
            <div class="col"><q-input v-model="value.edificioUnifamiliareIndirizzo"  outlined :dense=true type="text" label="Indirizzo" style="padding:5px"  :disable="!value.modificaAttivo" /></div>
            <div class="col"><q-input v-model="value.edificioUnifamiliarecitta"   outlined :dense=true  type="text" label="Città" style="padding:5px"  :disable="!value.modificaAttivo" /></div>
            <div class="col"><q-input v-model="value.edificioUnifamiliareProvincia"   outlined :dense=true  type="text" label="Provincia" style="padding:5px"  :disable="!value.modificaAttivo" /></div>
            <div class="col"><q-input v-model="value.edificioUnifamiliareAnnocostruzione"    outlined :dense=true  type="text" label="Anno di costruzione" style="padding:5px"  :disable="!value.modificaAttivo" /></div>
          </div>
          
          <div class="row" style="padding-top:20px;">
            <div class="col">
              <label><b>Piano immobile</b></label>
              <q-input v-model="value.edificioUnifamiliarePianoImmobile" type="text"  outlined :dense="true"  :disable="!value.modificaAttivo" />
            </div>
          </div>

 <q-space />


        </div>

                <!--***** Edificio Condominio********-->
        <div v-if="value.tipologiaEdificio == 'condominio'"   class="bgmargintop "  >
        <span class="text-h6"><b>Condominio</b></span>  
          <div class="row">
            <div class="col">
              <q-input v-model="value.condominioNome"  outlined :dense=true   type="text"  style="padding:5px" label="Nome Condominio"  :disable="!value.modificaAttivo" /><!-- Riportare nel mandato per la redazione dello studio di fattibilità-->

            </div>
          </div>

          <div class="row">
            <div class="col">
              <q-input v-model="value.condominioIndirizzo"  outlined :dense=true  type="text"  style="padding:5px" label="Indirizzo" :disable="!value.modificaAttivo"  />
            </div>
            <div class="col">
              <q-input v-model="value.condominioCitta"   outlined :dense=true type="text"  style="padding:5px" label="Citta" :disable="!value.modificaAttivo"  />
            </div>
            <div class="col">
              <q-input v-model="value.condominioProvincia"  outlined :dense=true type="text"  style="padding:5px" label="Provincia "  :disable="!value.modificaAttivo" />
           </div>
           
           </div>

          <div class="row">
            <div class="col-2">
              <q-input v-model="value.condominioAnnodicotruzione" type="number"  outlined :dense=true   style="padding:5px" label="Anno di costruzione " :disable="!value.modificaAttivo"/>
            </div>
            <div class="col-2">
              <q-input v-model="value.condominioPianoimmboile"  outlined :dense=true type="text"  style="padding:5px" label="Piano Immobile " :disable="!value.modificaAttivo"/>
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
               <q-input v-model="value.condominioNumeroUnitaAccatastate" outlined :dense=true  type="number"  style="padding:5px;max-width:150px" :disable="!value.modificaAttivo" />
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
              <q-input v-model="value.condominioNumerounitariscaldate" type="text"   style="padding:5px;max-width:150px" outlined :dense=true :disable="!value.modificaAttivo"/>
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
              <q-checkbox right-label v-model="value.condominioPertinenzaC2C6C7" val="C/2" label="C/2 magazzini e locali di deposito" :disable="!value.modificaAttivo"/>
              <q-checkbox right-label v-model="value.condominioPertinenzaC2C6C7" val="C/6" label="C/6 stalle, scuderie, rimesse, autorimesse" :disable="!value.modificaAttivo"/>
              <q-checkbox right-label v-model="value.condominioPertinenzaC2C6C7" val="C/7" label="C/7 tettoie chiuse o aperte" :disable="!value.modificaAttivo"/>
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
              <q-radio v-model="value.condominioformalmenteCostituito" val="SI" label="SI" :disable="!value.modificaAttivo"/>
              <q-radio v-model="value.condominioformalmenteCostituito" val="NO" label="NO" :disable="!value.modificaAttivo"/>
            </div>
          </div>
          <div class="row" v-if="value.condominioformalmenteCostituito == 'SI'">
            <div class="col-3">
              <q-input v-model="value.condominioFormalmenteCostituitoCodiceFsicale" outlined :dense=true type="text" label="Codice Fiscale Condominio"  style="padding:5px;max-width:250px" maxlength="16" :disable="!value.modificaAttivo"/>
              </div>
            <div class="col"> 
               <q-input v-model="value.condominioFormalmenteCostituitoRiferimentoAmministatore" outlined :dense=true type="text" style="padding:5px;" label="Riportare Nome e Cognome, email (no pec) e num. di telefono" :disable="!value.modificaAttivo"/>
               </div>
          </div>
          
          <div class="row" v-if="value.condominioformalmenteCostituito == 'NO'">
            <div class="col-4">
              <q-input v-model="value.condominioNOformalmenteCostituitoReferente" outlined :dense=true type="text" label="Riferimento Referente" style="padding:5px;" :disable="!value.modificaAttivo"/>
              </div>
              
            <div class="col-4">
              <q-input v-model="value.condominioNOformalmenteCostituitoCodiceFiscaleReferente" outlined :dense=true type="text" label="Codice Fsicale Referente"  style="padding:5px;max-width:250px" maxlength="16"  :disable="!value.modificaAttivo"/>
            </div>
          </div>

          
 <q-space />

<div class="row"><div class="col"><hr/></div></div>
        </div>



        <div :v-if="value.tipologiaEdificio == 'condominio' || value.tipologiaEdificio=='edificioFamiliare'"  class="bgmargintop " >

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
                  <q-checkbox v-model="value.zonaClimatica" label="Zona A: GG<600" val="zonaA" :disable="!value.modificaAttivo"/> 
                  <q-checkbox v-model="value.zonaClimatica" label="Zona B: 601<GG<900" val="zonaB" :disable="!value.modificaAttivo" /> 
                  <q-checkbox v-model="value.zonaClimatica" label="Zona C: 901<GG>1400" val="zonaC" :disable="!value.modificaAttivo" /> 
                  <q-checkbox v-model="value.zonaClimatica" label="Zona D: 1401<GG>2100" val="zonaD"  :disable="!value.modificaAttivo"/> 
                  <q-checkbox v-model="value.zonaClimatica" label="Zona E: 2101<GG>3000" val="zonaE" :disable="!value.modificaAttivo" /> 
                  <q-checkbox v-model="value.zonaClimatica" label="Zona F: GG>3000" val="zonaF" :disable="!value.modificaAttivo" /> 

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

                <q-input outlined :dense=true style="max-width:200px"   v-model="value.gradigiornoText" type="text" label="Gradi" :disable="!value.modificaAttivo"/>
               
             </div>
          </div>


        <div class="row" style="padding-top:20px">
          <div class="col">
            <b>L’immobile è in area vincolata (Decreto Legislativo 22 gennaio 2004, n. 42):</b>
            <div class="q-gutter-sm">
            <q-radio v-model="value.areavincolata42" val="SI" label="SI" :disable="!value.modificaAttivo"/> 
            <q-radio v-model="value.areavincolata42" val="NO" label="NO" :disable="!value.modificaAttivo"/> 
            <q-input  type="text" v-if="value.areavincolata42 == 'SI'" label="Specificare il tipo di vincolo" v-model="value.areaVicnolata42TipoVincolo" :disable="!value.modificaAttivo"/>
          </div>
          </div>
        </div>

        <div class="row" style="padding-top:20px">
          <div class="col"><b>L’immobile il quale zona sismica ricade</b>
           <div class="q-gutter-sm">
          <q-radio v-model="value.zonasismisca4" val="1" label="Zona 1" :disable="!value.modificaAttivo"/> 
          <q-radio v-model="value.zonasismisca4" val="2" label="Zona 2" :disable="!value.modificaAttivo"/> 
          <q-radio v-model="value.zonasismisca4" val="3" label="Zona 3" :disable="!value.modificaAttivo"/> 
          <q-radio v-model="value.zonasismisca4" val="4" label="Zona 4" :disable="!value.modificaAttivo"/> 
          <q-input  type="text"  v-model="value.zonasismisca4Interventiantisismici" v-if="value.zonasismisca4 != ''" label="Compilare solo nel caso in cui siano previsti interventi antisismici" />
          <q-input  type="text"  v-model="value.zonasismisca4InterventiantisismiciAltriVincoli" v-if="value.zonasismisca4 != ''" label="Altri vincoli" />
          </div>
          </div>
        </div>
        <div class="row" style="padding-top:20px">
            <div class="col-12">
              <b>Tipologia intervento proposto</b>

            </div>
            <div class="col4">
              <q-checkbox right-label  v-model="value.TipoInterventoProposto" label="Energetico" val="energetico" :disable="!value.modificaAttivo"/>
              <q-checkbox right-label v-model="value.TipoInterventoProposto" label="Sismico"  val="sismico" :disable="!value.modificaAttivo"/>
              <q-checkbox right-label v-model="value.TipoInterventoProposto" label="Combinato" val="combinato" :disable="!value.modificaAttivo"/>
            </div>
          </div>
        <div class="row" style="padding-top:20px">
            <div class="col-12">
              <b>Tipologia intervento DPR 380/2001</b>

            </div>
            <div class="col4">
              <q-checkbox right-label  v-model="value.TipologiainterventoDPR3802001" val="ordinaria" label="Manutenzione Ordinaria" :disable="!value.modificaAttivo"/>
              <q-checkbox right-label v-model="value.TipologiainterventoDPR3802001" val="straordinaria" label="Manutenzione straordinaria" :disable="!value.modificaAttivo"/>
              <q-checkbox right-label v-model="value.TipologiainterventoDPR3802001" val="risanamentoConservativo"  label="Restauro e risanamento conservativo" :disable="!value.modificaAttivo" />
              <q-checkbox right-label v-model="value.TipologiainterventoDPR3802001" val="ristrutturazioneEdilizia"  label="Ristrutturazione Edilizia" :disable="!value.modificaAttivo"/>
              <q-checkbox right-label v-model="value.TipologiainterventoDPR3802001" val="nuovaCostruzione"  label="Nuova Costruzione" :disable="!value.modificaAttivo" />
              <q-checkbox right-label v-model="value.TipologiainterventoDPR3802001" val="ristrutturazioneUrbanistica"  label="Interventi di ristrutturazione urbanistica" :disable="!value.modificaAttivo"/>
            </div>
          </div>

        <div class="row">
          <div class="col">
            <hr>
            </div>
        </div>
        </div>

       
        


        <!--*** Progettisti *** -->
        <div class="bgAree ">
        <div class="row " >
          <div class="col">
            <div class="col-12"><b>Progettisti</b></div>
           
          </div>
        </div>
        <div class="row q-gutter-sm "  style="padding-top:20px">
            <div class="col-7">
               <q-input v-model="value.cercaProgettista" @keypress=" elencoCercaAnagraficaProgettistiFunction()" outlined :dense=true type="text" label="Cerca" :disable="!value.modificaAttivo">
               <div class="autocomplete-items" v-if="value.cercaProgettista.length > 2">
            <div class="row"  v-for="item in value.elencoCercaAnagraficaProgettisti" :key="item.message">
              
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
         
        </div>
        <div class="row"  style="border-bottom:1px solid black">
            <div class="col"><b>Nome</b> </div>  
            <div class="col"><b>Cognome</b> </div>  
            <div class="col"><b>Codice Fiscale</b> </div>  
            <div class="col"> </div>  
        </div>
        <div  class="row" v-for="(item ,index) in value.elencoAnagraficaProgettisti" :key="item.message" >
        <div class="col"> {{ item.nome }}</div>
        <div class="col"> {{ item.cognome }}</div>
        <div class="col"> {{ item.codiceFiscale }}</div>
          <div class=""> 
                <q-btn   size="sm" round icon="delete" @click="value.elencoAnagraficaProgettisti.splice(index, 1)" />
              </div>
   </div>


            </div>
    </div>
</template>
<script>
import Axios from 'axios';
export default {
    props:['value'],
    data(){return{
        NuovoProprietarioImmobileNome:'',
        NuovoProprietarioImmobileCognome:'',
        NuovoProprietarioImmobileCodiceFiscale:'',
        NuovoProprietarioImmobileTelefono:'',
    }},
    methods:{   
        addRowProprietariImmobile()
        {
            this.value.elencoProprietariImmobile.push({
                nome:this.NuovoProprietarioImmobileNome, 
                cognome:this.NuovoProprietarioImmobileCognome,
                codiceFiscale:this.NuovoProprietarioImmobileCodiceFiscale,
                telefono:this.NuovoProprietarioImmobileTelefono,
                });
                this.NuovoProprietarioImmobileNome='';
                this.NuovoProprietarioImmobileCognome='';
                this.NuovoProprietarioImmobileCodiceFiscale='';
                this.NuovoProprietarioImmobileTelefono='';

                },
                 
    elencoCercaAnagraficaProgettistiFunction()
    {
        if (this.value.cercaProgettista.length >1)
        {
            Axios.get(this.linkApi+'/getCercaAnagrafica/collaboratoreInterno/'+this.value.cercaProgettista).then(Response=>{console.log(Response.data);this.value.elencoCercaAnagraficaProgettisti= Response.data})
        }
    },   
    aggiungiElencoProgettisti(datiUtente)
    {
        this.value.elencoAnagraficaProgettisti.push({
            nome:datiUtente.nome,
            cognome:datiUtente.cognome,
            denominazione:datiUtente.denominazione,
            codiceFiscale:datiUtente.codice_fiscale,
            partitaIva:datiUtente.partita_iva,
            id:datiUtente.id});
            this.value.cercaProgettista='';
            this.value.elencoCercaAnagraficaProgettisti=null;
    },
    }
}
</script>

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