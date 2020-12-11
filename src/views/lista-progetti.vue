<template>
    <div class="q-pa-md">
        <div class="row">
            <div class="col">
<h6>lista progetti</h6>

            </div>
        </div>
        <div class="row" v-for="item in elencoProgetti" :key="item.message"  style="border-bottom:1px solid black">
            <div class="col-12">{{item.titolo_progetto}}</div>
            

        </div>


    </div>

</template>
<script>
import Axios from 'axios'
export default {
    data(){
        return{
            elencoProgetti:[]
        }
    },
    beforeMount: function() {
        Axios.get(this.linkApi+'/getProgetti').then(Response =>(this.elencoProgetti=Response.data));
  
  },
}
</script>
