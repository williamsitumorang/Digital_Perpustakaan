// sidebar.js
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');
const sidebarToggle = document.getElementById('sidebarToggle');

sidebarToggle.addEventListener('click', function () {
    sidebar.classList.toggle('collapsed');
    content.classList.toggle('shifted');
});
