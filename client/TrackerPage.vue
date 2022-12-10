<template>
  <ion-menu content-id="main-content" >
    <ion-header>
      <ion-toolbar color="success">
        <ion-title>Menu</ion-title>
      </ion-toolbar>
    </ion-header>
    
    <ion-content>
        <ion-avatar class="logo"> 
          <img :src = "logo">
        </ion-avatar>
        <div v-for="user in userList" :key="user.userid">
          <ion-list class="list">
          <ion-item lines="none" :href="/user/+user.userid">
            <ion-icon :src = "person" float="start"  size="large"></ion-icon>
            <ion-label>User Profile</ion-label>
          </ion-item>
          <ion-item lines="none" :href="/home/+user.userid">
            <ion-icon :src = "home" float="start"  size="large"></ion-icon>
            <ion-label>Home</ion-label>
          </ion-item >
          <ion-item lines="none" :href="/chat/+user.userid">
            <ion-icon :src = "chatbox" float="start"  size="large"></ion-icon>
            <ion-label>O-Consultation</ion-label>
          </ion-item >
          <ion-item  lines="none" :href="/tracker/+user.userid">
            <ion-icon :src = "fitness" float="start" size="large"></ion-icon>
            <ion-label>Pet Health Tracker</ion-label>
          </ion-item>
          <ion-item  lines="none" :href="/about/+user.userid">
            <ion-icon :src = "informationCircle" float="start" size="large"></ion-icon>
            <ion-label>About Us</ion-label>
          </ion-item>
          <ion-item  lines="none" href="/login">
            <ion-icon :src = "logOut" float="start" size="large"></ion-icon>
            <ion-label>Log Out</ion-label>
          </ion-item>
        </ion-list>
        </div>
    </ion-content>
  </ion-menu>
  
  <ion-app id ="main-content">
    <ion-header>
      <ion-toolbar color="success">
        <ion-buttons slot="start">
          <ion-menu-button></ion-menu-button>
        </ion-buttons>
        <ion-title>Pet Health Tracker</ion-title>
      </ion-toolbar>
    </ion-header>
    
  <ion-content>
    <ion-card>
      <ion-card-content>
        <div>
        <ion-select v-model="pettype" placeholder="Pet Type">
          <ion-select-option value="Bird">Bird</ion-select-option>
          <ion-select-option value="Cat">Cat</ion-select-option>
          <ion-select-option value="Cow">Cow</ion-select-option>
          <ion-select-option value="Dog">Dog</ion-select-option>
          <ion-select-option value="Fish">Fish</ion-select-option>
          <ion-select-option value="Frog">Frog</ion-select-option>
          <ion-select-option value="Mouse">Mouse</ion-select-option>
          <ion-select-option value="Lizard">Lizard</ion-select-option>
          <ion-select-option value="Snake">Snake</ion-select-option>
        </ion-select>
        </div>
        <div>
        <ion-select v-model="bodypart" placeholder="Body Part">
          <ion-select-option value="Abdomen">Bird</ion-select-option>
          <ion-select-option value="Back">Back</ion-select-option>
          <ion-select-option value="Behavior">Behavior</ion-select-option>
          <ion-select-option value="Digits">Digits</ion-select-option>
          <ion-select-option value="Eyes">Eyes</ion-select-option>
          <ion-select-option value="Ears">Ears</ion-select-option>
          <ion-select-option value="Fur">Fur</ion-select-option>
          <ion-select-option value="Gills">Gills</ion-select-option>
          <ion-select-option value="Gizzard">Gizzard</ion-select-option>
          <ion-select-option value="Heart">Heart</ion-select-option>
          <ion-select-option value="Lungs">Lungs</ion-select-option>
          <ion-select-option value="Mouth">Mouth</ion-select-option>
          <ion-select-option value="Mucosa">Mucosa</ion-select-option>
          <ion-select-option value="Nerve (Bronchial)">Nerve (Bronchial)</ion-select-option>
          <ion-select-option value="Nose">Nose</ion-select-option>
          <ion-select-option value="Near Tail">Near Tail</ion-select-option>
          <ion-select-option value="Spleen">Speen</ion-select-option>
          <ion-select-option value="Skin">Skin</ion-select-option>
          <ion-select-option value="Tail">Tail</ion-select-option>
          <ion-select-option value="Toes">Toes</ion-select-option>
          <ion-select-option value="Tongue">Tongue</ion-select-option>
        </ion-select>
        </div>
        <div>
        <ion-select v-model="symptom" placeholder="Symptom">
          <ion-select-option value="Abdominal Enlargement">Abdominal Enlargement</ion-select-option>
          <ion-select-option value="Abnormal Shedding">Abnormal Shedding</ion-select-option>
          <ion-select-option value="Aggression">Aggression</ion-select-option>
          <ion-select-option value="Bloating">Bloating</ion-select-option>
          <ion-select-option value="Cough">Cough</ion-select-option>
          <ion-select-option value="Diarrhea">Diarrhea</ion-select-option>
          <ion-select-option value="Dermatitis">Dermatitis</ion-select-option>
          <ion-select-option value="High Fever">High Fever</ion-select-option>
          <ion-select-option value="Lethargy">Lethargy</ion-select-option>
          <ion-select-option value="Loss of Appetite">Loss of Appetite</ion-select-option>
          <ion-select-option value="Milky Skin">Milky Skin</ion-select-option>
          <ion-select-option value="Nasal Discharge">Nasal Discharge</ion-select-option>
          <ion-select-option value="Ocular Discharge">Ocular Discharge</ion-select-option>
          <ion-select-option value="Paralysis">Paralysis</ion-select-option>
          <ion-select-option value="Sudden Death">Sudden Death</ion-select-option>
          <ion-select-option value="Ulceration">Ulceration</ion-select-option>
          <ion-select-option value="Weight Loss">Weight Loss</ion-select-option>
        </ion-select>
        </div>
      </ion-card-content>
      <div class="cardbutton">
        <ion-button expand="fill" fill="clear" @click="getList">Find Diagnosis</ion-button>
      </div>
    </ion-card>

      <div v-if="pettype !='' && bodypart != '' && symptom != '' ">
        <div v-for="get in getData" :key="get.cid">
        <ion-card>
          <ion-card-header>
            <ion-card-title>
              {{get.diagnosis}}
            </ion-card-title>
          </ion-card-header>
          <ion-card-content>
            {{get.description}}
          </ion-card-content>
        </ion-card>
      </div>
      </div>
    </ion-content>
  </ion-app>
