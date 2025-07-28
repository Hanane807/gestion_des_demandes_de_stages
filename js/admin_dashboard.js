window.addEventListener("DOMContentLoaded",() => {
    const statuts = document.querySelectorAll('.statut');
    
    statuts.forEach((el) =>{
        const statut = el.innerText.trim();
    if(statut === "en attente"){
        el.style.background = "rgba(218, 226, 125, 0.5)";
        el.style.color = "rgba(159, 167, 55, 0.5)";
    }   
    else if(statut === "acceptée"){
        el.style.background = "rgba(208, 247, 215, 0.5)";
        el.style.color = "rgba(44, 74, 47, 0.5)";
    }
    else if(statut === "refusée"){
        el.style.background = "rgba(241, 162, 157, 0.5)";
        el.style.color = "rgba(138, 7, 7, 0.5)";
    }
    });
});

function dec(){
    if(confirm("Voulez-vous vraiment vous déconnecter ?")){
        window.location.href = '../html/admin_form.html';
    }else {
        return false;
    }
}

window.addEventListener("DOMContentLoaded", ()=>{
const modalcontainer = document.querySelector(".modal-container");
const modalcontent = document.querySelector(".modal-content");
const closeModal = document.querySelector('.close-modal');
const overley = document.querySelector('.overlay');

document.querySelectorAll('.modal-btn').forEach(btn => {
    btn.addEventListener('click', (e)=>{
        e.preventDefault();
        const info = JSON.parse(btn.getAttribute('data-info'));

          modalcontent.innerHTML = `
                <strong>Nom & Prénom :</strong> ${info.nom_complet}<br>
                <strong>Email :</strong> ${info.email}<br>
                <strong>Filière :</strong> ${info.filiere}<br>
                <strong>Niveau :</strong> ${info.niveau}<br>
                <strong>Date début :</strong> ${info.date_debut}<br>
                <strong>Date fin :</strong> ${info.date_fin}<br>
                <strong>CV :</strong> <a href="../uploads/${info.cv}" target="_blank">Voir le CV</a> <br>
                <strong>Lettre :</strong> <a href="../uploads/${info.lettre_motivation}" target="_blank">Voir la lettre</a><br>
                <strong>Statut :</strong> ${info.statut}
            `;
        modalcontainer.style.display = 'flex';
        
    });
});
     closeModal.addEventListener('click', ()=>{
        modalcontainer.style.display = 'none';
     });

     overley.addEventListener('click', ()=>{
        modalcontainer.style.display = 'none';
     });

});

window.addEventListener("DOMContentLoaded", () =>{
    const modalcont = document.querySelector('.modal-cont');
    const iddemande = document.querySelector('.id_demande')
    const closeedit = document.querySelector('.btn-edit');
    const overley = document.querySelector('.over');
    const inputstatut = document.querySelector('.sta');

    document.querySelectorAll('.edit-btn').forEach(btn =>{
        btn.addEventListener("click",(e)=>{
            e.preventDefault();
            const infor = JSON.parse(btn.getAttribute('data-info'));

            iddemande.value = infor.id_demande;
            inputstatut.value = infor.statut;

            modalcont.style.display = 'flex';
        });
    });
    closeedit.addEventListener("click", ()=>{
            modalcont.style.display = 'none';
        });
    
    overley.addEventListener("click", ()=>{
            modalcont.style.display = 'none';
        });
});

function affichage_demande(){
    const dashboard = document.querySelector('.dashboard_container');
    const demande = document.querySelector('.demande_container');
    const valider = document.querySelector('.valider_container');
    const reject = document.querySelector('.rejeter_container');
    const para = document.querySelector('.para_container');
    const statistic = document.querySelector('.statistic');

    statistic.style.display = 'none';
    para.style.display = 'none';
    reject.style.display = 'none';
    dashboard.style.display = 'none';
    demande.style.display = 'block';
    valider.style.display = 'none';
}

function affichage_board(){
    const dashboard = document.querySelector('.dashboard_container');
    const demande = document.querySelector('.demande_container');
    const valider = document.querySelector('.valider_container');
    const reject = document.querySelector('.rejeter_container');
    const para = document.querySelector('.para_container');
    const statistic = document.querySelector('.statistic');

    statistic.style.display = 'none';
    para.style.display = 'none';
    reject.style.display = 'none';
    dashboard.style.display = 'block';
    demande.style.display = 'none';
    valider.style.display = 'none';
}

function affichage_valider(){
    const dashboard = document.querySelector('.dashboard_container');
    const demande = document.querySelector('.demande_container');
    const valider = document.querySelector('.valider_container');
    const reject = document.querySelector('.rejeter_container');
    const para = document.querySelector('.para_container');
    const statistic = document.querySelector('.statistic');

    statistic.style.display = 'none';
    para.style.display = 'none';
    reject.style.display = 'none';
    valider.style.display = 'block';
    dashboard.style.display = 'none';
    demande.style.display = 'none';

}

function affichage_rejeter(){
    const dashboard = document.querySelector('.dashboard_container');
    const demande = document.querySelector('.demande_container');
    const valider = document.querySelector('.valider_container');
    const reject = document.querySelector('.rejeter_container');
    const para = document.querySelector('.para_container');
    const statistic = document.querySelector('.statistic');

    statistic.style.display = 'none';
    para.style.display = 'none';
    reject.style.display = 'block';
    valider.style.display = 'none';
    dashboard.style.display = 'none';
    demande.style.display = 'none';

}

function affichage_para(){
    const dashboard = document.querySelector('.dashboard_container');
    const demande = document.querySelector('.demande_container');
    const valider = document.querySelector('.valider_container');
    const reject = document.querySelector('.rejeter_container');
    const para = document.querySelector('.para_container');
    const statistic = document.querySelector('.statistic');

    statistic.style.display = 'none';
    para.style.display = 'block';
    reject.style.display = 'none';
    valider.style.display = 'none';
    dashboard.style.display = 'none';
    demande.style.display = 'none';

}

function affichage_stat(){
    const dashboard = document.querySelector('.dashboard_container');
    const demande = document.querySelector('.demande_container');
    const valider = document.querySelector('.valider_container');
    const reject = document.querySelector('.rejeter_container');
    const para = document.querySelector('.para_container');
    const statistic = document.querySelector('.statistic');

    statistic.style.display = 'block';
    para.style.display = 'none';
    reject.style.display = 'none';
    valider.style.display = 'none';
    dashboard.style.display = 'none';
    demande.style.display = 'none';

}

