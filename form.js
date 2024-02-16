function validateForm() {
    var name = document.getElementById('nom').value;
    var nameRegex = /^[a-zA-ZÀ-ÿ\s-]{2,}$/; // Regex pour vérifier le nom (lettres, espaces, tirets, au moins 2 caractères)
    if (!nameRegex.test(name)) {
        alert("Le nom doit contenir au moins 2 lettres et peut inclure des espaces et des tirets");
        return false;
    }

    var email = document.getElementById('email').value;
    var emailRegex = /^[\w.-]+@[a-zA-Z_-]+?\.[a-zA-Z]{2,3}$/; // Regex pour vérifier l'email
    if (!emailRegex.test(email)) {
        alert("Format d'email invalide");
        return false;
    }

    var phone = document.getElementById('phone').value;
    var phoneRegex = /^\d{10}$/; // Regex pour vérifier le numéro de téléphone (10 chiffres)
    if (!phoneRegex.test(phone)) {
        alert("Le numéro de téléphone doit contenir exactement 10 chiffres");
        return false;
    }

    var subject = document.getElementById('subject').value;
    var subjectRegex = /^[a-zA-Z\s]{5,}$/; // Regex pour vérifier le sujet (lettres et espaces, au moins 5 caractères)
    if (!subjectRegex.test(subject)) {
        alert("Le sujet doit contenir au moins 5 lettres et peut inclure des espaces");
        return false;
    }

    var message = document.getElementById('message').value;
    var messageRegex = /^.{10,}$/; // Regex pour vérifier le message (au moins 10 caractères)
    if (!messageRegex.test(message)) {
        alert("Le message doit contenir au moins 10 caractères");
        return false;
    }

    document.getElementById('status').innerHTML = "Envoi en cours...";

    var formData = {
        'name': $('input[name=name]').val(),
        'email': $('input[name=email]').val(),
        'subject': $('input[name=subject]').val(),
        'message': $('textarea[name=message]').val()
    };

    $.ajax({
        url: "form.php",
        type: "POST",
        data: formData,
        success: function (data, textStatus, jqXHR) {
            $('#status').text(data.message);
            if (data.code) //If mail was sent successfully, reset the form.
                $('#contact-form').closest('form').find("input[type=text], textarea").val("");
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#status').text(jqXHR);
        }
    });

    return true; // Always return true to allow form submission after AJAX request
}
