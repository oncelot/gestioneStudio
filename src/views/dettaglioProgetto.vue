<template>
<div class="row">
     {{ $route.params.id }}
     <formProgetto v-bind:idprogetto=$route.params.id ></formProgetto>
</div>
    
        
</template>
<script>
import formProgetto from '@/components/Progetto'
export default {
components:{formProgetto}


}
</script>