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
