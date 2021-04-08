<template>
  <div class="q-pa-md" style="color: grey">
    <div class="row">
      <div class="col" style="text-align: center">
        <h5 class="text-primary">Progetti</h5>
      </div>
    </div>
    <div class="row justify-center">
      <div class="col-10 col-md-3 bgAree">
        <label for=""><strong>Cerca</strong></label>
        <q-input
          v-model="cercaprogetto"
          type="text"
          :dense="true"
          outlined
          placeholder="nome progetto"
          style="padding-bottom: 10px"
        />
      </div>
    </div>

    <div class="row justify-center">
      <div class="col-10 col-md-5">
        <div class="row">
          <div class="col">ID</div>
          <div class="col">COMMESSA</div>
          <div class="col">TITOLO</div>

          <div class="col">AUTORIZZATI</div>
        </div>
        <div
          class="row"
          v-for="item in progettiFilter"
          :key="item.message"
          style="border-bottom: 1px solid black"
        >
          <div class="col">{{ item.id }}</div>
           <div class="col">{{ item.codice_commessa }}</div>
          <div class="col">
            <span
              style="
                font-weight: bold;
                cursor: pointer;
                text-decoration-line: underline;
              "
              @click="redirectProgetto(item.id)"
            >
              {{ item.titolo_progetto }}</span
            >
            {{ testo }}
          </div>
         
          <div class="col">
            <div v-for="item2 in item.elencoAutorizzati" :key="item2.name">
              {{ item2.name }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Axios from "axios";
import { mapGetters } from "vuex";
export default {
  data() {
    return {
      elencoProgetti: [],
      cercaprogetto: "",
      testo: "",
    };
  },
  mounted: function () {
    Axios.post(this.linkApi + "/getProgetti", {
      params: { id: this.user.id, role: this.user.role },
    }).then((Response) => {
      console.log(Response.data);
      this.elencoProgetti = Response.data;

      if (this.elencoProgetti.length == 0) {
        this.elencoProgetti = [];
        this.testo = "non hai progetti associati";
      } else {
        this.testo = "";
      }
    });
  },
  methods: {
    redirectProgetto(idprogetto) {
      this.$router.push({ path: "dettaglio-progetto/" + idprogetto });
    },
  },
  computed: {
    progettiFilter: function () {
      return this.elencoProgetti.filter((post) => {
        return post.titolo_progetto
          .toLowerCase()
          .includes(this.cercaprogetto.toLowerCase());
      });
    },
    ...mapGetters({
      isAuth: "GET_AUTH",
      user: "GET_AUTH_USER",
    }),
  },
};
</script>
