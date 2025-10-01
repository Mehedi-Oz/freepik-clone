// ========== close theme popup ========== 

document.addEventListener('click', function (e) {
  const details = document.querySelectorAll('details');
  details.forEach(detail => {
    if (detail.open && !detail.contains(e.target)) {
      detail.open = false;
    }
  });
});

// ========== filter toggle ========== 

const chevron = document.querySelector('.chevron');
const target = document.getElementById('filters-section');
let isDown = false;

chevron?.addEventListener('click', () => {
  chevron.innerHTML = isDown
    ? `<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />`
    : `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />`;
  isDown = !isDown;
  if (target) {
    target.style.display = target.style.display === 'none' ? 'flex' : 'none';
  }
});

// ========== relevance toggle ========== 

const relevanceChevron = document.getElementById('relevance-chevron');
const relevancePopup = document.getElementById('relevance-popup');

relevanceChevron?.addEventListener('click', () => {
  relevancePopup.classList.toggle('hidden');
});

// ========== filter popups toggle ========== 

document.addEventListener('DOMContentLoaded', () => {
  // Main filters
  const licenseBtn = document.getElementById('license-btn');
  const licensePopup = document.getElementById('license-popup');
  const licenseChevron = document.getElementById('license-chevron');

  const aiBtn = document.getElementById('ai-btn');
  const aiPopup = document.getElementById('ai-popup');
  const aiChevron = document.getElementById('ai-chevron');

  const orientationBtn = document.getElementById('orientation-btn');
  const orientationPopup = document.getElementById('orientation-popup');
  const orientationChevron = document.getElementById('orientation-chevron');

  const colorBtn = document.getElementById('color-btn');
  const colorPopup = document.getElementById('color-popup');
  const colorChevron = document.getElementById('color-chevron');

  // People filters
  const peopleBtn = document.getElementById('people-btn');
  const peoplePopup = document.getElementById('people-popup');
  const peopleChevron = document.getElementById('people-chevron');

  const genderBtn = document.getElementById('gender-btn');
  const genderPopup = document.getElementById('gender-popup');
  const genderChevron = document.getElementById('gender-chevron');

  const ageBtn = document.getElementById('age-btn');
  const agePopup = document.getElementById('age-popup');
  const ageChevron = document.getElementById('age-chevron');

  const ethnicityBtn = document.getElementById('ethnicity-btn');
  const ethnicityPopup = document.getElementById('ethnicity-popup');
  const ethnicityChevron = document.getElementById('ethnicity-chevron');

  const filetypeBtn = document.getElementById('filetype-btn');
  const filetypePopup = document.getElementById('filetype-popup');
  const filetypeChevron = document.getElementById('filetype-chevron');

  const advancedBtn = document.getElementById('advanced-btn');
  const advancedPopup = document.getElementById('advanced-popup');
  const advancedChevron = document.getElementById('advanced-chevron');

 
  function closeAllPopups(except) {
    const popups = [
      { popup: licensePopup, chevron: licenseChevron },
      { popup: aiPopup, chevron: aiChevron },
      { popup: orientationPopup, chevron: orientationChevron },
      { popup: colorPopup, chevron: colorChevron },
      { popup: peoplePopup, chevron: peopleChevron },
      { popup: genderPopup, chevron: genderChevron },
      { popup: agePopup, chevron: ageChevron },
      { popup: ethnicityPopup, chevron: ethnicityChevron },
      { popup: filetypePopup, chevron: filetypeChevron },
      { popup: advancedPopup, chevron: advancedChevron }
    ];
    popups.forEach(({ popup, chevron }) => {
      if (popup && popup !== except) {
        popup.classList.add('hidden');
        chevron?.classList.remove('rotate-180');
      }
    });
  }

  licenseBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    closeAllPopups(licensePopup);
    licensePopup.classList.toggle('hidden');
    licenseChevron.classList.toggle('rotate-180');
  });

  aiBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    closeAllPopups(aiPopup);
    aiPopup.classList.toggle('hidden');
    aiChevron.classList.toggle('rotate-180');
  });

  orientationBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    closeAllPopups(orientationPopup);
    orientationPopup.classList.toggle('hidden');
    orientationChevron.classList.toggle('rotate-180');
  });

  colorBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    closeAllPopups(colorPopup);
    colorPopup.classList.toggle('hidden');
    colorChevron.classList.toggle('rotate-180');
  });

  peopleBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    closeAllPopups(peoplePopup);
    peoplePopup.classList.toggle('hidden');
    peopleChevron.classList.toggle('rotate-180');
  });

  genderBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    genderPopup.classList.toggle('hidden');
    genderChevron.classList.toggle('rotate-180');
    agePopup.classList.add('hidden');
    ageChevron.classList.remove('rotate-180');
    ethnicityPopup.classList.add('hidden');
    ethnicityChevron.classList.remove('rotate-180');
  });

  ageBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    agePopup.classList.toggle('hidden');
    ageChevron.classList.toggle('rotate-180');
    genderPopup.classList.add('hidden');
    genderChevron.classList.remove('rotate-180');
    ethnicityPopup.classList.add('hidden');
    ethnicityChevron.classList.remove('rotate-180');
  });

  ethnicityBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    ethnicityPopup.classList.toggle('hidden');
    ethnicityChevron.classList.toggle('rotate-180');
    genderPopup.classList.add('hidden');
    genderChevron.classList.remove('rotate-180');
    agePopup.classList.add('hidden');
    ageChevron.classList.remove('rotate-180');
  });

  filetypeBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    closeAllPopups(filetypePopup);
    filetypePopup.classList.toggle('hidden');
    filetypeChevron.classList.toggle('rotate-180');
  });

  advancedBtn?.addEventListener('click', (e) => {
    e.stopPropagation();
    closeAllPopups(advancedPopup);
    advancedPopup.classList.toggle('hidden');
    advancedChevron.classList.toggle('rotate-180');
  });


  document.addEventListener('click', () => {
    closeAllPopups(null);
  });
});


document.querySelectorAll('.people-count-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.people-count-btn').forEach(b => b.classList.remove('bg-green-600'));
    this.classList.add('bg-green-600');
  });
});
document.querySelectorAll('.author-mode-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.author-mode-btn').forEach(b => b.classList.remove('bg-green-600'));
    this.classList.add('bg-green-600');
  });
});
document.querySelectorAll('.result-variety-btn').forEach(btn => {
  btn.addEventListener('click', function () {
    document.querySelectorAll('.result-variety-btn').forEach(b => b.classList.remove('bg-green-600'));
    this.classList.add('bg-green-600');
  });
});