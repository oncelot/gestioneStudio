<template>
  <div>
    <div id="container">
     
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        Acquisizione DOC <q-icon name="info" @click="getwbs(1)" />
      </div>
      <q-linear-progress :value="progress1" color="warning" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        SOPRALLUOGHI <q-icon name="info" @click="getwbs(2)" />
      </div>
      <q-linear-progress :value="progress2" color="secondary" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        RESTITUZIONE GRAFICA<q-icon name="info" @click="getwbs(3)" />
      </div>
      <q-linear-progress :value="progress3" color="accent" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        MODELLAZIONE ENERGETICA <q-icon name="info" @click="getwbs(4)" />
      </div>
      <q-linear-progress :value="progress4" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        COMPUTO <q-icon name="info" @click="getwbs(5)" />
      </div>
      <q-linear-progress :value="progress5" color="warning" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        STUDIO FATTIBILITA' <q-icon name="info" @click="getwbs(6)" />
      </div>
      <q-linear-progress :value="progress6" color="secondary" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        PROGETTO DEFINITIVO<q-icon name="info" @click="getwbs(7)" />
      </div>
      <q-linear-progress :value="progress7" color="accent" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        PROGETTO ESECUTIVO <q-icon name="info" @click="getwbs(8)" />
      </div>
      <q-linear-progress :value="progress8" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        ESECUZIONE OPERA<q-icon name="info" @click="getwbs(9)" />
      </div>
      <q-linear-progress :value="progress9" color="accent" />
    </div>
    <div class="row">
      <div class="text-h6 q-mt-sm q-mb-xs">
        COLLAUDI E ASSEVERAZIONI <q-icon name="info" @click="getwbs(10)" />
      </div>
      <q-linear-progress :value="progress10" />
    </div>

    
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
            outlined
            :dense="true"
            v-model="inizio"
            mask="date"
            :rules="['date']"
          >
            <template v-slot:append>
              <q-icon name="event" class="cursor-pointer">
                <q-popup-proxy
                  ref="qDateProxy"
                  transition-show="scale"
                  transition-hide="scale"
                >
                  <q-date v-model="inizio">
                    <div class="row items-center justify-end">
                      <q-btn v-close-popup label="Close" color="primary" flat />
                    </div>
                  </q-date>
                </q-popup-proxy>
              </q-icon>
            </template>
          </q-input>
          <q-input
            outlined
            :dense="true"
            v-model="fine"
            mask="date"
            :rules="['date']"
          >
            <template v-slot:append>
              <q-icon name="event" class="cursor-pointer">
                <q-popup-proxy
                  ref="qDateProxy"
                  transition-show="scale"
                  transition-hide="scale"
                >
                  <q-date v-model="fine">
                    <div class="row items-center justify-end">
                      <q-btn v-close-popup label="Close" color="primary" flat />
                    </div>
                  </q-date>
                </q-popup-proxy>
              </q-icon>
            </template>
          </q-input>

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
            @click="saveWbs(tipowbs)"
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

      
      progress1:0,
      progress2:0,
      progress3:0,
      progress4:0,
      progress5:0,
      progress6:0,
      progress7:0,
      progress8:0,
      progress9:0,
      progress10:0,
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
      tipowbs: "",
    };
  },
  props: ["value"],
  computed:{

  },
  mounted:function(){
this.calcoloProgessivoSingoloWbs();

  },
  methods: {
        calcoloProgessivoSingoloWbs:function(){
Axios.get(this.linkApi+"/getProgressivoWbs?idprogetto="+this.value.idprogetto+"").then(
  response=>{var progressivi=response.data;
  var differenzeTime=0;
  var differenzaDay=0;
  var differenzaDayOggi=0;
  var percentuale=0;
var today = new Date();
  progressivi.forEach(element => {
    console.log(element);
    var date1 = new Date(element.inizio); 
    var date2 = new Date(element.fine); 
  //  alert(date1);
   // alert(date2);

      differenzeTime= date1.getTime() - date2.getTime();
     // alert(differenzeTime);
      differenzaDay=differenzeTime / (1000 * 3600 * 24); 
      differenzeTime=date1.getTime() - today;
      differenzaDayOggi=differenzeTime  / (1000 * 3600 * 24);
      percentuale = differenzaDayOggi / differenzaDay;
     
    if(element.tipo=="1"){this.progress1=percentuale;  }
    if(element.tipo=="2"){this.progress2=percentuale;  }
    if(element.tipo=="3"){this.progress3=percentuale;  }
    if(element.tipo=="4"){this.progress4=percentuale;  }
    if(element.tipo=="5"){this.progress5=percentuale;  }
    if(element.tipo=="6"){this.progress6=percentuale;  }
    if(element.tipo=="7"){this.progress7=percentuale;  }
    if(element.tipo=="8"){this.progress8=percentuale;  }
    if(element.tipo=="9"){this.progress9=percentuale;  }
    if(element.tipo=="10"){this.progress10=percentuale;  }
  });  });
  
    },
    getwbs(tipowbs) {
      this.tipowbs = tipowbs;
      this.alert = true;
      Axios.get(
        this.linkApi + "/getidwbs/?id_progetto="+this.value.idprogetto+"&tipo_wbs=" + tipowbs
      ).then((Response) => {
        var wbs = Response.data;

        this.descrizione = "Vuoto";
        if (wbs.response == "ok") {
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
        id_progetto: this.value.idprogetto,
        tipowbs: tipo,
      };

      Axios.post(this.linkApi + "/salvaIdWbs", updateWbs).then((Response) => {
        var risposta = Response.data;
        console.log(risposta.response);
        if (risposta.response == "ok") {
          this.$q.notify({
            type: "positive",
            message: risposta.message,
          });
        }
        if (risposta.response == "Error") {
          this.$q.notify({
            type: "negative",
            message: risposta.message,
          });
        }

        console.log(Response.data);
      });
      this.calcoloProgessivoSingoloWbs();
    },
  },
};
</script>