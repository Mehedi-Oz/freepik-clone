// ========== filter toggle ========== 

const chevron = document.querySelector('.chevron');
const target = document.getElementById('filters-section');
let isDown = false;

chevron.addEventListener('click', () => {
  // toggle chevron direction
  chevron.innerHTML = isDown
    ? `<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />` // up
    : `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />`; // down
  isDown = !isDown;

  // toggle section visibility
  if (target) {
    target.style.display = target.style.display === 'none' ? 'flex' : 'none';
  }
});

// ========== filter toggle ========== 

const relevanceChevron = document.getElementById('relevance-chevron');
const relevancePopup = document.getElementById('relevance-popup');

relevanceChevron.addEventListener('click', () => {
  relevancePopup.classList.toggle('hidden');
});

// Get all buttons with class 'filter-toggle'
const buttons = document.querySelectorAll('.filter-toggle');

buttons.forEach(button => {
  button.addEventListener('click', () => {
    const chevron = button.querySelector('.filter-chevron');
    
    // Check current state
    const isDown = chevron.innerHTML.includes('m19.5 8.25');
    
    // Toggle between down and up arrow
    if (isDown) {
      // Change to UP arrow
      chevron.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />`;
    } else {
      // Change to DOWN arrow
      chevron.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />`;
    }
  });
});