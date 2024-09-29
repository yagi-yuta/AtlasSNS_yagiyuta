document.querySelectorAll('.modal').forEach(modal => {
  const openButton = document.querySelector('.modal-open[data-id="' + modal.id.split('-')[1] + '"]');
  const closeButton = modal.querySelector('.modal-close-button');

  openButton.addEventListener('click', function () {
    modal.classList.add('show');
  });

  closeButton.addEventListener('click', function () {
    modal.classList.remove('show');
  });
});
