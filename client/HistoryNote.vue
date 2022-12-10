<template>
  <ion-app>
    <ion-header :translucent="true" >
      <ion-toolbar color="success">
        <ion-buttons slot="start" v-for="pet in petProfile" :key="pet.petid">
          <ion-back-button :defaultHref = "/home/+pet.userid"></ion-back-button>
        </ion-buttons>
      <ion-title>E-Prescription Note</ion-title>
      </ion-toolbar>
    </ion-header>
    
    <ion-content>
      <ion-card v-for="pet in petProfile" :key="pet.petid">
        <img v-if="pet.pettype == 'Dog' " alt="pet" :src="dog" />
        <img v-else-if="pet.pettype == 'Cat' " alt="pet" :src="cat" />
        <img v-else-if="pet.pettype == 'Bird' " alt="pet" :src="bird" />
        <img v-else-if="pet.pettype == 'Mouse' " alt="pet" :src="mouse" />
        <ion-card-content>
          <ion-grid>
            <ion-row>
              <ion-col>
                  <ion-label>Name: {{pet.petname}}</ion-label>
              </ion-col>
              <ion-col>
                  <ion-label>Gender: {{pet.petgender}}</ion-label>
              </ion-col>
            </ion-row>
            <ion-row>
              <ion-col>
                  <ion-label>Type: {{pet.pettype}}</ion-label>
              </ion-col>
              <ion-col>
                  <ion-label>Breed: {{pet.petbreed}}</ion-label>
              </ion-col>
            </ion-row>
            <ion-row>
              <ion-col>
                  <ion-label>Weight: {{pet.petweight}}</ion-label>
              </ion-col>
              <ion-col>
                  <ion-label>Height: {{pet.petheight}}</ion-label>
              </ion-col>
            </ion-row>
            <ion-row>
              <ion-col>
                  <ion-label>DOB: {{pet.petbdate}}</ion-label>
              </ion-col>
              <ion-col>
                  <ion-label>Age: {{pet.petage}}</ion-label>
              </ion-col>
            </ion-row>
          </ion-grid>
        </ion-card-content>
      </ion-card>

      <div v-for="note in noteList" :key="note.nid">
        <ion-card>
          <ion-card-content>
            <ion-grid>
              <ion-row>
                <ion-label>Description:</ion-label>
              </ion-row>
              <ion-row>
                <p>{{note.ndescription}}</p>
              </ion-row><br>
              <ion-row>
                <ion-label>Date Issued: {{note.ndate}}</ion-label>
              </ion-row>
              <ion-row>
                <ion-label>Status: {{note.nstatus}}</ion-label>
              </ion-row>
            </ion-grid>
          </ion-card-content>
        </ion-card>
      </div>
      <ion-card>
        <ion-card-content color="success" style="text-align: center;">
          <ion-label>No Records</ion-label>
        </ion-card-content>
      </ion-card>
    </ion-content>
    <ion-footer>
      <ion-toolbar color="success">
        <ion-buttons v-for="pet in petProfile" :key="pet.petid">
          <ion-button fill="clear" :href="/active/+pet.petid">Active</ion-button>
          <ion-button fill="clear" :href="/inactive/+pet.petid">Inactive</ion-button>
          <ion-button fill="clear" :href="/history/+pet.petid" active><strong>History</strong></ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-footer>
  </ion-app>
</template>

<script lang="ts">
import {  IonApp,  IonToolbar, IonContent, IonButtons, IonButton, IonBackButton, IonCard, IonCardContent, IonGrid, IonCol, IonRow,
  IonLabel, IonFooter
} from '@ionic/vue';
import { defineComponent } from 'vue';  
import { useRoute } from 'vue-router';
import axios from 'axios';

export default defineComponent({
  name: "CardPage",
  components: {
    IonApp,
    IonToolbar, IonContent,
    IonButtons, IonButton, IonBackButton,
    IonCard,
    IonCardContent, IonLabel, IonGrid, IonCol, IonRow, IonFooter
  }, setup () {
    const route = useRoute();        
    const petid = route.params.petid;
    return {
      petid
    }
  }, data () {
    return {
      petProfile: [],
      noteList: [],
      dog: "assets/img/Dog/Corgi.jpg",
      cat: "assets/img/Cat/Scottish Fold.jpg",
      bird: "assets/img/Bird/Small Conures.jpg",
      mouse: "assets/img/Mouse/Marked.jpg",
      logo: "assets/img/cat/Cat_ScottishFold.jpg"
    }
  }, mounted () {
    this.getPet();
    this.getCard();
  }, methods: {
    getPet() {
      axios.post("http://localhost/_alagapp/_petprofile.php", null, {params: {
              "petid":this.petid
          }})
      .then((response)=>{
        console.log(response.data);
        this.petProfile = response.data;
      })
      .catch(function(error){
        alert(error);
      });
    },
    getCard() {
        axios.post("http://localhost/_alagapp/_notelist.php", null, {params: {
              "petid":this.petid
          }})
      .then((response)=>{
        this.noteList = response.data;
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
ion-app {
  --ion-background-color: #C8E6C9;
}
ion-menu {
  --ion-background-color: #E8F5E9;
}
ion-card {
  --ion-background-color: #E8F5E9;
}

ion-button {
  margin-left: auto;
  margin-right: auto;
}

#profile{
  margin: auto;
  width: 190px;
  height: 100px;
  align-content: center;
  align-items: center;
  margin-bottom: 120px;
  text-align: center;
}
</style>
