<template>
  <div class="q-gutter-sm">
    <div class="row">
      <span class="text-h6 text-secondary">Quote</span>
    </div>
    <div class="row">
      <div class="col-8 col-md-3">
        <label for="" class="font-weigth:bold">Quota Preventivo</label>
        <q-input
          v-model="value.quotaPreventivo"
          :dense="true"
          outlined
          type="number"
        />
      </div>
      <!--
  <div class="col-2 col-md-2"> 
    <label for="" class="text-bold"> Allega Preventivo Firmato</label>
    <input type="file" @change="handleFilePreventivo">
      <a href="#"  v-if="!value.nuovoProgetto" @click="downloadFile(idprogetto+'/'+value.nameAuxFilePreventivo,value.nameAuxFilePreventivo)" >{{value.nameAuxFilePreventivo}}</a>
   
   <q-file
      v-model="quoteAllegatoPreventivo"
      label="Carica file"
      outlined
      :dense="true"
      style="max-width: 300px" /> 
      </div>-->
    </div>
    <div class="row">
      <div class="col-2">
        Da Incassare<br />
        <q-circular-progress
          show-value
          class="text-light-blue q-ma-md"
          :value="percentualeDaIncassare"
          size="50px"
          color="red"
          >{{ daIncassare }}</q-circular-progress
        >
      </div>
      <div class="col-2">
        Incassato<br />
        <q-circular-progress
          show-value
          class="text-light-blue q-ma-md"
          :value="percentualeIncassato"
          size="50px"
          color="green"
          >{{ incassato }}</q-circular-progress
        >
      </div>
      <div class="col-2">
        Speso<br />
        <q-circular-progress
          show-value
          class="text-light-blue q-ma-md"
          :value="percentualeSpeso"
          size="50px"
          color="orange"
          >{{ speso }}</q-circular-progress
        >
      </div>
    </div>

    <div class="bgAree" style="margin-top: 20px">
      <div class="row">
        <div class="col">
          <span class="text-h6 text-secondary">Acconti Ricevuti</span>
        </div>
      </div>

      <div class="row q-gutter-sm" style="padding-top: 20px">
        <div class="col-6 col-md-2">
          <label class="text-bold">Data</label>
          <q-input
            outlined
            :dense="true"
            v-model="dataAcconto"
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
        <div class="col-6 col-md-2">
          <label for="" class="text-bold">Importo</label>
          <q-input
            v-model="quotaImportoAcconto"
            outlined
            :dense="true"
            type="number"
          />
        </div>

        <div class="col-6 col-md-3">
          <label for="" class="text-bold">Modalità di pagamento</label>

          <q-select
            v-model="quotaAccontoModalitaPagamento"
            :options="elencoMetodoPagamenti"
            outlined
            :dense="true"
          />
        </div>
        <div class="col-6 col-md-3">
          <label for="" class="text-bold">Chi ha fatturato</label>
          <q-input
            v-model="quoteChiFattura"
            type="text"
            outlined
            :dense="true"
          />
        </div>

        <div class="col-2 col-md-1">
          <q-btn
            icon="add"
            style="margin-top: 25px"
            color="primary"
            @click="addrowQuoteAcconti()"
            outline
            :dense="true"
          />
        </div>
      </div>
      <div v-if="value.elencoQuote.length > 0">
      <div class="row bgAree">
        <div class="col text-bold">Quota</div>
        <div class="col text-bold">Importo</div>
        <div class="col text-bold">Metodo di Pagamento</div>
        <div class="col text-bold">Chi Fatturato</div>
        <div class="col text-bold"></div>
      </div>

      <div
        class="row bgAree"
        v-for="(quota, index) in value.elencoQuote"
        :key="quota.quota"
      >
        <div class="col">{{ quota.dataPagamento }}</div>
        <div class="col">{{ quota.importo }}</div>
        <div class="col">{{ quota.metodoPagamento }}</div>
        <div class="col">{{ quota.chiFatturato }}</div>
        <div class="col">
          <q-btn
            size="sm"
            round
            icon="delete"
            @click="value.elencoQuote.splice(index, 1)"
          />
        </div>
      </div>
      </div>
    </div>

    <div class="bgAree" style="margin-top: 20px">
      <div class="row">
        <div class="col">
          <span class="text-h6 text-secondary">Spese Effettuate</span>
        </div>
      </div>

      <div class="row q-gutter-sm" style="padding-top: 20px">
        <div class="col-6 col-md-2">
          <label class="text-bold">Data</label>
          <q-input
            outlined
            :dense="true"
            v-model="dataSpesaEffettuata"
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

        <div class="col-6 col-md-2">
          <label for="" class="text-bold">Importo</label>
          <q-input
            v-model="importoSpesaEffettuata"
            outlined
            :dense="true"
            type="number"
          />
        </div>

        <div class="col-6 col-md-2">
          <label for="" class="text-bold">Causale</label>
          <q-input
            v-model="causaleSpesaEffettuata"
            outlined
            :dense="true"
            type="text"
          />
        </div>
        <div class="col-6 col-md-3">
          <label for="" class="text-bold">Chi ha Pagato</label>
          <q-input
            v-model="chiHafattoSpesa"
            type="text"
            outlined
            :dense="true"
          />
        </div>

        <div class="col-6 col-md-1">
          <q-btn
            icon="add"
            style="margin-top: 25px"
            color="primary"
            @click="addrowQuoteSpese()"
            outline
            :dense="true"
          />
        </div>
   
      </div>
     
      <div v-if="value.elencoSpese.length > 0">
        <div class="row bgAree">
          <div class="col text-bold">Quota</div>
          <div class="col text-bold">Importo</div>
          <div class="col text-bold">Causale</div>
          <div class="col text-bold">Chi ha pagato</div>
          <div class="col text-bold"></div>
        </div>
        <div
          class="row bgAree"
          v-for="(quota, index) in value.elencoSpese"
          :key="quota.dataPagamento"
        >
          <div class="col">{{ quota.dataPagamento }}</div>
          <div class="col">{{ quota.importo }}</div>
          <div class="col">{{ quota.causale }}</div>
          <div class="col">{{ quota.chiHapagato }}</div>
          <div class="col">
            <q-btn
              size="sm"
              round
              icon="delete"
              @click="value.elencoSpese.splice(index, 1)"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Axios from "axios";

