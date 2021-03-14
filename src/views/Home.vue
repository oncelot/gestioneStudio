<template>
<div>
    <button @click="test321()">proba</button>
</div>
</template>
<script>
const Dropbox = require("dropbox").Dropbox;
export default {
    data(){
          return {
              test:"sl.AsmkdalS8olIgcXeAJYBwRYP3x1tvENhPrA-QKo1ky1_4CcpZAPgCvHrZ3Px9JWcw2XPc8lxIIKFuf4A56G7lXRD6YzU2tPhQ6es4riYbzZzswY9jTHU9rC6vsm6OUl89QEjRlA",
          apikey:"ogdhen8zm9emvmy",
          }},
          methods:{
              test321(){ 
                  
                     const dbx = new Dropbox({accessToken:this.test});
                   
             
     dbx.filesListFolder({path:''}).then(response => {
          console.log('response', response)
         
        })
        .catch(error=> {
          console.error(error);
        });
        
        return 'coap';
             }
             },
          mounted() {

              /* let dropBox = document.createElement("script");
    dropBox.setAttribute(
      "src",
      "https://www.dropbox.com/static/api/2/dropins.js"
    );
    dropBox.setAttribute("id", "dropboxjs");
    dropBox.appendChild("testo ciao");
    dropBox.innerHTML("cia come");
    dropBox.setAttribute("data-app-key", this.apikey);
    document.head.appendChild(dropBox);*/
   
               
        
          },

        }

    </script>