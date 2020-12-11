<template>
    <q-dialog persistent>
        <q-card>
  <q-card-section class="row items-center">
      {{messaggio}}
  </q-card-section>
  <q-card-actions align="right">
      <q-btn flat label="ok" color="primary" v-close-popup />
    
    </q-card-actions>
        </q-card>
    </q-dialog>
</template>
<script>
export default {
   
  props: ['messaggio'],
}
</script>