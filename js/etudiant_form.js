let currentStep = 0;
const steps = document.querySelectorAll('.step');

function showStep(index){
    for(let i = 0; i< steps.length; i++){
        steps[i].style.display = "none";
    }
    steps[index].style.display = "block";
}

function nextStep(){
    const currentInputs = steps[currentStep].querySelectorAll('input[required]');
    const allField = Array.from(currentInputs).every(input => input.value.trim() != "");
    if(allField && currentStep < steps.length - 1){
        currentStep++;
        showStep(currentStep);
    }
    else{
        alert("Veuillez remplir les champs s'il vous plaît!");
    }
}

function prevStep(){
    if(currentStep > 0){
        currentStep--;
        showStep(currentStep)
    }
}

function connexion(){
    const lien = event.target.innerText.trim();

    const login_text = document.querySelector('.info-text.login');
    const login_anim = document.querySelector('.bg-animat');
    const login_form = document.querySelector('.form-box.login');

    const registre_text = document.querySelector('.info-text.registre');
    const registre_anim = document.querySelector('.bg-animat2');
    const registre_form = document.querySelector('.form-box.registre');

    if(lien === 'Se connecter'){
        login_text.style.display = "flex";
        login_anim.style.display = "block";
        login_form.style.display = "flex";

        registre_text.style.display = "none";
        registre_anim.style.display = "none";
        registre_form.style.display = "none";
    }

    else if(lien === 'Demander'){
        login_text.style.display = "none";
        login_anim.style.display = "none";
        login_form.style.display = "none";

        registre_text.style.display = "flex";
        registre_anim.style.display = "block";
        registre_form.style.display = "flex";
    }
}
