console.log("DEU!")


document.addEventListener('DOMContentLoaded', () => {
    $('#data-table').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-PT.json"
        },
        order: [[1, 'asc']],
        paging: true,
        searching: true,
        info: true,
        pageLength: 5,
        lengthMenu: [ [5, 10, 25, 50, 100], [5, 10, 25, 50, 100] ]
    });
});

document.addEventListener('DOMContentLoaded', () => {
    $('#data-tableUsers').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-PT.json"
        },
        order: [[1, 'asc']],
        paging: true,
        searching: true,
        info: true,
        pageLength: 5,
        lengthMenu: [ [5, 10, 25, 50, 100], [5, 10, 25, 50, 100] ]
    });
});

document.addEventListener('DOMContentLoaded', () => {
    $('#data-tableAdmin').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-PT.json"
        },
        order: [[1, 'asc']],
        paging: true,
        searching: true,
        info: true,
        pageLength: 5,
        lengthMenu: [ [5, 10, 25, 50, 100], [5, 10, 25, 50, 100] ]
    });
});


document.addEventListener('DOMContentLoaded', () => {
    $('#data-tablePerformance').DataTable({
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-PT.json"
        },
        order: [[1, 'desc']],
        paging: true,
        searching: true,
        info: true,
        pageLength: 5,
        lengthMenu: [ [5, 10, 25, 50, 100], [5, 10, 25, 50, 100] ]
    });
});

function setCurrentDate() {
    const dateElement = document.getElementById('current-date');
    const today = new Date();

    // Formatando a data para DD/MM/YYYY
    const day = String(today.getDate()).padStart(2, '0');
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const year = today.getFullYear();

    dateElement.textContent = `${day}/${month}/${year}`;
}


document.addEventListener('DOMContentLoaded', setCurrentDate);



document.addEventListener("DOMContentLoaded", function() {
    const alert = document.getElementById('success-alert');
    if (alert) {
        setTimeout(function() {
            alert.style.display = 'none';
        }, 5000);
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const alert = document.getElementById('danger-alert');
    if (alert) {
        setTimeout(function() {
            alert.style.display = 'none';
        }, 5000);
    }
});

document.addEventListener("DOMContentLoaded", function(event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)


    if(toggle && nav && bodypd && headerpd){
    toggle.addEventListener('click', ()=>{

    nav.classList.toggle('show')

    toggle.classList.toggle('bx-x')

    bodypd.classList.toggle('body-pd')

    headerpd.classList.toggle('body-pd')
    })
    }
    }

    showNavbar('header-toggle','nav-bar','body-pd','header')

    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink(){
    if(linkColor){
    linkColor.forEach(l=> l.classList.remove('active'))
    this.classList.add('active')
    }
    }
    linkColor.forEach(l=> l.addEventListener('click', colorLink))


    });

    function toggleSegundoCalendario() {
        var checkBox = document.getElementById("inlineCheckbox1");
        var segundoCalendarioContainer = document.getElementById("segundoCalendarioContainer");

        if (checkBox.checked) {
            segundoCalendarioContainer.style.display = "block";
        } else {
            segundoCalendarioContainer.style.display = "none";
        }
    }


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



