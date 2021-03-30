<template>
    <div class=" q-pa-md">
          <div v-if="value.tipologiaEdificio == 'edificioFamiliare'" class="bgmargintop">
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
      <q-radio v-model="value.screeningUnifamiliareIndipendente" val="SI" label="SI" />
      <q-radio v-model="value.screeningUnifamiliareIndipendente" val="NO" label="NO" />
      
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
      <q-radio v-model="value.screeningUnifamiliareIAcessoAutonomo" val="SI" label="SI" />
      <q-radio v-model="value.screeningUnifamiliareIAcessoAutonomo" val="NO" label="NO" />
      
      </div>
  </div>

  <div class="row">
    <div class="col-12">
      <b>Il proprietario dell’immobile ha già usufruito o
ha intenzione di usufruire della detrazione
al 110% per altre unità immobiliari?</b>
     
    </div>
    <div class="col-12">
      <q-radio v-model="value.screeningUnifamiliareUsufruito110" val="SI" label="SI" />
      <q-radio v-model="value.screeningUnifamiliareUsufruito110" val="NO" label="NO" />
      
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
      <q-radio v-model="value.screeningUnifamiliareRiqualificazioneBalconi" val="SI" label="SI" />
      <q-radio v-model="value.screeningUnifamiliareRiqualificazioneBalconi" val="NO" label="NO" />
      
      </div>
  </div>




  </div>
  <div v-if="value.tipologiaEdificio == 'condominio'" class="bgmargintop">

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
      <q-radio v-model="value.screeningCondominioUnicoProprietario" val="SI" label="SI" />
      <q-radio v-model="value.screeningCondominioUnicoProprietario" val="NO" label="NO" />
      
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
      <q-radio v-model="value.screeningCondominioSoggettiIRES" val="SI" label="SI" />
      <q-radio v-model="value.screeningCondominioSoggettiIRES" val="NO" label="NO" />
      
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
      <q-radio v-model="value.screeningCondominioPossiedonoMultiProprieta" val="SI" label="SI" />
      <q-radio v-model="value.screeningCondominioPossiedonoMultiProprieta" val="NO" label="NO" />
      
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
      <q-radio v-model="value.screeningCondominioA1A8A9" val="SI" label="SI" />
      <q-radio v-model="value.screeningCondominioA1A8A9" val="NO" label="NO" />
      
      </div>
  </div>

 <div class="row">
    <div class="col-12">
      <b>Ci sono condòmini che hanno già usufruito o che hanno intenzione di usufruire della detrazione al 110% per altre u. i. esterne al condominio??</b>
      
    </div>
    <div class="col-12">
      <q-radio v-model="value.screeningCondominioUsufruito110" val="SI" label="SI" />
      <q-radio v-model="value.screeningCondominioUsufruito110" val="NO" label="NO" />
      
      </div>
  </div>

</div>

<!-- Titolo autorizzativi-->

 <div class=" bgmargintop q-gutter-sm row" >
   <div class="col-12"><span class="text-h6 text-secondary">Titoli autorizzativi</span></div>
   
    <div class="col-12">
      <b>Tipologia Titolo</b>
      <q-icon name="info" >
        <q-tooltip anchor="top middle" self="bottom middle" >
        Riportare il titolo con il quale è stato edificato l’edificio
          </q-tooltip>
      </q-icon> <q-input v-model="value.tipologiaTitoloAutorizzativi" type="text" outlined :dense="true"  />
    </div>
    <div class="col-3">
      <label for="">Riferimenti</label>
      <q-input v-model="value.riferimentiAutorizzativi" type="text" outlined :dense="true"  />
 </div>
 <div class="col-3">
      <label>Data</label>
     <q-input  outlined :dense="true"  v-model="value.dateAutorizzativi" mask="date" :rules="['date']">
      <template v-slot:append>
        <q-icon name="event" class="cursor-pointer">
          <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
            <q-date v-model="value.dateAutorizzativi">
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
      <a href="#"  v-if="!value.nuovoProgetto" @click="downloadFile(value.idprogetto+'/'+value.AllegatoTitoloAutorizzativo,value.AllegatoTitoloAutorizzativo)" >{{value.AllegatoTitoloAutorizzativo}}</a>
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
   <div class="row" style="background-color:white" v-if="value.elencoInterventiManutenzioneStraordinariaSCIACILAltro.length>0">
    <div class="col"><b>Anno di intervento</b></div>
    <div class="col"><b>Allegato</b></div>
    
    <div class="col-1 col-md-1 "></div>
    
    </div>

