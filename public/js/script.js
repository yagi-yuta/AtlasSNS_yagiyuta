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

const fileSelect = document.getElementById("fileSelect");//fileSelectをdocument.getElementById("fileSelect")と定義
const fileElem = document.getElementById("fileElem");//fileElemをdocument.getElementById("fileElem")と定義

fileSelect.addEventListener("click", () => {
  if (fileElem) {
    fileElem.click();
  }
}, false);
//fileSelect.addEventListener("click",):ボタンがクリックされたときに何かをするように設定
//() => { ... }:ボタンがクリックされたときに実行される動きの設定
//if (fileElem) { ... }:ファイルを選ぶための隠れた部分が存在するか確認
//つまりボタンを押した際に画面上にないファイル選択画面を自動で開く処理

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
    //fileElem.addEventListener("change", function () { ... }):fileElem（ファイル選択の <input>）の内容が変更された時（ファイルが選ばれた時）に実行される処理
    //if (fileElem.files.length > 0)  ファイルが選ばれたかどうかの確認
    //選んだファイル名が長すぎる際レイアウトを崩さないように名前を省略して...拡張子にする設定
    fileSelect.textContent = files;
  } else {
    fileSelect.textContent = 'ファイルを選択';
  }
});
