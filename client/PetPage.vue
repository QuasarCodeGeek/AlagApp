<template>
  <ion-app>
    <ion-header :translucent="true">
      <ion-toolbar color="success">
         <ion-buttons slot="start">
         <ion-back-button defaultHref = "/home/"></ion-back-button>
         </ion-buttons>
       <ion-title v-model="petname"></ion-title>
      </ion-toolbar>
    </ion-header>
    
    <ion-content>
      <div v-for="card in cardList" :key="card.cid">
        <ion-card>
          <ion-card-header color="success">
            <ion-card-title>{{ card.vaxname}}</ion-card-title>
          </ion-card-header>
          <ion-card-content>
            <ion-item>
              <ion-label>First Dose: {{card.fdose}}</ion-label>
            </ion-item>
            <ion-item>
              <ion-label>Second Dose: {{card.sdose}}</ion-label>
            </ion-item>
            <ion-item>
              <ion-label>Booster: {{card.booster}}</ion-label>
            </ion-item>
          </ion-card-content>
        </ion-card>
      </div>
      <ion-card>
          <ion-card-content color="success" style="text-align: center;">
            <ion-label>No Records</ion-label>
          </ion-card-content>
        </ion-card>
    </ion-content>
  </ion-app>
</template>

<script lang="ts">
import {  IonCard, IonCardContent, IonCardHeader, IonCardTitle, IonHeader, IonApp,  IonToolbar, IonContent, IonButtons,IonBackButton} from '@ionic/vue';
import { defineComponent } from 'vue';  
import { useRoute } from 'vue-router';
import axios from 'axios';

export default defineComponent({
  components: {
    IonHeader,
    IonApp,
    IonToolbar,
    IonContent,
    IonButtons,
    IonBackButton,
    IonCard,
    IonCardContent,
    IonCardHeader,
    IonCardTitle
  }, setup () {
    const route = useRoute();        
    const petid = route.params.petid;
    
    return {
      petid
    }
  }, data () {
    return {
      cardList: []
    }
  }, mounted () {
    this.viewCard();
  }, methods: {
    viewCard() {
        axios.post("http://localhost/_alagapp/_cardlist.php", null, {params: {
              "petid":this.petid
          }})
      .then((response)=>{
        this.cardList = response.data;
        console.log(response.data);
      })
      .catch(function(error){
        alert(error);
      });
    }
  }
});
</script>

<style scoped>
ion-app, ion-menu {
  --ion-background-color: #C8E6C9;
}

ion-card {
  --ion-background-color: #E8F5E9;
}

</style>