<!--  --> 
    <div   v-for="(item,index) in value.elencoInterventiManutenzioneStraordinariaSCIACILAltro" :key="item.message"  style="border-bottom:1px solid black background-color:white; ">
    <div class="row" v-if="item.cancellare != '1'">
    <div class="col"> {{ item.anno }}</div>
    <div class="col"><span  @click="downloadFile(value.idprogetto+'/'+item.allegato, item.allegato)" style=" cursor: pointer; text-decoration:underline"> {{ item.allegato }}</span></div>
 
    <div class="col-1 col-md-1 "> 
    <q-btn v-if="value.nuovoProgetto"  size="sm" round icon="delete" @click="value.elencoInterventiManutenzioneStraordinariaSCIACILAltro.splice(index, 1)" />
    <q-btn v-if="!value.nuovoProgetto"  size="sm" round icon="delete" @click="value.elencoInterventiManutenzioneStraordinariaSCIACILAltro[index].cancellare='1'" />

  </div>
  </div>
  </div>

</div>
</div>



<div class="row"><hr></div>
<!-- ALLEGATI INTERVENTI SUCCESSIVI ALLA COSTRUZIONE -->
<div  style="background-color:white" class="q-gutter-sm ">
  <div class="row  bgmargintop  q-gutter-sm" >
    <div class="col-6"><label for=""><b>Titoli autorizzativi relativi ad interventi successivi alla costruzione</b></label></div>
    <div class="col-2">
      </div>

  </div>
  <div class="row  q-gutter-sm bgmargintop " style="background-color:white">
    <div class="col"><b><q-input v-model="InterventiSuccessiviNuovoSub" :dense="true" outlined  type="text" label="Sub" /></b></div>
    <div class="col"><b><q-input v-model="InterventiSuccessiviNuovaDecrizione" :dense="true" outlined  type="text" label="Successivi interventi" /></b></div>
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
  <div class="row " style="background-color:white" v-if="value.elencoTitoliAutorizzatiInterventiSuccessivi.length > 0">
    <div class="col"><b>Sub</b></div>
    <div class="col"><b>Successivi interventi</b></div>
    <div class="col"><b>Allegato</b></div>
    <div class="col-1 col-md-1 "></div>
    
    </div>
  


 <div v-for="(item,index) in value.elencoTitoliAutorizzatiInterventiSuccessivi" :key="item.message" style="border-bottom:1px solid black background-color:white; ">
   <div  class="row"  v-if="item.cancellare == '0'">

    <div class="col"> {{ item.sub }}</div>
    <div class="col"> {{ item.descrizione }}</div>
    <div class="col"><span  @click="downloadFile(value.idprogetto+'/'+item.nomeAllegato, item.nomeAllegato)" style=" cursor: pointer; text-decoration:underline"> {{ item.nomeAllegato }}</span></div>
    <div class="col-1 col-md-1 "> 
    <q-btn v-if="value.nuovoProgetto"  size="sm" round icon="delete" @click="value.elencoTitoliAutorizzatiInterventiSuccessivi.splice(index, 1)" />
    <q-btn v-if="!value.nuovoProgetto"  size="sm" round icon="delete" @click="value.elencoTitoliAutorizzatiInterventiSuccessivi[index].cancellare='1'" />
   
</div>
  </div>
  </div>
</div>
<div  style="background-color:white" class="q-gutter-sm ">
<!-- DATI CATASTALI -->
  <div class="row " style="padding-top:10px" >
    <div class="col-12"><label > <b>Dati catastali</b></label>  </div>
   
  </div>

      <div class="row  q-gutter-sm " style="background-color:white; border-bottom:1px solid black">
    <div class="col"><b><q-input v-model="DatiCatastaliTitoliAutorizzativiNuovoFoglio" label="foglio" :dense="true" outlined  type="text" /></b></div>
    <div class="col"><b><q-input v-model="DatiCatastaliTitoliAutorizzativiNuovoParticella" label="particella" :dense="true" outlined  type="text"  /></b></div>
    <div class="col"><b><q-input v-model="DatiCatastaliTitoliAutorizzativiNuovoSub" label="sub" :dense="true" outlined  type="text" /></b></div>

    <div class="col"> <q-btn icon="add"  color="primary" @click="addrowDatiCatastaliTitoliAutorizzativi(); " outline :dense="true" /></div>
    
    </div>
 <div  class="row  q-gutter-sm" v-for="(item,index) in value.elencoTitoliAutorizzatiDatiCatastali" :key="item.message" >
    <div class="col"> {{ item.foglio }}</div>
    <div class="col"> {{ item.particella }}</div>
    <div class="col"> {{ item.sub }}</div>
   <div class="col-1 col-md-1 "> 
    <q-btn   size="sm" round icon="delete" @click="value.elencoTitoliAutorizzatiDatiCatastali.splice(index, 1)" />
  
  </div>

  </div>
  </div>

