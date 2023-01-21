function filterUser() {
    var district = document.getElementById("district").value;
    var municipality = document.getElementById("municipality").value;
    var province = document.getElementById("province").value;
    var date = document.getElementById("date").value;
    var gender = document.getElementById("gender").value;

    if (district != ""){
        filter = district;
    } else if (municipality != ""){
        filter = municipality;
    } else if (province != ""){
        filter = province;
    } else if (date != ""){
        filter = date;
    } else if (gender != ""){
        filter = gender;
    } 

        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/filter/filterUser.php?filter="+filter);
        xhttp.send();
  }
  
  function filterPet() {
    var type = document.getElementById("type").value;
    var breed = document.getElementById("breed").value;
    var weight = document.getElementById("weight").value;
    var mark = document.getElementById("mark").value;
    var date = document.getElementById("date").value;
    var age = document.getElementById("age").value;
    var gender = document.getElementById("gender").value;

    if (type != ""){
        filter = type;
    } else if (breed != ""){
        filter = breed;
    } else if (weight != ""){
        filter = weight;
    } else if (mark != ""){
        filter = mark;
    } else if (date != ""){
      filter = date;
    } else if (age != ""){
      filter = age;
    } else if (gender != ""){
        filter = gender;
    } 
  
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/filter/filterPet.php?filter="+filter);
        xhttp.send();
  }
  
  function filterCard() {
    var vaxx = document.getElementById("vaxx").value;
    var vet = document.getElementById("vet").value;
    var weight = document.getElementById("weight").value;
    var date = document.getElementById("date").value;

    if (vaxx != ""){
        filter = vaxx;
    } else if (vet != ""){
        filter = vet;
    } else if (weight != ""){
        filter = weight;
    } else if (date != ""){
        filter = date;
    }
  
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/filter/filterCard.php?filter="+filter);
        xhttp.send();
  }
  
  function filterNote() {
    var vet = document.getElementById("vet").value;
    var date = document.getElementById("date").value;

    if (vet != ""){
        filter = vet;
    } else if (date != ""){
        filter = date;
    }
  
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/filter/filterNote.php?filter="+filter);
        xhttp.send();
  }
  
  function filterSched() {
    var fdate = document.getElementById("firstdate").value;
    var ldate = document.getElementById("lastdate").value;
    var month = document.getElementById("month").value;
    var status = document.getElementById("status").value;


    filter = "fdate="+fdate+"&ldate="+ldate+"&month="+month+"&status="+status;
  
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/filter/filterSched.php?"+filter);
        xhttp.send();
  }
  
  function filterVaccine() {
    var filter = document.getElementById("vaccine").value;
      if(search != "") {
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/filter/filterVaccine.php?filter="+filter);
        xhttp.send();
      } else {
        document.getElementById("altertable").style.display = "none";
        document.getElementById("table").style.display = "block";
      }
  }
  
  function filterSymptom() {
    var search = document.getElementById("vaxx").value;
      if(search != "") {
        document.getElementById("table").style.display = "none";
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          document.getElementById("alter").innerHTML = this.responseText;
        }
        xhttp.open("GET", "../searchData/getVaxx.php?search="+search);
        xhttp.send();
      } else {
        document.getElementById("altertable").style.display = "none";
        document.getElementById("table").style.display = "block";
      }
  }