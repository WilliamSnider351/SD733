document.addEventListener('DOMContentLoaded', () => {
  const form      = document.getElementById('applicationForm');
  const section   = document.getElementById('formSection');
  const confirmEl = document.getElementById('confirmationMessage');

  const fields = {
    name: document.getElementById('name'),
    age: document.getElementById('age'),
    email: document.getElementById('email'),
    position: document.getElementById('position'),
    experience: document.getElementById('experience'),
    availability: document.getElementById('availability')
  };

  const errors = {
    name: document.getElementById('nameError'),
    age: document.getElementById('ageError'),
    email: document.getElementById('emailError'),
    position: document.getElementById('positionError'),
    experience: document.getElementById('experienceError'),
    availability: document.getElementById('availabilityError')
  };

  function validate() {
    let ok = true;
    if (!fields.name.value.trim())              { errors.name.style.display = 'block';        ok = false; } else errors.name.style.display = 'none';
    const a = parseInt(fields.age.value, 10);
    if (isNaN(a) || a < 10 || a > 50)           { errors.age.style.display = 'block';         ok = false; } else errors.age.style.display = 'none';
    const re = /^\S+@\S+\.\S+$/;
    if (!re.test(fields.email.value.trim()))    { errors.email.style.display = 'block';       ok = false; } else errors.email.style.display = 'none';
    if (!fields.position.value)                 { errors.position.style.display = 'block';    ok = false; } else errors.position.style.display = 'none';
    if (!fields.experience.value)               { errors.experience.style.display = 'block';  ok = false; } else errors.experience.style.display = 'none';
    if (!fields.availability.value.trim())      { errors.availability.style.display = 'block';ok = false; } else errors.availability.style.display = 'none';
    return ok;
  }

  form.addEventListener('submit', e => {
    e.preventDefault();
    if (validate()) {
      section.style.display = 'none';
      confirmEl.style.display = 'block';
      window.scrollTo({ top: document.body.scrollHeight, behavior: 'smooth' });
    }
  });
});
