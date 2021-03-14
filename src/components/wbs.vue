<template>
  <div>
    <div id="container"></div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        Acquisizione DOC <q-icon name="info" @click="getwbs(1); " />
      </div>
      <q-linear-progress :value="progress" color="warning" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        SOPRALLUOGHI <q-icon name="info" @click="getwbs(2); " />
      </div>
      <q-linear-progress :value="progress" color="secondary" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        RESTITUZIONE GRAFICA<q-icon name="info" @click="getwbs(3); "  />
      </div>
      <q-linear-progress :value="progress" color="accent" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        MODELLAZIONE ENERGETICA <q-icon name="info" @click="getwbs(4); " />
      </div>
      <q-linear-progress :value="progress" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        COMPUTO <q-icon name="info" @click="getwbs(5); "/>
      </div>
      <q-linear-progress :value="progress" color="warning" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        STUDIO FATTIBILITA' <q-icon name="info"  @click="getwbs(6); " />
      </div>
      <q-linear-progress :value="progress" color="secondary" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        PROGETTO DEFINITIVO<q-icon name="info"  @click="getwbs(7); " />
      </div>
      <q-linear-progress :value="progress" color="accent" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        PROGETTO ESECUTIVO <q-icon name="info"  @click="getwbs(8); " />
      </div>
      <q-linear-progress :value="progress" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        ESECUZIONE OPERA<q-icon name="info"  @click="getwbs(9); " />
      </div>
      <q-linear-progress :value="progress" color="accent" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        COLLAUDI E ASSEVERAZIONI <q-icon name="info"  @click="getwbs(10); " />
      </div>
      <q-linear-progress :value="progress" />
    </div>

    <!-- 
        <div class="row q-col-gutter-md">
            <div class="col-1">Attività</div>
            <div class="col-1">Descrizione</div>
            <div class="col-1">Assegnato A</div>
            <div class="col-1">STATO</div>
            <div class="col-1">PRIORITà</div>
            <div class="col-1">SCADENZA</div>
            <div class="col-1">COMPLETAMENTO</div>
            <div class="col-1">INIZIO</div>
            <div class="col-1">FINE</div>
            <div class="col-1">DURATA</div>
        </div>
        <div class="row q-col-gutter-md">
            <div class="col-1">Acquisizione DOC</div>
            <div class="col-1">Descrizione</div>
            <div class="col-1">Nome Cognome Assegnato</div>
            <div class="col-1"><q-select 
                v-model="stato"
                type="checkbox"
                color="secondary"
                filled :dense='true' label="Seleziona..."
                :options="optionstatoWbs"
            /></div>
            <div class="col-1"><q-select 
                v-model="priorita"
                type="checkbox"
                color="secondary"
                filled 
                :dense='true' label="seleziona..."
                :options="optionPriorita"
            /></div>
            <div class="col-1">
               <q-input v-model="text" type="text" label="Scadenza" /></div>
            <div class="col-1"> <q-input v-model="text" type="text" label="Completamento" /></div>
            <div class="col-1"> <q-linear-progress :value="progress" class="q-mt-md" /></div>
            <div class="col-1"> <q-input v-model="text" type="text" label="Inizio" /></div>
            <div class="col-1"> <q-input v-model="text" type="text" label="Fine" /></div>
            <div class="col-1"> <q-input v-model="text" type="text" label="Durata" /></div>
        </div>
        <div class="row q-col-gutter-md">
            <div class="col-4">
                 <q-card class="my-card" flat bordered>
      <q-card-section horizontal>
        <q-card-section class="q-pt-xs">
            <div class="text-overline"> <q-linear-progress :value="progress" class="q-mt-md" /></div>
           <div class="text-h5 q-mt-sm q-mb-xs">Acquisizione DOC</div>
         
          <div class="text-caption text-grey">
              <q-input v-model="text" type="textarea" label="Descrizione"  />
              </div>
        </q-card-section>

        <q-card-section class="col-5 flex flex-center">
         <q-input v-model="text" type="text" label="Assegnato A:" :dense='true' outlined />
         <q-select 
                v-model="stato"
                type="checkbox"
                color="secondary"
                outlined :dense='true' label="Stato"
                :options="optionstatoWbs"
                style="width:100%"
            />
            <q-select 
                v-model="priorita"
                type="checkbox"
                color="secondary"
                filled 
                :dense='true' label="Priorita"
                :options="optionPriorita"
                style="width:100%"
            />
             <div >
      <label>Scadenza</label>
     <q-input  outlined :dense="true"  v-model="text" mask="date" :rules="['date']">
      <template v-slot:append>
        <q-icon name="event" class="cursor-pointer">
          <q-popup-proxy ref="qDateProxy" transition-show="scale" transition-hide="scale">
            <q-date v-model="text">
              <div class="row items-center justify-end">
                <q-btn v-close-popup label="Close" color="primary" flat />
              </div>
            </q-date>
          </q-popup-proxy>
        </q-icon>
      </template>
    </q-input>
    </div>
      
        </q-card-section>
        
      </q-card-section>

      <q-separator />

      <q-card-actions>
      
       
      
      </q-card-actions>
      <q-card-actions>
     <q-input v-model="text" type="text" outlined :dense="true" label="Inizio" />
      <q-input v-model="text" type="text" outlined :dense="true"  label="fine" />
       <q-input v-model="text" type="text" outlined :dense="true"  label="Durata" />
      </q-card-actions>
    </q-card>
        </div>
            <div class="col-4">
                 <q-card class="my-card" flat bordered>
      <q-card-section horizontal>
        <q-card-section class="q-pt-xs">
            <div class="text-overline"> <q-linear-progress :value="progress" class="q-mt-md" /></div>
           <div class="text-h5 q-mt-sm q-mb-xs">SOPRALLUOGHI</div>
         
          <div class="text-caption text-grey">
              <q-input v-model="text" type="textarea" label="Descrizione"  />
              </div>
        </q-card-section>

        <q-card-section class="col-5 flex flex-center">
         <q-input v-model="text" type="text" label="Assegnato A:" :dense='true' outlined />
         <q-select 
                v-model="stato"
                type="checkbox"
                color="secondary"
                outlined :dense='true' label="Stato"
                :options="optionstatoWbs"
                style="width:100%"
            />
            <q-select 
                v-model="priorita"
                type="checkbox"
                color="secondary"
                filled 
                :dense='true' label="Priorita"
                :options="optionPriorita"
                style="width:100%"
            />
        </q-card-section>
        
      </q-card-section>

      <q-separator />

      <q-card-actions>
        <q-btn flat round icon="event" />
       <q-input v-model="text" type="text" label="Scadenza" />
      
      </q-card-actions>
      <q-card-actions>
     <q-input v-model="text" type="text" outlined :dense="true" label="Inizio" />
      <q-input v-model="text" type="text" outlined :dense="true"  label="fine" />
       <q-input v-model="text" type="text" outlined :dense="true"  label="Durata" />
      </q-card-actions>
    </q-card>
        </div>
        </div>
        -->

    <q-dialog v-model="alert">
      <q-card style="width: 50%">
        <q-card-section>
          <div class="text-h6">Acquisizione DOC</div>
        </q-card-section>

        <q-card-section class="q-pt-none">
          <q-input v-model="descrizione" type="textarea" label="Descrizione" />
          <q-input
            v-model="assegnatoA"
            type="text"
            label="Assegnato A:"
            :dense="true"
            outlined
          />
          <q-select
            v-model="stato"
            type="checkbox"
            color="secondary"
            outlined
            :dense="true"
            label="Stato"
            :options="optionstatoWbs"
            style="width: 100%"
          />
          <q-select
            v-model="priorita"
            type="checkbox"
            color="secondary"
            filled
            :dense="true"
            label="Priorita"
            :options="optionPriorita"
            style="width: 100%"
          />
          <q-input v-model="scadenza" type="text" label="Scadenza" />
          <q-input
            v-model="inizio"
            type="text"
            outlined
            :dense="true"
            label="Inizio"
          />
          <q-input
            v-model="fine"
            type="text"
            outlined
            :dense="true"
            label="fine"
          />
          <q-input
            v-model="durata"
            type="text"
            outlined
            :dense="true"
            label="Durata"
          />
        </q-card-section>

        <q-card-actions align="right">
          <q-btn flat label="Chiudi" color="primary" v-close-popup />
          <q-btn
            flat
            label="Salva"
            color="primary"
            
            @click="saveWbs(idModalWbs,tipowbs)"
          />
        </q-card-actions>
      </q-card>
    </q-dialog>
  </div>
