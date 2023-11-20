

document.getElementById('myForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var nam = document.getElementById('name').value;
    var mail = document.getElementById('email').value;
    var phon = document.getElementById('phone').value;
    var ages = document.getElementById('age').value;
    var date = document.getElementById('date').value;
    var sex = document.getElementById('sex').value;
    var sexe = document.getElementById('sex1').value;
    var time = document.getElementById('time').value;
  
    if (!isValidName(nam)) {
      alert('Veuillez entrer un nom valide.');
      event.preventDefault();
    }
  
    if (!isValidEmail(mail)) {
      alert('Veuillez entrer une adresse email valide.');
      event.preventDefault();
    }
  
    if (!isValidPhone(phon)) {
      alert('Veuillez entrer un numéro de téléphone valide.');
      event.preventDefault();
    }
  
    if (!isValidAge(ages)) {
      alert('Veuillez entrer un âge valide.');
      event.preventDefault();
    }
  
    // Ajoutez d'autres validations selon vos besoins...
  
  });
  
  function isValidName(nam) {
    // Le nom doit contenir uniquement des lettres et peut inclure des espaces
    var nameRegex = /^[a-zA-Z\s]+$/;
    return nameRegex.test(nam);
  }
  
  function isValidEmail(mail) {
    // Utilisez une expression régulière pour valider l'adresse email
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(mail);
  }
  
  function isValidPhone(phon) {
    // Le numéro de téléphone doit contenir uniquement des chiffres et peut inclure des espaces, des parenthèses et des tirets
    var phoneRegex = /^[0-9\s\(\)-]+$/;
    return phoneRegex.test(phon);
  }
  
  function isValidAge(ages) {
    // L'âge doit être un nombre positif
    return !isNaN(ages) && parseInt(ages) > 0;
  }
  