</template>

<script lang="ts">
  import { 
    IonApp,
    IonButtons,
    IonContent,
    IonHeader,
    IonMenu,
    IonMenuButton,
    IonTitle,
    IonToolbar, 
    IonCard,
    IonCardHeader,
    IonCardTitle,
    IonCardContent,
    IonLabel,
    IonList,
    IonItem,
    IonAvatar,
    IonSelect,
    IonSelectOption
  } from '@ionic/vue';
  import { defineComponent } from 'vue';
  import { useRoute } from 'vue-router';
  import axios from 'axios';
  import {
    person,
    card,
    chatbox,
    home,
    fitness,
    options,
    informationCircle,
    logOut
  } from 'ionicons/icons';

  export default defineComponent({
    name: 'HomePage',
    components: {  
      IonApp,
      IonButtons,  
      IonContent,  
      IonHeader,
      IonMenu,  
      IonMenuButton,
      IonTitle,  
      IonToolbar,  
      IonCard,
      IonCardHeader,
      IonCardTitle,
      IonCardContent,
      IonLabel,
      IonList,
      IonItem,
      IonAvatar,
      IonSelect,
      IonSelectOption
    }, setup(){
      const route = useRoute();        
      const userid = route.params.userid;
      return{
        person,
        card,
        chatbox,
        home,
        fitness,
        options,
        informationCircle,
        logOut,
        userid,
    }
  }, data() {
    return {
      getData: [],
      userList: [],
      pettype: '',
      bodypart: '',
      symptom: '',
      logo: "assets/img/AlagApp.png"
    }
  }, mounted() {
    this.getList();
    this.getUser();
  }, methods: {
    getList() {
      axios.post("http://localhost/_alagapp/_symptom.php", null, {params: {
              "pettype":this.pettype,
              "bodypart":this.bodypart,
              "symptom":this.symptom
          }})
      .then((response)=>{
        this.getData = response.data;
        console.log(response.data);
      })
      .catch(function(error){
        alert(error);
      });
    },
    getUser() {
      axios.post("http://localhost/_alagapp/_user.php", null, {params: {
              "userid":this.userid
          }})
      .then((response)=>{
        this.userList = response.data;
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
ion-card-title, ion-card-subtitle {
  color: #2E7D32;
}
ion-label {
  margin-left: 15px;
}
ion-button {
  color: whitesmoke;
}
.cardbutton{
  background-color: #4CAF50;
  text-align: center;
}

.logo{
    margin: auto;
    width: 150px;
    height: 150px;
    align-content: center;
    align-items: center;
    margin-top: 30px;
    margin-bottom: 30px;
}

.list ion-item {
  color: #388E3C;
}

ion-avatar {
  width: 100px;
  height: 100px;
  margin-right: 25px;
  border: #2E7D32;
}

a {
  text-decoration: none;
}

</style>