</template>

<script>
import Axios from "axios";
export default {
  data() {
    return {
      optionstatoWbs: [
        { label: "Non Iniziato", value: "non iniziato" },
        { label: "in corso", value: "in corso" },
        { label: "completato", value: "completato" },
        { label: "scaduto", value: "scaduto" },
        { label: "in attesa", value: "in attesa" },
      ],
      optionPriorita: [
        { label: "Alto", value: "alto" },
        { label: "Medio", value: "medio" },
        { label: "Basso", value: "basso" },
      ],

      progress: 0.5,
      date: "",
      text: "",
      descrizione: "",
      assegnatoA: "",
      stato: "",
      priorita: "",
      scadenza: "",
      inizio: "",
      fine: "",
      durata: "",
      alert: false,
      idModalWbs: "",
      tipowbs:"",
    };
  },  props:["value"],
  methods: {
    getwbs(tipowbs) {
      this.tipowbs=tipowbs;
      this.alert = true;
      Axios.get(
        this.linkApi + "/getidwbs/?id_progetto=221&tipo_wbs=" + tipowbs
      ).then((Response) => {
        var wbs = Response.data;
        
        this.descrizione="Vuoto";
      if (wbs.response=="ok"){
        this.descrizione = wbs.message[0].descrizione;
        this.assegnatoA = wbs.message[0].persona_assegnata;
        this.stato = wbs.message[0].stato;
        this.priorita = wbs.message[0].priorita;
        this.inizio = wbs.message[0].inizio;
        this.fine = wbs.message[0].fine;
        }
      });
    },
    saveWbs(tipo) {
      const updateWbs = {
        descrizione: this.descrizione,
        assegnato: this.assegnatoA,
        stato: this.stato,
        priorita: this.priorita,
        inizio: this.inizio,
        fine: this.fine,

        id_progetto:this.value.idprogetto,
        tipowbs:tipo
      };
      Axios.post(this.linkApi + "/salvaIdWbs", updateWbs).then((Response) => { 
        var risposta = Response.data;
        console.log(risposta.response)
        if (risposta.response =="ok"){
            this.$q.notify({
                        type: 'positive',
                        message:risposta.message,
                        }); 
        }
        if (risposta.response =="Error"){
           this.$q.notify({
                        type: 'negative',
                        message:risposta.message,
                        }); 
        }
        
       console.log(Response.data)});
     
    },
  },
};
</script>