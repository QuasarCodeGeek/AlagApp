<template>
  <ion-page>
    <ion-header :translucent="true">
      <ion-toolbar>
          <ion-button href="/home" fill="outline" slot="start">
          Back
        </ion-button>
        <ion-title>New Task</ion-title>
        <ion-button @click="saveTask" fill="outline" slot="end">
          Add
        </ion-button>
      </ion-toolbar>
    </ion-header>
    
    <ion-content :fullscreen="true">
      <div id="container">
          <ion-item>
              <ion-label>Title:</ion-label>
              <ion-input v-model="intitle" placeholder="Enter Title"></ion-input>
          </ion-item>
          <ion-item>
              <ion-label>Category:</ion-label>
              <ion-input v-model="incategory" placeholder="Enter Category"></ion-input>
          </ion-item>
          <ion-item>
              <ion-label>Content:</ion-label>
              <ion-textarea v-model="incontent" placeholder="Enter Content"></ion-textarea>
          </ion-item>
          <ion-item>
              <ion-label>Time:</ion-label>
              <ion-input v-model="intime" type="time"></ion-input>
          </ion-item>
          <ion-item>
              <ion-label>Date:</ion-label>
              <ion-input v-model="indate" type="date"></ion-input>
          </ion-item>
      </div>
    </ion-content>
  </ion-page>
</template>

<script lang="ts">
import {
  IonContent,
  IonHeader,
  IonPage,
  IonTitle,
  IonToolbar,
  IonButton,
  IonItem,
  IonLabel,
  IonTextarea,
  IonInput
  } from '@ionic/vue';
import { defineComponent } from 'vue';
import axios from 'axios';

export default defineComponent({
  components: {
    IonContent,
    IonHeader,
    IonPage,
    IonTitle,
    IonToolbar,
    IonButton,
    IonItem,
    IonLabel,
    IonTextarea,
    IonInput
  }, data() {
    return {
      intitle: '',
      incategory: '',
      incontent: '',
      intime: '',
      indate: ''
    }
  }, methods: {
      saveTask() {
          axios.post("http://localhost/crud/addTask.php", null, {params: {
              "task_title":this.intitle,
              "task_category":this.incategory,
              "task_content":this.incontent,
              "task_time":this.intime,
              "task_date":this.indate
          }})
          .then((response)=>{
        console.log(response.data);
        this.$router.push("/home");
      })
      .catch(function(error){
        alert(error);
      });
      }
  }
});
</script>

<style scoped>
#container {
  text-align: center;
  
  position: absolute;
  left: 0;
  right: 0;
  top: 50%;
  transform: translateY(-50%);
}

#container strong {
  font-size: 20px;
  line-height: 26px;
}

#container p {
  font-size: 16px;
  line-height: 22px;
  
  color: #8c8c8c;
  
  margin: 0;
}

#container a {
  text-decoration: none;
}
</style>