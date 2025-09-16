$(document).ready(function() {
  $('.navbar-nav .nav-link').on('click', function () {
    $('.navbar-collapse').collapse('hide');
  });

  const floatingInputs = document.querySelectorAll('.floating-input');

  floatingInputs.forEach(input => {
    const label = document.getElementById(input.id + '-label');

    input.style.borderColor = '#f16521';

    input.addEventListener('focus', () => {
      label.classList.add('float-up');
    });

    input.addEventListener('blur', () => {
      if (input.value === '') {
        label.classList.remove('float-up');
      }
    });
  });

  const allCategory = document.querySelectorAll('.frame-category');

  allCategory.forEach(item => {
    item.addEventListener('mouseenter', function () {
      allCategory.forEach(el => {
        el.classList.remove('active');
      });
      item.classList.add('active');

      const id = item.getAttribute('id');
      const idTrimmed = id.trim().toLowerCase();

      const container = document.querySelectorAll('.text-category');
      container.forEach(i => {
        const attr = i.getAttribute('data-category');
        if (attr === idTrimmed) {
          i.style.display = 'block';
          i.classList.add('active');
        } else {
          i.style.display = 'none';
          i.classList.remove('active');
        }
      });
    });
  });
});

