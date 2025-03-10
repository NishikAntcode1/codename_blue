function sendEmail() {
    Email.send({
    Host : "smtp.gmail.com",
    Username : "nishikantasahoo774@gmail.com",
    Password : "Pt_LKg;M$o9r",
    To : 'nishikantasahoo774@gmail.com',
    From : document.getElementById("email").value,
    Subject : "Enquiry",
    Body : "And this is the body"
  }).then(
    message => alert(message)
  );
  }