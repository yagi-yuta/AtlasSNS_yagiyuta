function toggleAccordion(button) {
  const accordionMenu = button.parentElement;
  accordionMenu.classList.toggle('show');

  button.classList.toggle('active');
}

window.onclick = function (event) {
  if (event.target.closest('.accordion-menu')) {
    return;
  }

  const accordions = document.getElementsByClassName("accordion-menu");
  for (let i = 0; i < accordions.length; i++) {
    const openAccordion = accordions[i];
    if (openAccordion.classList.contains('show')) {
      openAccordion.classList.remove('show');
    }
  }
};
