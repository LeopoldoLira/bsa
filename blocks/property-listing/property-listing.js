document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('property-search');
  const dropdown = document.getElementById('property-taxonomy-filter');
  const container = document.querySelector('.property-listing-block');
  const grid = document.getElementById('property-grid');

  if (!searchInput || !dropdown || !container || !grid) return;

  let timeout = null;

  function fetchResults() {
    const search = searchInput.value;
    const term = dropdown.value;

    const mode = container.dataset.mode;
    const manual = JSON.parse(container.dataset.manual || '[]');

    const params = new URLSearchParams({
      action: 'property_search',
      search: search,
      term: term
    });

    if (mode === 'Manual Select') {
      manual.forEach(id => params.append('manual_ids[]', id));
    }

    fetch(`${propertySearch.ajaxurl}?${params}`)
      .then(res => res.text())
      .then(html => {
        grid.innerHTML = html;
      });
  }

  searchInput.addEventListener('input', () => {
    clearTimeout(timeout);
    timeout = setTimeout(fetchResults, 300);
  });

  dropdown.addEventListener('change', fetchResults);
});
