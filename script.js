const sidebarItems = document.querySelectorAll('.sidebar-item');
const sections = document.querySelectorAll('.content-section');

sidebarItems.forEach((item) => {
  item.addEventListener('click', () => {
    // Remove active from all sidebar items
    sidebarItems.forEach(i => i.classList.remove('active'));
    // Add active to clicked sidebar item
    item.classList.add('active');

    const sectionId = item.getAttribute('data-section');

    // Hide all sections
    sections.forEach(section => {
      section.classList.remove('active-section');
    });

    // Show the selected section
    document.getElementById(sectionId).classList.add('active-section');
  });
});


