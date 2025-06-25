d = window.pageYOffset;
            const parallax = document.querySelector('body::before');
            if (parallax) {
                const speed = scrolled * 0.1;
                document.body.style.backgroundPosition = `center ${speed}px`;
            }
        });