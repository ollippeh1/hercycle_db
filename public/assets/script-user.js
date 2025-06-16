// === TAB BUTTON TOGGLE ===
const tabButtons = document.querySelectorAll('.tab-btn');
const tabContents = document.querySelectorAll('.tab-content');

tabButtons.forEach(button => {
  button.addEventListener('click', () => {
    const tab = button.dataset.tab;

    // Toggle active tab button
    tabButtons.forEach(btn => btn.classList.remove('active'));
    button.classList.add('active');

    // Show/hide tab content
    tabContents.forEach(content => {
      const contentType = content.dataset.content;
      if (tab === 'semua' || contentType === tab) {
        content.classList.remove('hidden');
      } else {
        content.classList.add('hidden');
      }
    });
  });
});

// === SIDEBAR MENU TOGGLE ===
const sidebarMenus = document.querySelectorAll('.sidebar .menu-btn');

sidebarMenus.forEach(menu => {
  menu.addEventListener('click', () => {
    sidebarMenus.forEach(btn => btn.classList.remove('active'));
    menu.classList.add('active');
  });
});

const logoutBtn = document.getElementById('logout-btn');

logoutBtn.addEventListener('click', () => {
  // Contoh aksi logout sederhana:
  alert('Anda telah logout!');
  
  // Jika ingin redirect ke halaman login:
  window.location.href = 'login.html'; // Ganti dengan file login milikmu
});

const profilBtn = document.getElementById('profil-btn');

profilBtn.addEventListener('click', () => {
  window.location.href = 'profil.html'; // Ganti dengan nama file halaman profil kamu
});

// === SEARCH FUNCTIONALITY ===
const searchInput = document.getElementById('searchInput');
const articleBoxes = document.querySelectorAll('.article-box');

searchInput.addEventListener('input', function() {
  const searchTerm = this.value.toLowerCase();
  
  articleBoxes.forEach(box => {
    const title = box.querySelector('h3').textContent.toLowerCase();
    const content = box.querySelector('p').textContent.toLowerCase();
    
    if (title.includes(searchTerm) || content.includes(searchTerm)) {
      box.style.display = 'block';
    } else {
      box.style.display = 'none';
    }
  });
});