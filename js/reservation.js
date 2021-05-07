document.querySelector('.selectedBien').addEventListener('change',bienSelect);

var avatarImg = document.querySelector('#avatarImage');

function bienSelect(){

   var selectedBien =  document.querySelector('.selectedBien').value;
   if(selectedBien == '1'){
      
        
        avatarImg.src = 'graphic/apartement.jpg';
        document.querySelector('.sectionB').innerHTML = "";
        document.querySelector('.sectionC').innerHTML = "";
   }else if(selectedBien == '2'){

   

    avatarImg.src = 'graphic/bangalow.jpg';
    document.querySelector('.sectionB').innerHTML = "";
    document.querySelector('.sectionC').innerHTML = "";

    }else if(selectedBien == '3'){

        document.querySelector('.sectionB').innerHTML = 
        `<label for="">Vue type</label>
        <select name="VueChambreSimple" class="form-select">
        <option  selected="" disabled value="">--choisie le Vue--</option>
        <option value="vueExt">Vue exterirur + 20% chambre simple</option>
        <option value="vueInt">Vue interieur</option>
        </select>`
        avatarImg.src = 'graphic/DoubleDeb.jpg';

    }else if(selectedBien == '4'){

        document.querySelector('.sectionB').innerHTML = 
    `<label for="">lit type</label>
    <select name="chambreDoubleLitTypes" class="litType form-select" onchange="selectedBedType()">
    <option selected="" disabled value="">--selectioner le choix qui vous convient--</option>
    <option value="litDouble">Lit double</option>
    <option value="2litSimpe">2 lit simple</option>
    </select>`
    avatarImg.src = 'graphic/2beds.jpg';

    }
}
function selectedBedType(){

    var selectedbed =  document.querySelector('.litType').value;

    if(selectedbed=='litDouble'){
        
        document.querySelector('.sectionC').innerHTML = 
        `<label for="">Vue type pour la chambre double</label>
        <select name="VueChambreDoubleLitDouble" class="form-select">
        <option  selected="" disabled value="">--choisie le Vue--</option>
        <option value="vueExt">Vue exterirur + 20% chambre double</option>
        <option value="vueInt">Vue interieur</option>
        </select>`
    }else{
        document.querySelector('.sectionC').innerHTML = 
        `<label for="">Vue type pour la chambre double</label>
        <select name="VueChambreDouble2litsimple" class="form-select">
        <option  selected="" disabled value="">--choisie le Vue--</option>
        <option value="vueInt">Vue interieur</option>
        </select>`
    }
}
function haveEnfants() {

        document.querySelector('.sectionE').innerHTML = 
        `<label for="">Nombre d'enfants</label>
        <input onkeyup="nenfantAge()" type="number" class="form-control" id="nEnfant" placeholder="Enter combien vous avez d'enfants">`
}
function noEnfants(){
    document.querySelector('.sectionE').innerHTML ="";
}

function No() {
    document.querySelector('.sectionE').style = "display : none;" 
}
function Yes() {
    document.querySelector('.sectionE').style = "display : block;" 
}
var numbersTable = new Array(
    "première",
    "deuxième",
    "troisième",
    "quatrième",
    "cinquième",
    "sixieme",
    "septième",
    "huitième",
    "neuvième",
    "dixième",
    "onzième",
    "douzième",
    "treizième",
    "quatorzième",
    "quinzième",
    "seizième",
    "dix-septième",
    "dix-huitième",
    "dix-neuvième",
    "vingtième"
);
function nenfantAge() {

    document.querySelector(".sectionF").innerHTML ="";
    var nEnfant = document.querySelector('#nEnfant').value;
    for (var i = 0; i < nEnfant; i++) {
    var content = `<br><label for="">Entrer l'age du ${numbersTable[i]} enfant : </label><input name="ageEnfant-${i}" onkeyup="childAgeOptions()" placeholder="Enter l'age du ${numbersTable[i]} enfant" class="form-control ageEnfant" id="ageEnfant-${i}" type="text">`;
    document.querySelector(".sectionF").innerHTML += content;
}
}


function childAgeOptions() {
            var displayChildOption = document.querySelector(".sectionG");
            displayChildOption.innerHTML = "";
           var len = document.querySelector("#nEnfant").value;
            var inputsAge = document.querySelectorAll(".ageEnfant");
           // var len = inputsAge.length;
			var age = [];
        for (var i = 0; i <parseInt(len); i++) {
                

                if (inputsAge[i].value <= 2) {
                   
                        
                    displayChildOption.innerHTML +=
                    ` <div class="m-4">
                    <label for="">choix pour votre ${numbersTable[i]} enfant</label>
                    <select name="child-${i}" style="width : 100%;" class="form-select">
                    <option selected="" disabled value="">--choisie ce qui vous convient--</option>
                    <option value="0">Pas de lit suplementaire</option>
                    <option value="25">lit suplementaire pour enfant +25%</option>
                    </select> </div>`;
    
                }else if (inputsAge[i].value > 2 && inputsAge[i].value <14) {
                    
                    displayChildOption.innerHTML +=
                    `<div class="m-4">
                    <label for="">choix pour votre ${numbersTable[i]} enfant</label>
                    <select name="child-${i}" class="form-select">
                    <option selected="" disabled value="">--choisie ce qui vous convient--</option>
                    <option value="50">Ajout 50% chambre simple</option>
                    </select></div>`
                        
                }else if (inputsAge[i].value > 14) {
                    
                    displayChildOption.innerHTML +=
                    `<div class="m-4">
                    <label for="">choix pour votre ${numbersTable[i]} enfant</label>
                    <select name="child-${i}" style="width : 100%;" class="form-select">
                    <option selected="" disabled value="">--choisie ce qui vous convient--</option>
                    <option value="100">Ajout chambre simple</option>
                    <option value="70">Ajout 70% chambre simple + lit</option>
                    </select></div>`
    
                }
        }
}

document.getElementById('btnSubmitRes0').addEventListener('click',function() {
    document.getElementById('button_type').value = "submit";
    document.getElementById('main_form').submit();
});


document.getElementById('btnSubmitRes1').addEventListener('click',function() {
    document.getElementById('button_type').value = "add";
    document.getElementById('main_form').submit();
});


document.getElementById('btnSubmitRes2').addEventListener('click',function() {
    document.getElementById('button_type').value = "cancel";
    document.getElementById('main_form').submit();
});