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
          <ion-item lines="none" :button="/home/+user.userid">
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
        <ion-title>Home</ion-title>
      </ion-toolbar>
    </ion-header>
    
    <ion-content>
      <div class="tab" v-for="pet in petList" :key="pet.petid">
        <ion-card>
            <img v-if="pet.pettype == 'Dog' " alt="pet" :src="dog" />
            <img v-else-if="pet.pettype == 'Cat' " alt="pet" :src="cat" />
            <img v-else-if="pet.pettype == 'Bird' " alt="pet" :src="bird" />
            <img v-else-if="pet.pettype == 'Mouse' " alt="pet" :src="mouse" />
          <ion-card-header>
            <ion-card-title>
              {{ pet.petname }}
            </ion-card-title>
            <ion-card-subtitle>
              {{ pet.pettype}}
            </ion-card-subtitle>
          </ion-card-header>
          <ion-buttons class="cardbutton">
            <ion-button fill="clear" :href="/card/+pet.petid">E-Vaccine Card</ion-button>
            <ion-button fill="clear" :href="/active/+pet.petid">E-Prescription Note</ion-button>
          </ion-buttons>
        </ion-card>
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
    IonCardSubtitle,
    IonLabel,
    IonList,
    IonItem,
    IonAvatar
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
      IonCardSubtitle,
      IonLabel,
      IonList,
      IonItem,
      IonAvatar
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
      userList: [],
      petList: [],
      dog: "assets/img/Dog/Corgi.jpg",
      cat: "assets/img/Cat/Scottish Fold.jpg",
      bird: "assets/img/Bird/Small Conures.jpg",
      mouse: "assets/img/Mouse/Marked.jpg",
      logo: "assets/img/AlagApp.png"
    }
  }, mounted() {
      this.viewPets();
      this.getUser();
  }, methods: {
    viewPets() {
        axios.post("http://localhost/_alagapp/_petlist.php", null, {params: {
              "userid":this.userid
          }})
      .then((response)=>{
        this.petList = response.data;
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
  margin-right: auto;
  margin-left: auto;
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