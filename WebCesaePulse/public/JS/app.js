function setCurrentDate() {
    const dateElement = document.getElementById('current-date');
    const today = new Date();

    // Formatando a data para DD/MM/YYYY
    const day = String(today.getDate()).padStart(2, '0');
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const year = today.getFullYear();

    dateElement.textContent = `${day}/${month}/${year}`;
}

// Chamando a função ao carregar a página
document.addEventListener('DOMContentLoaded', setCurrentDate);

//ADICIONADO

document.addEventListener("DOMContentLoaded", function(event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)

    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
    toggle.addEventListener('click', ()=>{
    // show navbar
    nav.classList.toggle('show')
    // change icon
    toggle.classList.toggle('bx-x')
    // add padding to body
    bodypd.classList.toggle('body-pd')
    // add padding to header
    headerpd.classList.toggle('body-pd')
    })
    }
    }

    showNavbar('header-toggle','nav-bar','body-pd','header')

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink(){
    if(linkColor){
    linkColor.forEach(l=> l.classList.remove('active'))
    this.classList.add('active')
    }
    }
    linkColor.forEach(l=> l.addEventListener('click', colorLink))

     // Your code to run since DOM is loaded and ready
    });
    // Função para mostrar/ocultar o segundo calendário
    function toggleSegundoCalendario() {
        var checkBox = document.getElementById("inlineCheckbox1");
        var segundoCalendarioContainer = document.getElementById("segundoCalendarioContainer");

        if (checkBox.checked) {
            segundoCalendarioContainer.style.display = "block"; // Mostra o segundo calendário
        } else {
            segundoCalendarioContainer.style.display = "none";  // Esconde o segundo calendário
        }
    }

    // Garante que o segundo calendário inicie com o estado correto ao carregar a página
    document.addEventListener("DOMContentLoaded", function() {
        toggleSegundoCalendario();
    });

    $(document).ready(function() {
        $('#datepicker').datepicker({
          format: 'dd/mm/yyyy',
          todayHighlight: true,
          autoclose: true
        });
      });

      $('#meuModal').on('shown.bs.modal', function () {
        $('#meuInput').trigger('focus')
      })
      const exampleModal = document.getElementById('exampleModal')
if (exampleModal) {
  exampleModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget
    const recipient = button.getAttribute('data-bs-whatever')
    const modalTitle = exampleModal.querySelector('.modal-title')
    const modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = `New message to ${recipient}`
    modalBodyInput.value = recipient
  })
}