<div class="bgmargintop q-gutter-sm">
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
      <q-radio v-model="value.abusiEdilizi" val="SI" label="SI" />
      <q-radio v-model="value.abusiEdilizi" val="NO" label="NO" />
    </div>
    
    <div class="col-12" v-if="value.abusiEdilizi =='SI'  ">
      <label for="">Specificare la tipologia</label>
      <q-input v-model="value.TipologiaAbusiEdilizi" type="text" :dense='true' outlined  />
    </div>

  </div>
  <div class="row"  style="padding-top:10px" >  
    <div class="col-12">
      <strong>Il progetto in atto al comune risulta corrispondente allo stato di fatto:</strong>
    </div>

    <div class="col-12">
      <q-radio v-model="value.comuneStatoDiFatto" val="SI" label="SI" />
      <q-radio v-model="value.comuneStatoDiFatto" val="NO" label="NO" />
    </div>

  </div>
  <div class="row"  style="padding-top:10px" >  
    <div class="col-12">
      <strong>La planimetria censita al NCEU risulta corrispondente allo stato di fatto:</strong>
    </div>

    <div class="col-12">
      <q-radio v-model="value.NCEUStatoDiFatto" val="SI" label="SI" />
      <q-radio v-model="value.NCEUStatoDiFatto" val="NO" label="NO" />
    </div>

  </div>
  <div class="row"  style="padding-top:10px" >  
    <div class="col-12">
      <strong>L’immobile presenta difformità urbanistiche*:</strong>
    </div>

    <div class="col-12">
      <q-radio v-model="value.difformitaUrbanistiche" val="SI" label="SI" />
      <q-radio v-model="value.difformitaUrbanistiche" val="NO" label="NO" />
    </div>
    <div class="col-12" v-if="value.difformitaUrbanistiche == 'SI'">
      <q-input v-model="value.noteDifformitaUrbanistiche" outlined  type="textarea" label="Note Difformità urbanistiche" />
    </div>

  </div>
  <div class="row"  style="padding-top:10px" >  
    <div class="col-12">
      <strong>L’immobile presenta difformità catastali**:</strong>
    </div>

    <div class="col-12">
      <q-radio v-model="value.difformitaCatastali" val="SI" label="SI" />
      <q-radio v-model="value.difformitaCatastali" val="NO" label="NO" />
    </div>
<div class="col-12" v-if="value.difformitaCatastali == 'SI'">
      <q-input v-model="value.noteDifformitaCatastali" outlined  type="textarea" label="Note Difformità Catastali" />
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
      <q-radio v-model="value.irregolaritaSanabili" val="SI" label="SI" />
      <q-radio v-model="value.irregolaritaSanabili" val="NO" label="NO" />
    </div>
<div class="col-12" v-if="value.irregolaritaSanabili == 'SI'">  
      <q-input v-model="value.noteIrregolaritaSanabili" outlined  type="textarea" label="Note Irregolarità Sanabili" />
    </div>

  </div>
</div>

    </div>
</template>


<script>
import Axios from 'axios';
export default {
    data(){return {
annoIntervento:'',

nameAuxFile:null,
auxFile:null,
InterventiSuccessiviNuovoSub:'',
InterventiSuccessiviNuovaDecrizione:'',
DatiCatastaliTitoliAutorizzativiNuovoSub:'',
DatiCatastaliTitoliAutorizzativiNuovoParticella:'',
DatiCatastaliTitoliAutorizzativiNuovoFoglio:'',

    }},
    methods:{
    handleFileTitoliAutorizzativi(e){
      this.value.AllegatoTitoloAutorizzativo=e.target.files[0].name;
      const selectImage= e.target.files[0];
      this.createBase64TitoliAutorizzativi(selectImage);

    },
     createBase64TitoliAutorizzativi(fileObject){
      const reader = new FileReader();
      reader.onload = (e)=>{
       var aux= e.target.result;
       var base64string = window.btoa(aux);
       this.value.Base64AllegatoTitoloAutorizzativo=base64string;
      };
      this.value.Base64AllegatoTitoloAutorizzativo= reader.readAsBinaryString(fileObject);

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
  
      this.value.elencoInterventiManutenzioneStraordinariaSCIACILAltro.push(
        {
          anno:this.annoIntervento,
          allegato:this.nameAuxFile,
          allegatoBase64:this.auxFile,
          new:1,
          cancellare:0

        });

        },   
         downloadFile(path,titoloFile){
       Axios.post(this.linkApi+'/download/',{params:{pp:path}}).then(response=>{
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
          addrowInterventiSuccessivi(){
      this.value.elencoTitoliAutorizzatiInterventiSuccessivi.push(
        {
          sub:this.InterventiSuccessiviNuovoSub,
          descrizione:this.InterventiSuccessiviNuovaDecrizione,
          nomeAllegato:this.nameAuxFile,
          allegatoBase64:this.auxFile,
          new:1,
          cancellare:0,
        });
        this.InterventiSuccessiviNuovoSub='';
        this.InterventiSuccessiviNuovaDecrizione='';
        this.nameAuxFile='';

  
    },
      addrowDatiCatastaliTitoliAutorizzativi(){
      this.value.elencoTitoliAutorizzatiDatiCatastali.push(
        {sub:this.DatiCatastaliTitoliAutorizzativiNuovoSub,
         particella:this.DatiCatastaliTitoliAutorizzativiNuovoParticella,
         foglio:this.DatiCatastaliTitoliAutorizzativiNuovoFoglio});
         },

    },
    props:['value'],
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