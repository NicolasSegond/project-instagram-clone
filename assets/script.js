visible = false;

function clique(){

    if(visible === false){
        document.getElementById('menuDeroulantPdp').style = "visibility: visible";
        visible = true;
    }
    else{
        document.getElementById('menuDeroulantPdp').style = "visibility: hidden";
        visible = false;
    }
}

// Get DOM Elements
const modal = document.querySelector('#my-modal');
const modalBtn = document.querySelector('#modal-btn');
const modalBtn2 = document.querySelector('#modal-btn2');
const closeBtn = document.querySelector('.close');

// Events
modalBtn.addEventListener('click', openModal);
modalBtn2.addEventListener('click', openModal);
closeBtn.addEventListener('click',closeModal);
window.addEventListener('click',outsideClick);

// Open
function openModal() {
  modal.style.display = 'flex';
}

// Close
function closeModal() {
  modal.style.display = 'none';
}

// Close If Outside Click
function outsideClick(e) {
  if (e.target == modal) {
    modal.style.display = 'none';
  }
}

function fermer(){
    modal.style.display = 'none';
}