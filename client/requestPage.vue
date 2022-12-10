<template>
    <ion-app>
      <ion-header :translucent="true" >
        <ion-toolbar color="success">
          <ion-buttons slot="start" v-for="use in userSet" :key="use.userid">
            <ion-back-button :defaultHref = "/sched/+use.userid"></ion-back-button>
          </ion-buttons>
        <ion-title>Request Appointment</ion-title>
        </ion-toolbar>
      </ion-header>
      
      <ion-content>
            <ion-item lines="none">
                <ion-label>Pet</ion-label>
                <ion-input v-model="pet" placeholder="Pet Name"></ion-input>
            </ion-item>
            <ion-item lines="none">
                <ion-label>Reason</ion-label>
                <ion-select v-model="reason" placeholder="Select Reason">
                    <ion-select-option value="Vaccination">Vaccination</ion-select-option>
                    <ion-select-option value="Check-Up">Check-up</ion-select-option>
                    <ion-select-option value="Follow-Up">Follow-up</ion-select-option>
                </ion-select>
            </ion-item>
            <ion-item lines="none">
                <ion-label>Comment</ion-label>
                <ion-textarea  placeholder="Enter additional comment" v-model="comment"></ion-textarea>
            </ion-item>
            <ion-item lines="none">
                <ion-label>Date</ion-label>
                <ion-input placeholder="Date" type="date" v-model="date"></ion-input>
            </ion-item>
            <div>
                <ion-button expand="block" color="success" @click="pushRequest">Submit</ion-button>
            </div>
      </ion-content>
    </ion-app>
  </template>
  
  <script lang="ts">
  import {  IonHeader, IonApp,  IonToolbar, IonContent, IonButtons, IonBackButton, IonItem, 
    IonLabel, IonSelect, IonSelectOption, IonButton, IonTextarea
  } from '@ionic/vue';
  import { defineComponent } from 'vue';  
  import { useRoute } from 'vue-router';
  import axios from 'axios';
  
  export default defineComponent({
    name: "CardPage",
    components: {
      IonHeader, IonApp,
      IonToolbar, IonContent,
      IonButtons, IonBackButton,
      IonItem, IonLabel, IonButton, IonSelect, IonSelectOption, IonTextarea
    }, setup () {
      const route = useRoute();        
      const userid = route.params.userid;
      return {
        userid
      }
    }, data () {
      return {
        petList: [],
        userSet: [],
        pet: '',
        reason: '',
        comment: '',
        date: '',
        status: 'Pending'
      }
    }, mounted () {
      this.getPet();
      this.checkUser();
    }, methods: {
      pushRequest() {
        axios.post("http://localhost/_alagapp/_schedrequest.php", null, {params: {
                "pet":this.pet,
                "userid":this.userid,
                "reason":this.reason,
                "comment":this.comment,
                "date":this.date,
                "status":this.status
            }})
        .then((response)=>{
          console.log(response.data);
          this.$router.push("/sched/"+this.userid);
        })
        .catch(function(error){
          alert(error);
        });
      },
      getPet() {
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
      checkUser() {
          axios.post("http://localhost/_alagapp/_user.php", null, {params: {
                "userid":this.userid
            }})
        .then((response)=>{
          this.userSet = response.data;
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
  
  #profile{
    margin: auto;
    width: 190px;
    height: 100px;
    align-content: center;
    align-items: center;
    margin-bottom: 120px;
    text-align: center;
  }
  ion-button {
    width: 80%;
    margin-left: auto;
    margin-right: auto;
  }
  </style>
  