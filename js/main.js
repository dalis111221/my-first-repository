// ── Mobile Menu ───────────────────────────────────
const toggle = document.getElementById('menuToggle');
const nav    = document.getElementById('navLinks');
if(toggle && nav){
  toggle.addEventListener('click', () => {
    nav.classList.toggle('active');
    toggle.innerHTML = nav.classList.contains('active')
      ? '<i class="fa fa-times"></i>'
      : '<i class="fa fa-bars"></i>';
  });
  document.addEventListener('click', e => {
    if(!toggle.contains(e.target) && !nav.contains(e.target)){
      nav.classList.remove('active');
      toggle.innerHTML = '<i class="fa fa-bars"></i>';
    }
  });
}

// ── Back to Top ───────────────────────────────────
const btt = document.getElementById('backToTop');
if(btt){
  window.addEventListener('scroll', () => {
    btt.style.display = window.scrollY > 400 ? 'flex' : 'none';
  });
  btt.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));
}

// ── Scroll Reveal ─────────────────────────────────
const observer = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if(e.isIntersecting){
      e.target.style.opacity = '1';
      e.target.style.transform = 'translateY(0)';
    }
  });
}, {threshold: 0.1});

document.querySelectorAll('[data-aos]').forEach(el => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(28px)';
  el.style.transition = 'opacity .6s ease, transform .6s ease';
  observer.observe(el);
});

// ── Counter Animation ─────────────────────────────
function animateCounter(el, target){
  let count = 0;
  const step = Math.ceil(target / 60);
  const timer = setInterval(() => {
    count += step;
    if(count >= target){ count = target; clearInterval(timer); }
    el.textContent = count + (el.dataset.suffix||'');
  }, 30);
}
const counterObs = new IntersectionObserver(entries => {
  entries.forEach(e => {
    if(e.isIntersecting){
      const el = e.target;
      const val = parseInt(el.dataset.count||el.textContent);
      if(!isNaN(val)){ animateCounter(el, val); counterObs.unobserve(el); }
    }
  });
},{threshold:0.5});
document.querySelectorAll('.stat-num,.num').forEach(el => counterObs.observe(el));

// ── Alert Auto Close ──────────────────────────────
document.querySelectorAll('.alert').forEach(el => {
  setTimeout(() => { el.style.opacity='0'; el.style.transition='opacity .5s';
    setTimeout(()=>el.remove(),500); }, 5000);
});
