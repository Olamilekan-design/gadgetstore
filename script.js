// Simple client-side search: filters product cards by title
function handleSearch(e){
  e.preventDefault();
  const form = e.target;
  const q = (form.q.value || '').trim().toLowerCase();
  const cards = document.querySelectorAll('.product-card');
  if(!q){
    cards.forEach(c=>c.style.display='flex');
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
