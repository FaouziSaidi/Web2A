console.log("1");
document.addEventListener("DOMContentLoaded", function() {
  const searchInput = document.getElementById('searchInput');
  const rows = document.querySelectorAll('table tbody tr');

  searchInput.addEventListener('input', function(event) {
    const searchTerm = event.target.value.toLowerCase();

    rows.forEach(row => {
      const cells = row.querySelectorAll('td');
      let found = false;
      console.log("2");
      cells.forEach(cell => {
        const cellText = cell.textContent.toLowerCase();
        if (cellText.includes(searchTerm)) {
          found = true;
          console.log("3");
        }
      });

      if (found) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
});

