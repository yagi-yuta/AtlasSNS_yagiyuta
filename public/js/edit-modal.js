document.querySelectorAll('.modal-open').forEach(openButton => {
  const modalId = openButton.dataset.id; // ボタンのデータ属性からIDを取得
  const modal = document.getElementById('modal-' + modalId); // モーダルを取得

  openButton.addEventListener('click', function () {
    modal.classList.add('show'); // モーダルを表示
  });
});

document.querySelectorAll('.delete-modal-open').forEach(openButton => {
  const modalId = 'delete-modal-' + openButton.dataset.id; // 削除モーダルのIDを取得
  const modal = document.getElementById(modalId); // 削除モーダルを取得

  openButton.addEventListener('click', function () {
    modal.classList.add('show'); // 削除モーダルを表示
  });
});

document.querySelectorAll('.modal-close-button').forEach(closeButton => {
  closeButton.addEventListener('click', function () {
    const modal = closeButton.closest('.modal'); // モーダルを取得
    modal.classList.remove('show'); // モーダルを非表示
  });
});
