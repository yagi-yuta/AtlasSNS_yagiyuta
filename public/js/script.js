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

const fileSelect = document.getElementById("fileSelect");
const fileElem = document.getElementById("fileElem");

fileSelect.addEventListener("click", (e) => {
  if (fileElem) {
    fileElem.click();
  }
}, false);

fileElem.addEventListener("change", function () {
  if (fileElem.files.length > 0) {
    const files = Array.from(fileElem.files).map(file => {
      const fileName = file.name;
      const maxLength = 10;
      if (fileName.length > maxLength) {
        const extension = fileName.slice(fileName.lastIndexOf('.'));
        const truncatedName = fileName.slice(0, maxLength - extension.length) + '...' + extension;
        return truncatedName;
      }
      return fileName;
    }).join(', ');

    fileSelect.textContent = files;
  } else {
    fileSelect.textContent = 'ファイルを選択';
  }
});