export default {
  data() {
    return {
      dataAcconto: "",
      quotaImportoAcconto: "",
      quotaAccontoModalitaPagamento: "",
      quoteChiFattura: "",
      dataSpesaEffettuata: "",
      importoSpesaEffettuata: "",
      causaleSpesaEffettuata: "",
      chiHafattoSpesa: "",
      nameAuxFilePreventivo: "",

      totaleQuoteRicevute: 0,
      totaleSpeseEffettuate: 0,

      percentualeIncassato: 0,
      percentualeSpeso: 0,
      percentualeDaIncassare: 0,

      elencoMetodoPagamenti: [
        { value: "c/c", label: "Conto corrente" },
        { value: "carta", label: "Carta" },
        { value: "carta2", label: "Carta C" },
      ],
    };
  },
  props: ["value"],
  methods: {
    downloadFile(path, titoloFile) {
      Axios({
        url: this.linkApi + "/download/?pp=" + path,
        method: "get",
        responseType: "arraybuffer",
      }).then((response) => {
        console.log(response);
        if (response.data.byteLength > 2) {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement("a");
          link.href = url;
          link.setAttribute("download", titoloFile);
          document.body.appendChild(link);
          link.click();
        } else {
          alert("Errore file non esistente");
        }
      });
    },

    handleFilePreventivo(e) {
      this.value.nameAuxFilePreventivo = e.target.files[0].name;
      const selectImage = e.target.files[0];
      this.createBase64Preventivo(selectImage);
    },

    createBase64Preventivo(fileObject) {
      const reader = new FileReader();
      reader.onload = (e) => {
        var aux = e.target.result;
        var base64string = window.btoa(aux);
        this.value.base64AllegatoPreventivo = base64string;
      };
      this.value.base64AllegatoPreventivo = reader.readAsBinaryString(
        fileObject
      );

      //return output;
    },
    addrowQuoteAcconti() {
      this.value.elencoQuote.push({
        dataPagamento: this.dataAcconto,
        importo: this.quotaImportoAcconto,
        metodoPagamento: this.quotaAccontoModalitaPagamento.value,
        chiFatturato: this.quoteChiFattura,
        tipo_quota: "entrata",
      });
    },
    addrowQuoteSpese() {
      this.value.elencoSpese.push({
        dataPagamento: this.dataSpesaEffettuata,
        importo: this.importoSpesaEffettuata,
        causale: this.causaleSpesaEffettuata,
        chiHapagato: this.chiHafattoSpesa,
        tipo_quota: "uscita",
      });
    },
  },
  computed: {
    incassato: function () {
      console.log("ew");
      var somma = 0;
      this.value.elencoQuote.forEach((element) => {
        somma += parseInt(element.importo);
      });

      return somma;
    },
    speso: function () {
      var somma = 0;
      this.value.elencoSpese.forEach((element) => {
        somma += parseInt(element.importo);
      });

      return somma;
    },
    daIncassare: function () {
      var somma = 0;
      this.value.elencoQuote.forEach((element) => {
        somma += parseInt(element.importo);
      });

      return this.value.quotaPreventivo - somma;
    },
  },
  watch: {
    incassato: {
      deep: true,
      handler: function () {
        if (parseInt(this.value.quotaPreventivo) > 0) {
          this.percentualeIncassato =
            (this.incassato / parseInt(this.value.quotaPreventivo)) * 100;
        }
      },
    },

    speso: {
      deep: true,
      handler: function () {
        if (parseInt(this.value.quotaPreventivo) > 0) {
          this.percentualeSpeso =
            100 - ((this.incassato - this.speso) / this.incassatoo) * 100;
        }
      },
    },
    daIncassare: {
      deep: true,
      handler: function () {
        if (parseInt(this.value.quotaPreventivo) > 0) {
          var percentulaTotale =
            ((this.value.quotaPreventivo - this.incassato) /
              this.value.quotaPreventivo) *
            100;
          //var percentuale=100-(parseFloat(this.value.quotaPreventivo) *  incassato)/100 ;
          this.percentualeDaIncassare = percentulaTotale;
        }
      },
    },
  },

  mounted: function () {
    console.log("test");
    var incassato = 0;
    var speso = 0;
    this.value.elencoQuote.forEach((element) => {
      incassato += parseInt(element.importo);
    });
    this.totaleQuoteRicevute = incassato;
    this.value.elencoSpese.forEach((element) => {
      speso += parseInt(element.importo);
    });
    this.totaleSpeseEffettuate = speso;
    if (parseInt(this.value.quotaPreventivo) > 0) {
      this.percentualeIncassato =
        100 -
        ((this.value.quotaPreventivo - incassato) /
          this.value.quotaPreventivo) *
          100;

      this.percentualeSpeso =
        100 - ((this.incassato - this.speso) / this.incassato) * 100;

      this.percentualeDaIncassare =
        ((this.value.quotaPreventivo - incassato) /
          this.value.quotaPreventivo) *
        100;
    }
  },
};
</script>