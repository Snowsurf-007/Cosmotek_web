const THEME_KEY = 'theme';

function getCookie(name) {
  const match = document.cookie
    .split('; ')
    .find(row => row.startsWith(name + '='));
  return match ? decodeURIComponent(match.split('=')[1]) : null;
}

function saveThemeCookie(theme) {
  const formData = new FormData();
  formData.append('theme', theme);

  fetch('set_theme.php', {
    method: 'POST',
    body: formData,
  }).catch(err => console.error('Erreur sauvegarde thème :', err));
}

function applyTheme(theme) {
  const oldLink = document.getElementById('theme-css');
  if (oldLink) oldLink.remove();

  const link = document.createElement('link');
  link.rel = 'stylesheet';
  link.id = 'theme-css';
  link.href = theme === 'sombre' ? 'black.css' : 'white.css';
  document.head.appendChild(link);

  saveThemeCookie(theme);
  localStorage.setItem(THEME_KEY, theme);

  const btn = document.getElementById('theme-bouton');
  if (btn) btn.textContent = theme === 'sombre' ? '☀️ Clair' : '🌙 Sombre';
}

function toggleTheme() {
  const current = getCookie(THEME_KEY) || localStorage.getItem(THEME_KEY) || 'sombre';
  applyTheme(current === 'sombre' ? 'clair' : 'sombre');
}

document.addEventListener('DOMContentLoaded', () => {
  const theme = getCookie(THEME_KEY) || localStorage.getItem(THEME_KEY) || 'sombre';
  applyTheme(theme);

  const btn = document.getElementById('theme-bouton');
  if (btn) btn.addEventListener('click', toggleTheme);
});