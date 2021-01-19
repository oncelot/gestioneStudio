<template>
<div>
    <div class="row justify-center">
              <div class=" text-h4 text-center text-secondary"><span class="text-secondary"> Dettagli Progetto</span></div>
          </div>
       
    <div class="row  justify-center"  >
        <div class=" col-12 col-md-7 bgmargintop">
            <q-input outlined v-bind:value="value" @input="test"  label="Titolo del progetto" />

        </div>
    </div> 
</div>
</template>
<script>





export default {
    data(){return {

    } },

props:["value"],
methods:{
test(e){
    this.$emit('input',e);
}
}

}
</script>