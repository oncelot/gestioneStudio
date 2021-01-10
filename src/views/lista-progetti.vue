<template>
    <div class="q-pa-md" style="color:grey">
        <div class="row">
            <div class="col" style="text-align:center"> <h5 class="text-primary">Progetti</h5>
            </div>
        </div>
        <div class="row justify-center">
            <div class="col-3 bgAree" >
                <label for=""><strong>Cerca</strong></label>
                <q-input v-model="cercaprogetto" type="text" :dense="true" outlined placeholder="nome progetto" style="padding-bottom:10px"  />
            </div>
        </div>
        
<div class="row justify-center"><div class="col-3">
      <div class="row" v-for="item in progettiFilter" :key="item.message"  style="border-bottom:1px solid black">
           <div class="col-2">{{item.id}}</div>
            <div class="col-10">
            <span  style="font-weight:bold; cursor:pointer; text-decoration-line: underline;"  @click="redirectProgetto(item.id)" >
            {{item.titolo_progetto}}</span>
            </div>
            
            

        </div>
    </div></div>
      


    </div>

</template>
<script>
import Axios from 'axios'
export default {
    data(){
        return{
            elencoProgetti:[],
            cercaprogetto:'',
        }
    },
    beforeMount: function() {
        Axios.get(this.linkApi+'/getProgetti').then(Response =>(this.elencoProgetti=Response.data));
  
  },
methods:{
      redirectProgetto(idprogetto){
          this.$router.push({ path:'dettaglio-progetto/'+idprogetto});
          }
    },
    computed:{
        progettiFilter:function(){
            return this.elencoProgetti.filter(post=>{
                return post.titolo_progetto.toLowerCase().includes(this.cercaprogetto.toLowerCase())
            })
        }

    }
}
</script>
