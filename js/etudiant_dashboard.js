function affichage_para(){
    const dashboard = document.querySelector('.dashboard_container');
    const para = document.querySelector('.para_container');

    para.style.display = 'block';
    dashboard.style.display = 'none';

}

function affichage_board(){
    const dashboard = document.querySelector('.dashboard_container');
    const para = document.querySelector('.para_container');

    para.style.display = 'none';
    dashboard.style.display = 'block';
}

function dec(){
    if(confirm("Voulez-vous vraiment vous déconnecter ?")){
        window.location.href = '../html/etudiant_form.html';
    }else {
        return false;
    }
}

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

document.addEventListener("DOMContentLoaded",() => {
    document.querySelectorAll('.supp').forEach(btn => {
        btn.addEventListener("click", function(e){
            e.preventDefault();
            const id = this.getAttribute("data-id");

            if(confirm("Voulez-vous vraiment supprimer cette demande ?")){
                fetch("../php/delete_demande.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: `id=${encodeURIComponent(id)}`
                })
                .then(response => response.text())
                .then(result =>{

                    console.log("Réponse du serveur :", result);
                    if(result.trim() === 'redirect'){
                        alert("votre compte a été supprimé.");
                        window.location.href = "../html/etudiant_form.html";
                    } else if(result.trim() === "success"){
                        alert("Demande supprimée !");
                        location.reload();
                    } else {
                        alert("erreur lors de la suppression.");
                    }
                })
                .catch(error => {
                    console.error("Erreur fetch :", error);
                    alert("Une erreur est survenue.");
                });
            }
        });
    });
});

document.addEventListener("DOMContentLoaded",() => {
    const deleteallbtn = document.getElementById('delete_all_btn');

    if(deleteallbtn){
        deleteallbtn.addEventListener("click", () => {
            if(confirm("Voulez-vous vraiment supprimer toutes vos demande ?")){
                fetch("../php/delete_all_demandes.php", {
                    method: "POST"
                })
                .then(response => response.text())
                .then(result =>{

                    console.log("Réponse du serveur :", result);
                    if(result.trim() === 'redirect'){
                        alert("Toutes vos demandes ont été supprimées. Votre compte a aussi été supprimé.");
                        window.location.href = "../html/etudiant_form.html";
                    } else if(result.trim() === "success"){
                        alert("Toutes les demandes ont été supprimées.");
                        location.reload();
                    } else {
                        alert("erreur lors de la suppression.");
                    }
                })
                .catch(error => {
                    console.error("Erreur fetch :", error);
                    alert("Une erreur est survenue.");
                });
            }
        });
    }
});