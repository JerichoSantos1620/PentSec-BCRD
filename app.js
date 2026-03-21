// === SCROLL ANIMATIONS ===
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.animate-on-scroll').forEach(el => observer.observe(el));

// === NAVBAR SCROLL ===
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 50);
});

// === MOBILE MENU ===
const mobileToggle = document.getElementById('mobile-toggle');
const mobileMenu = document.getElementById('mobile-menu');
mobileToggle.addEventListener('click', () => {
  mobileMenu.classList.toggle('hidden');
});
document.querySelectorAll('.mobile-link').forEach(link => {
  link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
});

// === SMOOTH SCROLL ===
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) target.scrollIntoView({ behavior: 'smooth' });
  });
});

// === VERIFY TABS ===
function switchVerifyTab(tab) {
  document.getElementById('tab-code').classList.toggle('active', tab === 'code');
  document.getElementById('tab-upload').classList.toggle('active', tab === 'upload');
  document.getElementById('verify-code-panel').classList.toggle('hidden', tab !== 'code');
  document.getElementById('verify-upload-panel').classList.toggle('hidden', tab !== 'upload');
  document.getElementById('verify-result').classList.add('hidden');
}

// === VERIFY SIMULATION ===
function simulateVerify() {
  const resultEl = document.getElementById('verify-result');
  resultEl.classList.remove('hidden');
  
  // Loading state
  resultEl.innerHTML = `
    <div class="flex items-center justify-center gap-3 py-6">
      <div class="w-5 h-5 border-2 border-electric-500 border-t-transparent rounded-full animate-spin"></div>
      <span class="text-sm text-navy-300">Verifying cryptographic signature...</span>
    </div>
  `;

  setTimeout(() => {
    const code = document.getElementById('verify-input').value || 'EP-2026-A7K3-M9X2';
    const now = new Date().toLocaleString();
    resultEl.innerHTML = `
      <div class="result-animate">
        <div class="flex items-center gap-3 mb-4">
          <div class="check-animate w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center">
            <svg class="w-5 h-5 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/></svg>
          </div>
          <div>
            <p class="font-semibold text-emerald-400">Document Verified</p>
            <p class="text-xs text-navy-400">Cryptographic signature is valid and untampered</p>
          </div>
        </div>
        <div class="space-y-2.5 p-4 rounded-xl bg-navy-800/30 border border-white/5">
          <div class="flex justify-between text-xs"><span class="text-navy-400">Verification Code</span><span class="font-mono text-electric-400">${code}</span></div>
          <div class="flex justify-between text-xs"><span class="text-navy-400">Document Type</span><span>Barangay Clearance</span></div>
          <div class="flex justify-between text-xs"><span class="text-navy-400">Issued To</span><span>Juan Dela Cruz</span></div>
          <div class="flex justify-between text-xs"><span class="text-navy-400">Signed By</span><span>BCRD District 2 Sub-CA</span></div>
          <div class="flex justify-between text-xs"><span class="text-navy-400">Timestamp</span><span class="font-mono text-[11px]">${now}</span></div>
          <div class="flex justify-between text-xs"><span class="text-navy-400">Hash Algorithm</span><span class="font-mono">SHA-256</span></div>
          <div class="flex justify-between text-xs"><span class="text-navy-400">Signature</span><span class="font-mono text-[11px] text-emerald-400">Valid ✓</span></div>
          <div class="flex justify-between text-xs"><span class="text-navy-400">Certificate Chain</span><span class="font-mono text-[11px] text-emerald-400">Trusted ✓</span></div>
        </div>
      </div>
    `;
  }, 1800);
}

// === FILE UPLOAD ===
function handleFileSelect(event) {
  const file = event.target.files[0];
  if (file) {
    const dropZone = document.getElementById('drop-zone');
    dropZone.innerHTML = `
      <svg class="w-8 h-8 mx-auto text-emerald-400 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
      <p class="text-sm text-emerald-400 font-medium">${file.name}</p>
      <p class="text-xs text-navy-500 mt-0.5">${(file.size / 1024).toFixed(1)} KB</p>
    `;
  }
}

// Drag and drop
const dropZone = document.getElementById('drop-zone');
if (dropZone) {
  ['dragenter', 'dragover'].forEach(e => {
    dropZone.addEventListener(e, (ev) => { ev.preventDefault(); dropZone.classList.add('border-electric-500/50'); });
  });
  ['dragleave', 'drop'].forEach(e => {
    dropZone.addEventListener(e, (ev) => { ev.preventDefault(); dropZone.classList.remove('border-electric-500/50'); });
  });
  dropZone.addEventListener('drop', (ev) => {
    const file = ev.dataTransfer.files[0];
    if (file) {
      const dt = new DataTransfer();
      dt.items.add(file);
      document.getElementById('file-input').files = dt.files;
      handleFileSelect({ target: { files: [file] } });
    }
  });
}

