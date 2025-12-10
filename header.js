// Minimal React header component (UMD / no JSX)
// Requires React and ReactDOM UMD to be loaded before this script.
(function(){
  if(typeof React === 'undefined' || typeof ReactDOM === 'undefined') return;
  var e = React.createElement;

  function Header(){
    var useState = React.useState;
    var useEffect = React.useEffect;
    var [active, setActive] = useState(window.location.pathname.split('/').pop() || 'index.html');
    var [showSearch, setShowSearch] = useState(false);
    var [showCart, setShowCart] = useState(false);
    var [cartCount, setCartCount] = useState( (function(){ var el = document.getElementById('item-count'); return el ? Number(el.textContent)||0 : 0; })() );

    useEffect(function(){
      // listen for updates to #item-count (if a script updates it)
      var el = document.getElementById('item-count');
      if(!el) return;
      var obs = new MutationObserver(function(){ setCartCount(Number(el.textContent)||0); });
      obs.observe(el, { childList:true, characterData:true, subtree:true });
      return function(){ obs.disconnect(); };
    }, []);

    function linkClick(e, href){
      e.preventDefault();
      setActive(href);
      window.location.href = href; // fallback to normal navigation
    }

    return e('header', { className: 'react-header site-header compact', role:'banner' },
      e('div', { className: 'brand-wrap' }, e('a', { href:'index.html', className:'brand' }, 'Big City Gadget')),
      e('nav', { className:'main-nav', 'aria-label':'Primary' },
        e('a', { href:'index.html', onClick:function(ev){ linkClick(ev,'index.html'); }, 'aria-current': active==='index.html' ? 'page': undefined }, 'Home'),
        e('a', { href:'gadgetstore.html', onClick:function(ev){ linkClick(ev,'gadgetstore.html'); }, 'aria-current': active==='gadgetstore.html' ? 'page': undefined }, 'Store'),
        e('a', { href:'about.html', onClick:function(ev){ linkClick(ev,'about.html'); }, 'aria-current': active==='about.html' ? 'page': undefined }, 'About'),
        e('a', { href:'contact.html', onClick:function(ev){ linkClick(ev,'contact.html'); }, 'aria-current': active==='contact.html' ? 'page': undefined }, 'Contact')
      ),
      e('div', { className:'header-actions' },
        e('button', { className:'icon-btn search-toggle', 'aria-label':'Toggle search', onClick:function(){ setShowSearch(!showSearch); } }, '🔍'),
        e('button', { className:'icon-btn cart-toggle', 'aria-label':'Toggle cart', onClick:function(){ setShowCart(!showCart); } }, '🛒', e('span',{id:'header-cart-count', 'aria-hidden':'true', style:{marginLeft:6, fontWeight:700} }, cartCount)),
        e('a', { className:'btn-primary', href:'gadgetstore.html' }, 'Shop')
      ),
      showSearch ? e('div',{className:'search-inline'}, e('input',{type:'search', placeholder:'Search gadgets, brands...', 'aria-label':'Search'}), e('button',{onClick:function(){ setShowSearch(false); }}, 'Close')) : null,
      showCart ? e('div',{className:'cart-inline', role:'region','aria-label':'Shopping cart preview'}, e('div',{className:'cart-inner'}, e('p',null,'Cart items: ' + cartCount), e('a',{href:'cart.php'}, 'View cart'))) : null
    );
  }

  try{
    var mount = document.getElementById('react-header-root');
    if(mount){
      ReactDOM.createRoot(mount).render(e(Header));
    }
  }catch(err){ console.error('Header mount failed', err); }

})();
