
  let currentIndex = 0;

  const container = document.getElementById('projectContainer');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const dotsContainer = document.getElementById('carouselDots');

  function renderProject(index) {
    const project = projects[index];
    const categorySlug = project.category_name
      .toLowerCase()
      .replace(/\s+/g, '-');

    // αφαιρούμε την κλάση για το fade
    container.classList.remove('show');
    // Ορίζουμε το data-category attribute
    container.setAttribute('data-category', categorySlug);

    container.innerHTML = `
      <h2>${project.title}</h2>
      <p><strong>Κατηγορία:</strong> ${project.category_name}</p>
      ${project.image_url 
        ? `<img id="carouselImage" src="${project.image_url}" alt="Project Image">` 
        : ''}
      <p><strong>Περιγραφή:</strong> ${project.description.replace(/\n/g, '<br>')}</p>
      ${project.project_url 
        ? `<p><a href="${project.project_url}" target="_blank">Δες το έργο μου εδώ 👆</a></p>` 
        : ''}
    `;

    //  Μικρό delay ώστε να αργήσει το transition της show
    setTimeout(() => container.classList.add('show'), 50);

    //  Ενημέρωση dots και lightbox
    renderDots();
    bindLightbox();
  }

  

    prevBtn.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + projects.length) % projects.length;
    renderProject(currentIndex);
    });

    nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % projects.length;
    renderProject(currentIndex);
    });



  renderProject(currentIndex);


function renderDots() {
  dotsContainer.innerHTML = '';
  for (let i = 0; i < projects.length; i++) {
    const dot = document.createElement('span');
    dot.className = 'dot';
    if (i === currentIndex) {
      dot.classList.add('active');
    }
    dot.addEventListener('click', () => {
      currentIndex = i;
      renderProject(currentIndex);
    });
    dotsContainer.appendChild(dot);
  }
}

renderDots();

// Αυτόματη εναλλαγή εργων στο carousel

let slideInterval = null;

function startAutoSlide() {
  // Καθαρίζουμε προηγούμενο, αν υπάρχει
  if (slideInterval !== null) {
    clearInterval(slideInterval);
  }
  slideInterval = setInterval(() => {
    currentIndex = (currentIndex + 1) % projects.length;
    renderProject(currentIndex);
  }, 5000);
}

function stopAutoSlide() {
  if (slideInterval !== null) {
    clearInterval(slideInterval);
    slideInterval = null;
  }
}

renderProject(currentIndex);
startAutoSlide();

// pause on hover:
const carouselEl = document.querySelector('.project-carousel');
carouselEl.addEventListener('mouseenter', stopAutoSlide);
carouselEl.addEventListener('mouseleave', startAutoSlide);

// lightbox functionality

function bindLightbox() {
  const img = document.getElementById('carouselImage');
  const lightbox = document.getElementById('lightbox');
  const lightboxImg = document.getElementById('lightboxImg');
  const closeBtn = document.getElementById('lightboxClose');


  if (!img)
    return; // Αν δεν υπάρχει εικόνα return
  img.style.cursor = 'pointer';
  img.addEventListener('click', () => {
    stopAutoSlide();
    lightboxImg.src = img.src;
    lightbox.classList.add('show');
  });
  closeBtn.addEventListener('click', () => {
    lightbox.classList.remove('show');
    startAutoSlide();
  });
  lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) {
      lightbox.classList.remove('show');
    }
  });
}

bindLightbox();


// Back to top button
const backToTopBtn = document.getElementById('backToTop');
window.addEventListener('scroll', () => {
  if (window.scrollY > window.innerHeight / 2) {
    backToTopBtn.classList.add('show');
  } else {
    backToTopBtn.classList.remove('show');
  }
});
backToTopBtn.addEventListener('click', () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

// scroll progress bar 
const progressBar = document.getElementById('scrollProgress');
window.addEventListener('scroll', () => {
  const scrollTop = window.scrollY;
  const docHeight = document.documentElement.scrollHeight - window.innerHeight;
  const percent = (scrollTop / docHeight) * 100;
  progressBar.style.width = percent + '%';
});