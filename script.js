// Simple client-side search: filters product cards by title
function handleSearch(e){
  e.preventDefault();
  const form = e.target;
  const q = (form.q.value || '').trim().toLowerCase();
  const cards = document.querySelectorAll('.product, .product-card');
  if(!q){
    cards.forEach(c=>c.style.display='');
    return false;
  }
  cards.forEach(c=>{
    const title = (c.querySelector('h3')?.textContent||'').toLowerCase();
    if(title.includes(q)) c.style.display='flex'; else c.style.display='none';
  });
  return false;
}

// Newsletter subscribe — mock behaviour
function subscribeNewsletter(e){
  e.preventDefault();
  const email = document.getElementById('newsletter-email').value;
  const msg = document.getElementById('newsletter-msg');
  if(!email || !email.includes('@')){ msg.textContent='Please enter a valid email.'; msg.style.color='crimson'; return false; }
  // Simulate success
  msg.style.color='green';
  msg.textContent='Thanks — you are subscribed!';
  document.getElementById('newsletter-email').value='';
  setTimeout(()=> msg.textContent='',5000);
  return false;
}

// Optional: highlight search term in results (small helper)
function highlightTerm(node, term){
  if(!term) return;
}

// Attach handlers on DOM ready: wire search forms and mobile search button
document.addEventListener('DOMContentLoaded', function(){
  // Attach submit handler to any search-bar forms
  document.querySelectorAll('.search-bar').forEach(function(form){
    form.addEventListener('submit', function(e){
      // If we're on the store page with product cards, run client-side filter
      if(document.querySelectorAll('.product, .product-card').length){
        handleSearch(e);
      } else {
        // fallback: allow form to submit (navigate to gadgetstore.html with query)
      }
    });
  });

  // Mobile header search toggle: open header-bottom and focus input
  document.querySelectorAll('.header-search').forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault();
      var hb = document.querySelector('.header-bottom');
      if(!hb) return;
      hb.classList.toggle('active');
      var inp = hb.querySelector('input[type=search]');
      if(inp){ setTimeout(function(){ inp.focus(); }, 60); }
    });
  });

  // Mobile portrait search input for products (real-time filtering)
  var mobileSearchInput = document.getElementById('mobile-search-input');
  var headerSearchInput = document.getElementById('header-search-input');

  function filterProducts(q){
    q = (q || '').trim().toLowerCase();
    var cards = document.querySelectorAll('.product, .product-card');
    cards.forEach(function(card){
      var title = (card.querySelector('h3')?.textContent || '').toLowerCase();
      if(q === ''){
        card.style.display = '';
      } else {
        card.style.display = title.includes(q) ? '' : 'none';
      }
    });
  }

  if(mobileSearchInput){
    mobileSearchInput.addEventListener('input', function(e){
      filterProducts(e.target.value);
      // Sync header search input
      if(headerSearchInput) headerSearchInput.value = e.target.value;
    });
  }

  if(headerSearchInput){
    headerSearchInput.addEventListener('input', function(e){
      filterProducts(e.target.value);
      // Sync mobile search input
      if(mobileSearchInput) mobileSearchInput.value = e.target.value;
    });
  }
});
