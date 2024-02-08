document.getElementById('myForm').addEventListener('submit', function(event) {
    var nom = document.getElementById('nom').value.trim();
    var prenom = document.getElementById('prenom').value.trim();
    var email = document.getElementById('email').value.trim();
    var phone = document.getElementById('phone').value.trim();
    var message = document.getElementById('message').value.trim();

    var nomRegex = /^[a-zA-ZÀ-ÿ-]+(?:\s+[a-zA-ZÀ-ÿ-]+)*$/;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var phoneRegex = /^\d{10}$/;

    if (!nomRegex.test(nom) || !nomRegex.test(prenom) || !emailRegex.test(email) || !phoneRegex.test(phone) || message === '') {
        alert('Veuillez remplir tous les champs du formulaire correctement.');
        event.preventDefault();
    }
});