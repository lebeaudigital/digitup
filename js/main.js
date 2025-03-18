document.addEventListener("DOMContentLoaded", function() {
    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll(".sticky-nav .nav-link");

    window.addEventListener("scroll", () => {
        let scrollY = window.scrollY || document.documentElement.scrollTop;
        let current = "";

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;

            // Vérifie si la section est dans la fenêtre d'affichage
            if (scrollY >= sectionTop - window.innerHeight / 3 && scrollY < sectionTop + sectionHeight - window.innerHeight / 3) {
                current = section.getAttribute("id");
            }
        });


        navLinks.forEach(link => {
            link.classList.remove("active");
            if (link.getAttribute("href").substring(1) === current) {
                link.classList.add("active");
            }
        });

        console.log("Lien actif :", current);
    });
});

window.addEventListener("scroll", () => {
    let activeLink = document.querySelector(".sticky-nav .nav-link.active");
    console.log("Lien actif :", activeLink ? activeLink.textContent : "Aucun actif");
});

gsap.registerPlugin(ScrollTrigger); // Assure que ScrollTrigger est bien enregistré
let $path = $(".cls-1")[0]; // Sélectionne l'élément SVG en jQuery et récupère le premier élément DOM
let pathLength = $path.getTotalLength();


gsap.set($path, {
    strokeDasharray: pathLength,
    strokeDashoffset: pathLength
});

gsap.to($path, {
    strokeDashoffset: 0,
    duration: 3,
    ease: "power2.out"
});

if($(".line").length){
    const lines = gsap.utils.toArray(".line");

    lines.forEach((line, index) => {
        gsap.from(line, {
            y: "100%",
            opacity: 0,
            duration: 0.7,
            ease: "power4.out",
            delay: index * .5, // Décalage basé sur l'index de chaque ligne
            scrollTrigger: {
                trigger: line,
                start: "top 100%",
                // onEnter: () => console.log("Animation start"),
                // onLeave: () => console.log("Animation end"),
            }
        });
    });
};

if ($(".animateAfterH1").length) {
    const elements = gsap.utils.toArray(".animateAfterH1");
    
    elements.forEach((el, index) => {
        gsap.fromTo(el, 
            { y: 50, opacity: 0 }, // Position initiale
            { y: 0, opacity: 1, duration: .8, ease: "power2.out", 
              delay: $(".line").length * 0.7 + (index * 0.3),
              scrollTrigger: {
                  trigger: el,
                  start: "top 100%",
              } 
            }
        );
    });
}

if ($(".box").length) {
    const boxes = gsap.utils.toArray(".box");

    const positions = [
        { x: -200, y: -150, rotate: -8, scale: 1 },
        { x: 100, y: -200, rotate: 9, scale: 1 },
        { x: -50, y: 100, rotate: 1, scale: 1 },
        { x: -180, y: 800, rotate: 8, scale: 1 },
    ];

    boxes.forEach((box, index) => {
        let startPos = positions[index % positions.length];

        gsap.fromTo(box, 
            { 
                x: startPos.x, 
                y: startPos.y, 
                opacity: 0, 
                rotate: startPos.rotate, 
                scale: startPos.scale 
            },
            { 
                x: 0, 
                y: 0, 
                opacity: 1, 
                rotate: startPos.rotate, 
                scale: startPos.scale,
                duration: 1, 
                ease: "power3.out", 
                delay: $(".line").length * 0.4 + (index * 0.3) 
            }
        );
    });
}