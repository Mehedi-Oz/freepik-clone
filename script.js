document.querySelectorAll('.chevron').forEach(chevron => {
  let isDown = true;
  chevron.addEventListener('click', () => {
    chevron.innerHTML = isDown
      ? `<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />`
      : `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />`;
    isDown = !isDown;
  });
});