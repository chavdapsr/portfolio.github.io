  // Initialize AOS (Animate On Scroll)
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });

        // Create floating particles with anime.js
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particlesContainer.appendChild(particle);
            }
            
            // Animate particles with anime.js
            anime({
                targets: '.particle',
                translateX: () => anime.random(-100, 100),
                translateY: () => anime.random(-100, 100),
                scale: () => anime.random(0.5, 1.5),
                opacity: () => anime.random(0.2, 0.8),
                duration: () => anime.random(3000, 6000),
                easing: 'easeInOutSine',
                loop: true,
                direction: 'alternate'
            });
        }

        // Skill cards animation with anime.js
        function animateSkills() {
            anime({
                targets: '.skill',
                scale: [0, 1],
                opacity: [0, 1],
                translateY: [50, 0],
                delay: anime.stagger(100),
                duration: 800,
                easing: 'easeOutElastic(1, .8)'
            });
        }

        // Profile image hover animation
        document.querySelector('.profile-image').addEventListener('mouseenter', function() {
            anime({
                targets: this,
                scale: [1, 1.1],
                rotate: [0, 360],
                duration: 1000,
                easing: 'easeInOutElastic(1, .6)'
            });
        });

        // Navigation items wave animation
        function animateNavItems() {
            anime({
                targets: '.nav-item',
                translateY: [30, 0],
                opacity: [0, 1],
                delay: anime.stagger(100, {start: 300}),
                duration: 800,
                easing: 'easeOutBounce'
            });
        }

        // Form submission with anime.js feedback
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Animate form button
            anime({
                targets: '.form-button',
                scale: [1, 0.95, 1.05, 1],
                duration: 600,
                easing: 'easeInOutQuad'
            });
            
            // Show success message with animation
            const button = document.querySelector('.form-button');
            const originalText = button.textContent;
            button.textContent = 'Message Sent!';
            button.style.background = 'linear-gradient(145deg, #32cd32, #228b22)';
            
            setTimeout(() => {
                button.textContent = originalText;
                button.style.background = '';
                this.reset();
            }, 2000);
        });

        // Smooth scrolling with anime.js
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    anime({
                        targets: 'html, body',
                        scrollTop: target.offsetTop - 100,
                        duration: 1000,
                        easing: 'easeInOutCubic'
                    });
                }
            });
        });

        // Project cards stagger animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (entry.target.id === 'projects') {
                        anime({
                            targets: '.project',
                            translateX: [100, 0],
                            opacity: [0, 1],
                            delay: anime.stagger(200),
                            duration: 800,
                            easing: 'easeOutExpo'
                        });
                    }
                }
            });
        }, observerOptions);

        // Mouse cursor trail effect
        function createCursorTrail() {
            let mouseX = 0, mouseY = 0;
            let trailElements = [];
            
            document.addEventListener('mousemove', (e) => {
                mouseX = e.clientX;
                mouseY = e.clientY;
            });
            
            for (let i = 0; i < 10; i++) {
                const trail = document.createElement('div');
                trail.style.cssText = `
                    position: fixed;
                    width: 6px;
                    height: 6px;
                    background: radial-gradient(circle, rgba(255,215,0,0.8), transparent);
                    border-radius: 50%;
                    pointer-events: none;
                    z-index: 9999;
                    opacity: ${1 - i * 0.1};
                `;
                document.body.appendChild(trail);
                trailElements.push(trail);
            }
            
            anime({
                targets: trailElements,
                translateX: () => mouseX,
                translateY: () => mouseY,
                duration: 1000,
                easing: 'easeOutExpo',
                loop: true
            });
        }

        // Text typing animation for project descriptions
        function typeWriter(element, text, speed = 50) {
            let i = 0;
            element.innerHTML = '';
            
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            animateNavItems();
            createCursorTrail();
            
            // Observe projects section
            const projectsSection = document.getElementById('projects');
            if (projectsSection) {
                observer.observe(projectsSection);
            }
            
            // Animate skills when they come into view
            const skillsSection = document.getElementById('skills');
            if (skillsSection) {
                const skillsObserver = new IntersectionObserver((entries) => {
                    if (entries[0].isIntersecting) {
                        animateSkills();
                        skillsObserver.disconnect();
                    }
                }, observerOptions);
                skillsObserver.observe(skillsSection);
            }
        });

        // Add subtle parallax effect to background
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const speed = scrolled * 0.1;
            document.body.style.backgroundPosition = `center ${speed}px`;
            
            // Animate particles based on scroll
            anime({
                targets: '.particle',
                translateY: -scrolled * 0.2,
                duration: 0,
                easing: 'linear'
            });
        });

       // Loading animation for .container
    window.addEventListener('load', function() {
        anime({
            targets: '.container',
            opacity: [0, 1],
            translateY: [50, 0],
            duration: 1000,
            easing: 'easeOutExpo'
        });
    });
        // Parallax background effect on scroll (body background)
        window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        // You can't select ::before directly, so animate the body's backgroundPosition
        // Adjust the speed factor as desired
        const speed = scrolled * 0.1;
        document.body.style.backgroundPosition = `center ${speed}px`;
    });

    anime({
  targets: '#main-title',
  translateY: [-50, 0],
  opacity: [0, 1],
  duration: 1200,
  easing: 'easeOutExpo'
});

gsap.from('.project-card', { y: 40, opacity: 0, stagger: 0.2, duration: 1 });

new mojs.Burst({
  parent: '#project1',
  radius:   { 0: 100 },
  count:    10,
  children: { fill: 'orange', radius: 20 }
}).play();

popmotion.animate({
  from: 0,
  to: 1,
  onUpdate: latest => {
    document.getElementById('project2').style.opacity = latest;
  }
});

Velocity(document.querySelector('#main-title'), { scale: 1.2 }, { duration: 800 });

KUTE.to('#main-title', { color: '#FF5733' }).start();

var controller = new ScrollMagic.Controller();
new ScrollMagic.Scene({
  triggerElement: "#project1"
})
.setClassToggle("#project1", "visible")
.addTo(controller);

particlesJS.load('particles-js', 'particles.json');

var tween = new TWEEN.Tween({ x: 0 })
  .to({ x: 100 }, 1000)
  .onUpdate(obj => { document.getElementById('project2').style.left = obj.x + 'px'; })
  .start();

  ScrollReveal().reveal('.project-card', { delay: 200 });

  var typed = new Typed('#typed-text', {
  strings: ["Frontend Developer", "UI/UX Enthusiast"],
  typeSpeed: 50
});

lottie.loadAnimation({
  container: document.getElementById('lottie-container'),
  renderer: 'svg',
  loop: true,
  autoplay: true,
  path: 'animation.json'
});

$('#main-title').animo({ animation: 'bounce' });

var bounce = new Bounce();
bounce.scale({ from: { x: 1, y: 1 }, to: { x: 1.2, y: 1.2 }, duration: 500 });
bounce.applyTo(document.getElementById('project1'));

function() {
            // https://dashboard.emailjs.com/admin/account
            emailjs.init({
              publicKey: "nYiWxpcr7gz4GNm-y",
            });
        })();

 window.onload = function() {
            document.getElementById('contact-form').addEventListener('submit', function(event) {
                event.preventDefault();
                // these IDs from the previous steps
                emailjs.sendForm('contact_service', 'contact_form', this)
                    .then(() => {
                        console.log('SUCCESS!');
                    }, (error) => {
                        console.log('FAILED...', error);
                    });
            });
        }
