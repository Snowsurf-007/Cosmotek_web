const THEME_KEY = 'theme';

function applyTheme(theme) {
  document.documentElement.className = theme;
  localStorage.setItem(THEME_KEY, theme);
  const btn = document.getElementById('theme-bouton');
  if (btn) btn.textContent = theme === 'sombre' ? '☀️ Clair' : '🌙 Sombre';
}

function toggleTheme() {
  const current = localStorage.getItem(THEME_KEY) || 'sombre';
  applyTheme(current === 'sombre' ? 'clair' : 'sombre');
}

document.addEventListener('DOMContentLoaded', () => {
  applyTheme(localStorage.getItem(THEME_KEY) || 'sombre');
  const btn = document.getElementById('theme-bouton');
  if (btn) btn.addEventListener('click', toggleTheme);
});