const btnOpenPopup = document.querySelector("#btn-open-popup");
const btnClosePopup = document.querySelector("#btn-close-popup");
const popup = document.querySelector("#popup");

btnOpenPopup.addEventListener("click",()=>{
    popup.showModal();
})
btnClosePopup.addEventListener("click",()=>{
    popup.close();
})