// === DOCUMENT REQUEST FORM ===
let selectedDocType = '';

function selectDocType(btn, type) {
  document.querySelectorAll('.doc-type-btn').forEach(b => b.classList.remove('selected'));
  btn.classList.add('selected');
  selectedDocType = type;
  const nextBtn = document.getElementById('req-next-1');
  nextBtn.disabled = false;
  nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
  nextBtn.classList.add('hover:shadow-lg', 'hover:shadow-electric-500/25', 'hover:-translate-y-0.5');
}

function goToStep(step) {
  document.querySelectorAll('[id^="req-step-"]').forEach(el => el.classList.add('hidden'));
  document.getElementById(`req-step-${step}`).classList.remove('hidden');
  
  // Update step indicators
  document.querySelectorAll('.step-indicator').forEach(ind => {
    const s = parseInt(ind.dataset.step);
    ind.classList.remove('active', 'completed');
    if (s === step) ind.classList.add('active');
    else if (s < step) ind.classList.add('completed');
  });

  // Build summary for step 3
  if (step === 3) {
    const summary = document.getElementById('req-summary');
    const name = document.getElementById('req-name').value || 'Not provided';
    const email = document.getElementById('req-email').value || 'Not provided';
    const phone = document.getElementById('req-phone').value || 'Not provided';
    const address = document.getElementById('req-address').value || 'Not provided';
    const purpose = document.getElementById('req-purpose').value || 'Not provided';
    summary.innerHTML = `
      <div class="p-4 rounded-xl bg-navy-800/30 border border-white/5 space-y-2.5">
        <h4 class="text-sm font-semibold text-electric-400 mb-3">Request Summary</h4>
        <div class="flex justify-between text-xs"><span class="text-navy-400">Document Type</span><span class="font-medium">${selectedDocType}</span></div>
        <div class="flex justify-between text-xs"><span class="text-navy-400">Full Name</span><span>${name}</span></div>
        <div class="flex justify-between text-xs"><span class="text-navy-400">Email</span><span>${email}</span></div>
        <div class="flex justify-between text-xs"><span class="text-navy-400">Contact</span><span>${phone}</span></div>
        <div class="flex justify-between text-xs"><span class="text-navy-400">Address</span><span class="text-right max-w-[200px]">${address}</span></div>
        <div class="flex justify-between text-xs"><span class="text-navy-400">Purpose</span><span class="text-right max-w-[200px]">${purpose}</span></div>
      </div>
    `;
  }
}

function submitRequest() {
  const stepsContainer = document.getElementById('req-step-3');
  const successEl = document.getElementById('req-success');
  stepsContainer.classList.add('hidden');
  
  // Update all steps to completed
  document.querySelectorAll('.step-indicator').forEach(ind => {
    ind.classList.remove('active');
    ind.classList.add('completed');
  });

  // Generate tracking number
  const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
  let tracking = 'EP-';
  for (let i = 0; i < 4; i++) tracking += chars[Math.floor(Math.random() * chars.length)];
  tracking += '-';
  for (let i = 0; i < 4; i++) tracking += chars[Math.floor(Math.random() * chars.length)];

  successEl.classList.remove('hidden');
  successEl.innerHTML = `
    <div class="result-animate">
      <div class="check-animate w-16 h-16 rounded-full bg-emerald-500/20 flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd"/></svg>
      </div>
      <h3 class="text-xl font-bold text-emerald-400 mb-2">Request Submitted!</h3>
      <p class="text-sm text-navy-300 mb-6">Your document request has been received and is being processed.</p>
      <div class="p-4 rounded-xl bg-navy-800/30 border border-white/5 inline-block">
        <p class="text-xs text-navy-400 mb-1">Your Tracking Number</p>
        <p class="text-2xl font-mono font-bold text-electric-400 tracking-wider">${tracking}</p>
      </div>
      <p class="text-xs text-navy-500 mt-4">Save this number to check your request status. Estimated processing: 3-5 business days.</p>
    </div>
  `;
}

// === CONTACT FORM ===
function handleContact(e) {
  e.preventDefault();
  document.getElementById('contact-success').classList.remove('hidden');
  setTimeout(() => {
    document.getElementById('contact-success').classList.add('hidden');
  }, 5000);
}
